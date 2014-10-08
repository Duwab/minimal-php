<?php

header("Content-Type: text/html");
if($uri_exp[1] === NULL || $uri_exp[1] == 'home')
	Response::$body = "application/home";
if($uri_exp[1] == 'bilan')
	Response::$body = "application/bilan";
if($uri_exp[1] == 'api')
{
	include('application/api.php');
}