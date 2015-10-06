<!DOCTYPE HTML>
<?php
	header('X-Furry: Seti the Dragon');
?>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>ARK.FurLand.EU - ARK Furry Servers</title>
		<meta name="description" content="A furry community server for ARK: Survival Evolved" />
		<meta property="og:title" content="FurLand.EU - furry ARK survival servers" />
		<meta property="og:description" content="A community page for the furry ARK servers." />
		<meta property="og:type" content="website" />
		<meta property="og:image" content="ark.png" />
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:title" content="FurLand.EU - furry ARK survival servers" />
		<meta name="twitter:description" content="A community page for the furry ARK servers." />
		<meta name="twitter:image" content="ark.png" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" />
		<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/slate/bootstrap.min.css" rel="stylesheet" />
		<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/darkly/bootstrap.min.css" rel="stylesheet" />

		<link href="css/font-awesome.min.css" rel="stylesheet" />

		<link href="style.css" rel="stylesheet" />
		<link href="video.css" rel="stylesheet" />
<script>
String.prototype.toHHMMSS = function () {
    var sec_num = parseInt(this, 10); // don't forget the second param
    var hours   = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}
    var time    = hours+':'+minutes+':'+seconds;
    return time;
}
</script>
	</head>
	<body>
		<div class="fullscreen-bg">
		    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="arkLogoRight"></div>
		    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="arkLogoLeft"></div>
		</div>
		<div class="container-fluid">
			<div class="page-body" id="pagediv">
				<div class="row-fluid" id="pagedivItems">
					<div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-3 col-lg-6 col-md-6 col-sm-6 col-xs-6" style="">
					    <div class="panel panel-primary">
						<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-paw"></i> ARK Servers in group</h3></div>
						<div class="panel-body">
						    <p class="text-center">
							<h4>PVE</h4>
							<ul class="serverList serverList-PVE">
							    <li class="loading">Loading...</li>
							</ul>
						    </p>
						    <p class="text-center">
							<h4>PVP</h4>
							<ul class="serverList serverList-PVP">
							    <li class="loading">Loading...</li>
							</ul>
						    </p>
						</div>
					    </div>
					</div>
				</div>
			</div>
		</div>
	    <script>
	    function checkServers() {
		jQuery.ajax({
		    url: 'ajax.php',
		    method: 'post',
		    dataType: 'json',
		    success: function (data) {
			console.log(data);
			var ark = data.arkse || {};
			var pve = ark.PVE || [];
			var pvp = ark.PVP || [];
//console.log(pve, pvp);
			var serverString = '<li id="server_li_{{id}}" data-type="{{type}}"><span class="serverName">{{name}}</span> - <span class="serverVersion text-success">{{ver}}</span></li>';
			var noServersString = '<li id="no_servers_{{type}}">No {{type}} server running...</li>';

			    if (pve.length == 0) jQuery('ul.serverList-PVE').html(noServersString.replace(/{{type}}/g, 'PVE'));
			    if (pvp.length == 0) jQuery('ul.serverList-PVP').html(noServersString.replace(/{{type}}/g, 'PVP'));
			    jQuery('.serverList li.loading').remove();

			var serverData = '				<div class="row-fluid" id="server_{{id}}">' +
'					<div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-3 col-lg-6 col-md-6 col-sm-6 col-xs-6" style="">' + 
'					    <div class="panel panel-primary">' +
'						<div class="panel-heading">' +
'						    <h3 class="panel-title">' +
'							<i class="fa fa-paw"></i> <span class="serverType">{{type}}</span>: <span class="serverName">{{name}}</span>' +
//'								<br/>' +
'							<span class="serverStatus text-{{statusColor}}">{{status}}</span> <span class="serverPplOnline text-info">{{players}}</span>/<span class="serverPplMax text-primary">{{maxplayers}}</span> +<span class="serverPplConnecting text-muted" title="connecting">{{connecting}}</span>' +
'						    </h3>' +
'						</div>' +
'						<div class="panel-body">' +
'						    <ul class="playerList"> '+
'						    </ul>' +
'						</div>' +
'					    </div>' +
'					</div>' +
'				</div>';

			var serverPlayer = '<li class="player"><div class="playerName text-info">{{name}}</div> - <div class="playerDuration">{{duration}}</div></li>';


			for(var i in pve) {
			    if (!pve.hasOwnProperty(i)) continue;
			    var server = pve[i];

			    if (jQuery('.serverList-PVE li#server_li_' + server.ID).length == 0)
				jQuery('.serverList-PVE').append(serverString.replace(/{{id}}/g, server.ID).replace(/{{type}}/g, server.ServerType).replace(/{{name}}/g, server.ServerName).replace(/{{ver}}/g, server.ServerVersion));
			    else {
				jQuery('.serverList-PVE div#server_li_' + server.ID + ' .serverVersion').html(server.ServerVersion);
			    }


			    jQuery('#server_' + server.ID + ' ul.playerList').html('');
			    if (jQuery('#server_' + server.ID).length == 0)
				jQuery('#pagedivItems').append(serverData.replace(/{{id}}/g, server.ID).replace(/{{type}}/g, server.ServerType).replace(/{{name}}/g, server.ServerName).replace(/{{status}}/g, server.isOnline == 1 ? 'ONLINE' : (server.isOnline == 2 ? 'UPGRADING' : 'OFFLINE')).replace(/{{statusColor}}/g, server.isOnline == 1 ? 'success' : (server.isOnline == 2 ? 'warning' : 'danger')).replace(/{{players}}/g, server.players.length).replace(/{{maxplayers}}/g, server.ServerMaxPlayers).replace(/{{connecting}}/g, server.ServerPlayers - server.ServerRealPlayers));
			    else {
				jQuery('div#server_' + server.ID + ' .serverStatus').html(server.isOnline == 1 ? 'ONLINE' : (server.isOnline == 2 ? 'UPGRADING' : 'OFFLINE')).attr('class','serverStatus').addClass('text-' + (server.isOnline == 1 ? 'success' : (server.isOnline == 2 ? 'warning' : 'danger')));
				jQuery('div#server_' + server.ID + ' .serverPplOnline').html(server.ServerRealPlayers);
				jQuery('div#server_' + server.ID + ' .serverPplMax').html(server.ServerMaxPlayers);
				jQuery('div#server_' + server.ID + ' .serverPplConnecting').html(server.ServerRealPlayers - server.ServerPlayers);
			    }

			    jQuery('#server_' + server.ID + ' ul.playerList').html('');
			    if (server.players.length === 0) {
				jQuery('#server_' + server.ID + ' ul.playerlist').html('<li>No players online</li>');
			    }	else {
				for (var j in server.players) {
				    if (!server.players.hasOwnProperty(j)) continue;
				    var player = server.players[j];
				    jQuery('#server_' + server.ID + ' ul.playerList').append(serverPlayer.replace(/{{name}}/g, player.PlayerName).replace(/{{duration}}/g, player.PlayTime.toHHMMSS()));
				}
			    }
			}
			for(var i in pvp) {
			    if (!pvp.hasOwnProperty(i)) continue;
			    var server = pvp[i];

			    if (jQuery('.serverList-PVP li#server_li_' + server.ID).length == 0)
				jQuery('.serverList-PVP').append(serverString.replace(/{{id}}/g, server.ID).replace(/{{type}}/g, server.ServerType).replace(/{{name}}/g, server.ServerName).replace(/{{ver}}/g, server.ServerVersion));
			    else {
				jQuery('.serverList-PVP li#server_li_' + server.ID + ' .serverVersion').html(server.ServerVersion);
			    }


			    jQuery('#server_' + server.ID + ' ul.playerList').html('');
			    if (jQuery('#server_' + server.ID).length == 0)
				jQuery('#pagedivItems').append(serverData.replace(/{{id}}/g, server.ID).replace(/{{type}}/g, server.ServerType).replace(/{{name}}/g, server.ServerName).replace(/{{status}}/g, server.isOnline == 1 ? 'ONLINE' : (server.isOnline == 2 ? 'UPGRADING' : 'OFFLINE')).replace(/{{statusColor}}/g, server.isOnline == 1 ? 'success' : (server.isOnline == 2 ? 'warning' : 'danger')).replace(/{{players}}/g, server.players.length).replace(/{{maxplayers}}/g, server.ServerMaxPlayers).replace(/{{connecting}}/g, server.ServerPlayers - server.ServerRealPlayers));
			    else {
				jQuery('div#server_' + server.ID + ' .serverStatus').html(server.isOnline == 1 ? 'ONLINE' : (server.isOnline == 2 ? 'UPGRADING' : 'OFFLINE')).attr('class','serverStatus').addClass('text-' + (server.isOnline == 1 ? 'success' : (server.isOnline == 2 ? 'warning' : 'danger')));
				jQuery('div#server_' + server.ID + ' .serverPplOnline').html(server.ServerRealPlayers);
				jQuery('div#server_' + server.ID + ' .serverPplMax').html(server.ServerMaxPlayers);
				jQuery('div#server_' + server.ID + ' .serverPplConnecting').html(server.ServerRealPlayers - server.ServerPlayers);
			    }

			    jQuery('#server_' + server.ID + ' ul.playerList').html('');
			    if (server.players.length === 0) {
				jQuery('#server_' + server.ID + ' ul.playerlist').html('<li>No players online</li>');
			    }	else {
				for (var j in server.players) {
				    if (!server.players.hasOwnProperty(j)) continue;
				    var player = server.players[j];
				    jQuery('#server_' + server.ID + ' ul.playerList').append(serverPlayer.replace(/{{name}}/g, player.PlayerName).replace(/{{duration}}/g, player.PlayTime.toHHMMSS()));
				}
			    }
			}
		    },
		    complete: function () {
			setTimeout(checkServers, 5000);
		    }
		});
	    }

	    checkServers();
	    </script>
	</body>
</html>
<!-- Script Creates by Artur (Seti) Łabudziński - known as Seti the Dragon -->



