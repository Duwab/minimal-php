<!DOCTYPE html>
<head>
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css" media="screen" />
		
	<script src="/assets/js/jquery.min.js"></script>
	
	<link rel="icon" 
      type="image/png" 
      href="/assets/img/favicon.jpg">
</head>
<html>
<body>
	<?php include("views/header.php");?>
	<?php
	if($DEV_MODE)
	{
		echo '<br> user id = ' . $user->id .'<br>';
	}
	include($PATH . $body . '.php');
	?>
	<script src="/assets/js/bootstrap.min.js"></script>
	<script src="/assets/js/script.js"></script>
</body>
</html>
