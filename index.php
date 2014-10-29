<?php

$DEBUG_ON = false;
$DEV_MODE = true;
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

