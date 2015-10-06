<?php
include('config.php');

/* check connection */
if ($sql->connect_errno) {
    printf("Connect failed: %s\n", $sql->connect_error);
    exit();
}


$query = 'SELECT ID, gametype, ServerPlayers, ServerRealPlayers, ServerName, ServerVersion, ServerMaxPlayers, ServerType, isOnline from servers where isActive = 1';
$rows = $sql->query($query); 
$ret = array();
foreach ($rows as $row) {
//    var_dump($row);
    if (!isset($ret[$row['gametype']])) $ret[$row['gametype']] = array();
    if (!isset($ret[$row['gametype']][$row['ServerType']])) $ret[$row['gametype']][$row['ServerType']] = array();

    $gameType = $row['gametype'];
    unset($row['gametype']);

    $query = 'SELECT PlayerName, PlayTime, unix_timestamp(ModDate) as ScanDate, unix_timestamp(NOW()) as NowDate FROM players where isOnline = 1 AND ServerID = '.$row['ID'];
    $players = $sql->query($query);

    $row['players'] = array();
    foreach ($players as $player)
	$row['players'][] = $player;

    $ret[$gameType][$row['ServerType']][] = $row;
}
echo json_encode($ret);
//var_dump($rows);




