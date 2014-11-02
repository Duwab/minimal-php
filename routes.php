<?php

header("Content-Type: text/html");
if($uri_exp[1] === NULL || $uri_exp[1] == 'home')
	Response::$body = "application/home";
if($uri_exp[1] == 'profile')
	Response::$body = "application/profile";
if($uri_exp[1] == 'api')
	include('application/api.php');
if($uri_exp[1] == 'login')
	Response::$body = "utils/session/login";
if($uri_exp[1] == 'register')
	Response::$body = "utils/session/register";
if($uri_exp[1] == 'logout')
	Response::$body = "utils/session/logout";
if($uri_exp[1] == 'recover')
	Response::$body = "utils/session/recover";
if(in_array($uri_exp[1], array('file', 'stream')) && isset($_GET['path']))
{
	foreach($CONF['folders'] as $folder)
	{
		if(strpos($_GET['path'], $folder) == 0 && strpos($_GET['path'], '..') === false && file_exists($_GET['path']))
		{
			if($uri_exp[1] == 'file')
			{
				Response::file($_GET['path']);
			}else
			{
				require_once 'application/stream.php';
				$stream = new VideoStream($_GET['path']);
				$stream->start();
			}
		}
	}
}
