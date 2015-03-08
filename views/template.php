<!DOCTYPE html>
<head>
	<script src="/assets/js/script.js"></script>
	<script src="/assets/js/jquery.min.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>
	<!--script src="/assets/js/require.min.js"></script-->
	<!--script src="/assets/js/angular.min.js"></script-->
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css" media="screen" />
	<link rel="icon" 
      type="image/png" 
      href="/assets/img/favicon.jpg">
</head>
<html>
<body>
<?php
if($DEV_MODE)
{
	echo '<br> user id = ' . $user->id .'<br>';
}
include($PATH . $body . '.php');
?>
	
</body>
</html>
