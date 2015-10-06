#!/bin/bash

cd /home/steam/pids
arr=(ARK);
for item in ${arr[*]}
do
    PID=`ps aux | grep $item | grep -v grep | awk '{print $2}'`;
    CPU=`ps aux | grep $item | grep -v grep | awk '{print $3}'`;
    MEM=`ps aux | grep $item | grep -v grep | awk '{print $4}'`;
    UPTIME=`ps aux | grep $item | grep -v grep | awk '{print $10}'`;
    echo $PID > "$item.pid";
    echo $CPU > "$item.cpu";
    echo $MEM > "$item.mem";
    echo $UPTIME > "$item.up";
done
#/usr/bin/php /home/steam/pids/scanGames.php
