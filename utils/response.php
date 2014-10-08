<?php

class Response {
	
	public $template = 'views/template';
	public static $values = array(
		'name' => 'Matt Damon',
		'job' => 'Actor'
	);
	public static $body = "views/404";
	
	public static function send($obj){
		echo json_encode($obj);
		header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
		header("Cache-Control: public"); // needed for i.e.
		header("Content-Type: application/json");
		exit();
	}
}