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
	
	public static function file($path){
		$exp = explode('/', $path);
		if(sizeof($exp) > 1 && file_exists($path))
		{
			$name = $exp[sizeof($exp) - 1];
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mime_type = finfo_file($finfo, $path);
			finfo_close($finfo);
			header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
			header("Cache-Control: public"); // needed for i.e.
			header("Content-Type: " . $mime_type);
			header("Content-Transfer-Encoding: Binary");
			header("Content-Length:".filesize($path));
			header("Content-Disposition: attachment; filename=\"" . $name . "\"");
			readfile($path);
			exit();
		}
	}
}