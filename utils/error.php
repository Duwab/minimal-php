<?php
function error_handler($errno, $errstr, $errfile, $errline){
	$body = "views/error";
	include('views/template.php');
	var_dump($errno);
	var_dump($errstr);
	var_dump($errfile);
	var_dump($errline);
	die();
}

set_error_handler (error_handler);

$DEBUG_LIST = array();

function DEBUG($obj){
	
	global $DEBUG_ON, $DEBUG_LIST;
	
	if($DEBUG_ON){
		array_push($DEBUG_LIST, $obj);
		try{
			echo json_encode($obj);
		}catch(Exception $e){
			var_dump($obj);
		}
		echo '<br>';
	}
}