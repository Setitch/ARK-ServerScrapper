<?php
include('../config.php');
/* check connection */
if ($sql->connect_errno) {
    printf("Connect failed: %s\n", $sql->connect_error);
    exit();
}


$query = 'SELECT ID, ServerName, ServerVersion, ServerType, host, gameType, queryport,  isOnline from servers where isActive = 1';
$rows = $sql->query($query);
foreach ($rows as $row) {

	if ($row['isOnline'] == 2) continue; //do not touch upgrading servers!!

	$procFile = '/usr/local/bin/gamedig --type '. $row['gameType'] .' --host '. $row['host']. ' --port '.$row['queryport'];
#echo "\n";
	$proc = proc_open($procFile, array(array('pipe','r'), array('pipe','w'), array('pipe','w')), $pipes);
		sleep(1);
	if (is_resource($proc)) {
		fclose($pipes[0]);
		$json = '';
		while ($s = fgets($pipes[1], 1024)) {
			$json .= $s;
		}
		fclose($pipes[1]);
		fclose($pipes[2]);

		try {
//file_put_contents('/home/steam/pids/a.txt', $json);
			$json = json_decode($json);
		} catch (Exception $e) {
		    $sql -> query('update servers set isOnline = 0 where ID = '.$row['ID']);
		    continue;
		}
		if (isset($json->error)) {
		    $sql -> query('update servers set isOnline = 0 where ID = '.$row['ID']);
		    continue;
		}
#		print_r($json);
		$name = explode('-', $json->name);
		$ver = trim(
		    str_replace(
			array('(',')','v'),
			array('' , '', ''),
			$name[count($name)-1]
		    )
		);
		unset($name[count($name)-1]);
		$name = trim(implode('-', $name));
#print_r($name);
#print_r($ver);
		$query = "update servers set ServerVersion = '" . $ver . "', ServerName = '". addslashes($name). "', ServerPlayers = ".$json->raw->numplayers.", ServerRealPlayers = ".count($json->players).", ServerMaxPlayers = ".$json->maxplayers.", isOnline = 1 where ID = ".$row['ID'];
		$sql->query($query);
		
		$query = 'update players set isOnline = 0 where ServerID = '.$row['ID'];
		$sql->query($query);
		
		foreach ($json->players as $player) {
			$query = "insert into players set AddDate = NOW(), ServerID = ".$row['ID'].", PlayerName = '".addslashes($player->name)."', PlayTime = ".$player->time.", isOnline = 1 on duplicate key update isOnline = 1, PlayTime = ".$player->time;
			$sql->query($query);
		}
	}
}

