<?php

//http://stackoverflow.com/questions/14143865/render-a-view-in-php

$DEBUG_ON = false;
$DEV_MODE = false;
$PATH = realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR;

include('utils/error.php');

$objDateTime = new DateTime('NOW');
DEBUG("\nhttp " . $objDateTime->format('c') . " - " . $_SERVER['REQUEST_URI'] . " :");

include('conf.php');

include('utils/database.php');

include('utils/session/session.php');

include('utils/response.php');

include('utils/upload/Files.php'); // File management = include Files.php + route /upload

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

