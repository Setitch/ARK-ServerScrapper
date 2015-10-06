#!/bin/bash

./cron.sh
file="$1.pid";
if [ ! -f $file ]; then
    echo "No $1.pid Found. Cannot kill it!";
    exit 1;
fi

PID=`cat $file`;
echo "Killing $1 of pids $PID";
#echo "$PID";
#echo "kill -15 $PID";
#kill -s HUP $PID
kill -s SIGQUIT $PID
