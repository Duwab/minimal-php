<?php

/*
	
	Classe pour manipuler les fichiers
	
*/


class FILES{

	private static $path = false;

	function __construct(){
	}
	
	/*
	
	Methods
	
	*/
	
	public static function stream($filename){
		global $user;
		if($user->id == 0)
			return Response::error(401);
		session_write_close();
		$filepath = FILES::getPath($filename);
		include "utils/upload/Stream.php";
		$stream = new VideoStream($filepath);
		$stream->start();
		die();
	}
	
	public static function uploadForm(){
		global $user;
		if($user->id == 0)
			return Response::error(401);
		include('utils/upload/form.php');
	}
	
	public static function fileExists($filename){
		if(!preg_match("/\.\./", $filename))
		{
			if(file_exists(FILES::getPath($filename)))
				return true;
		}
		return false;
	}
	
	
	
	
	/*
	
	Functions
	
	*/
	
	private function getPath($filename){	//returns the directory where all the files are stored
		if(!FILES::$path)
		{
			global $CONF;
			FILES::$path = $CONF['files_path'];
		}
		return FILES::$path . "/" . $filename;
	}
}