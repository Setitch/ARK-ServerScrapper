#!/bin/bash
VER=`curl -sL http://arkdedicated.com/version`;
MAJOR=`curl -sL http://arkdedicated.com/version/major`;
echo -n "Version: $MAJOR / $VER";