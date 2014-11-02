<!DOCTYPE html>
<head>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="/assets/js/script.js"></script>
	<script src="/assets/js/sortable.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css" media="screen" /> 
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
