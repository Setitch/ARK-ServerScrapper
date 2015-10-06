#!/bin/bash

#php upgrade.*.php needs server ID from database as parameter!

cd pids
./cron.sh
./kill.sh ARK
cd ..
php upgrade.start.php 1
./ark.install.sh
php upgrade.stop.php 1
./start.ark.sh