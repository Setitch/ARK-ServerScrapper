#!/bin/bash

#not yet used file

ver=`/home/steam/steamcmd/steamcmd.sh +login anonymous +force_install_dir /home/steam/servers/ARK +app_info_update 1 +app_info_print 376030 +quit`
echo $ver;
