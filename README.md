# ARK-ServerScrapper
Scraps ARK server data and shows them.

# REQUIRES: gamedig installed (global).


# Directories in Pack
Directory ,,home'' is to be put into steam user home.
Directory ,,web'' is to be put into apache2 server direcotry for user to be able to see it


#Instaltion for autochecking things:
Set Cron to
    * * * * * /home/steam/pids/cron.sh
    * * * * * /usr/bin/php /home/steam/pids/scanGames.php


# Working example: http://furry.pl/ark