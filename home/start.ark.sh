#!/bin/bash

#feel <pass> and <rconPort> before use

ulimit -n 100000
/home/steam/servers/ARK-PVP/ShooterGame/Binaries/Linux/ShooterGameServer TheIsland?listen?ServerPassword=?ServerAdminPassword=<pass>?RCONEnabled=True?RCONPort=<rconPort> -server -log -gameplaylogging &

