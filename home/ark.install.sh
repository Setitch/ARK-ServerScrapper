#!/bin/bash
#change your installation directory

if [[ "$1" == "validate" ]]
then
    /home/steam/steamcmd/steamcmd.sh +login anonymous +force_install_dir /home/steam/servers/ARK +app_update 376030 validate +quit
else
    /home/steam/steamcmd/steamcmd.sh +login anonymous +force_install_dir /home/steam/servers/ARK +app_update 376030 +quit
fi



