<!DOCTYPE html>
<head>
	<meta name="viewport" content="width=100%, initial-scale-1.0">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="/assets/js/script.js"></script>
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css" media="screen" />
	<link rel="icon" 
      type="image/png" 
      href="/assets/img/favicon.jpg">
</head>
<body>
<?php
if($DEV_MODE)
{
	echo '<br> user id = ' . $user->id .'<br>';
}
include($PATH . $body . '.php');
?>
</body>
