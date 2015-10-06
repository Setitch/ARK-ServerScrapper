<?php

include('config.php');

/* check connection */
if ($sql->connect_errno) {
    printf("Connect failed: %s\n", $sql->connect_error);
    exit();
}


echo $query = 'SELECT ID, ServerName, ServerVersion, ServerType, host, gameType,  isOnline from servers where ID = ' . $argv[1];
$rows = $sql->query($query);
foreach ($rows as $row) {
	$query = "update servers set isOnline = 0 where ID = ".$row['ID'];
	$sql->query($query);
	
}

