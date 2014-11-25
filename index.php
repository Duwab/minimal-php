<?php

/* 
ini_set('upload_max_filesize', '20000000M');
ini_set('post_max_size', '20000000M');
ini_set('max_input_time', 3000000000);
ini_set('max_execution_time', 3000000000); */

$DEBUG_ON = false;
$DEV_MODE = false;
$PATH = realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR;

include('utils/error.php');

include('conf.php');

include('utils/database.php');

include('utils/session/session.php');

include('utils/response.php');

if(!isset($_SERVER['PATH_INFO']))
	$uri_exp = array(NULL, NULL);
else
	$uri_exp = explode('/', $_SERVER['PATH_INFO']);

include('routes.php');

$body = Response::$body;
foreach(Response::$values as $key => $value)
{
	$$key = $value;
}
include('views/template.php');

