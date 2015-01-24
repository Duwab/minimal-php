<!DOCTYPE html>
<head>
	<script src="/assets/js/jquery.min.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>
	<!--script src="/assets/js/require.min.js"></script-->
	<!--script src="/assets/js/angular.min.js"></script-->
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/assets/jplayer/css/jplayer.blue.monday.css" media="screen" />
	<script type="text/javascript" src="/assets/jplayer/js/jquery.jplayer.min.js"></script>
	<script type="text/javascript" src="/assets/jplayer/js/jplayer.playlist.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css" media="screen" />
	<script src="/assets/js/script.js"></script>
</head>
<body>
<header>
	<div class="header_logo">
		<img src="/assets/img/logo_mini.png" alt="Playlist">easy-play
	</div>
	<img class="header_dancing" src="/assets/img/dancing/empty.png"/>
</header>
<?php
if($DEV_MODE)
{
	echo '<br> user id = ' . $user->id .'<br>';
}
include($PATH . $body . '.php');
?>
</body>
