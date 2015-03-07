<?php

if($uri_exp[1] === NULL || $uri_exp[1] == 'home')
	Response::$body = "application/home";
if($uri_exp[1] == 'profile')
	Response::$body = "application/profile";
if($uri_exp[1] == 'file')
	Response::$body = "application/fileservice";
if($uri_exp[1] == 'mysql')
	Response::$body = "application/mysql";
if($uri_exp[1] == 'api')
	include('application/api.php');
if($uri_exp[1] == 'upload')
	include('utils/upload/upload.php');
if($uri_exp[1] == 'login')
	Response::$body = "utils/session/login";
if($uri_exp[1] == 'register')
	Response::$body = "utils/session/register";
if($uri_exp[1] == 'logout')
	Response::$body = "utils/session/logout";
if($uri_exp[1] == 'recover')
	Response::$body = "utils/session/recover";
header("Content-Type: text/html");
