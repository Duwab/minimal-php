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


include('conf.php');
include('utils/response.php');
$application = 'application';
error_reporting(E_ALL | E_STRICT);
define('DOCROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);
// Make the application relative to the docroot, for symlink'd index.php
if ( ! is_dir($application) AND is_dir(DOCROOT.$application))
	$application = DOCROOT.$application;
$PATH = realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR;
// Define the absolute paths for configured directories
define('APPPATH', realpath($application).DIRECTORY_SEPARATOR);

// Clean up the configuration vars
unset($application);
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

