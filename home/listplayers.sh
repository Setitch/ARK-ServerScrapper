#!/bin/bash

./rcon -P<rconPass> -a127.0.0.1 -p<pass> listplayers
./rcon -P<rconPass> -a127.0.0.1 -p<pass> GetChat
./rcon -P<rconPass> -a127.0.0.1 -p<pass> ServerChat "$1"
