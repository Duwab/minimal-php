<?php
//http://phppot.com/php/php-login-script-with-session/
//http://www.w3schools.com/php/php_sessions.asp
 
 class Session {
 
	public $id = 0;
	public $token = false;
	private $session_lifetime = 0;
	private $cookie_lifetime = 0;
	public $profile = array(
		"name" => "",
		"email" => "email"
	);
	
	public function __construct(){
		DEBUG('session_start');
		
		global $CONF, $DEV_MODE;
		$this->session_lifetime = $CONF['session_lifetime'];
		$this->cookie_lifetime = $CONF['cookie_lifetime'];

		ini_set("session.cookie_lifetime", $this->session_lifetime);
		session_start();
		
		if($DEV_MODE && isset($_COOKIE['token']))
			echo 'token is set ' . $_COOKIE['token'];
			
		if(isset($_POST['login_name']))
		{
			DEBUG('_POST[login_name] is set');
			$res = DB::query("SELECT * FROM user WHERE name='" . DB::protect($_POST['login_name']) . "' AND password=SHA1('" . DB::protect($_POST['login_password']) . "')");
			$result = $res->fetchAll();
			if(isset($result[0]))
			{
				$this->login($result[0]);
				header("Location:/");
			}
			else
			{
				$this->logout();
			}
		}else if(isset($_POST['logout']))
		{
			DEBUG('_POST[logout] is set');
			$this->logout();
		}else if(isset($_SESSION["user_id"]))
		{
			DEBUG('_SESSION[user_id] is set');
			$res = DB::query("SELECT * FROM user WHERE id='" . $_SESSION["user_id"] . "'");
			$result = $res->fetchAll();
			if(isset($result[0]))
			{
				$this->login($result[0]);
			}
			else
			{
				$this->logout();
			}
		}else if(isset($_COOKIE['token']))
		{
			DEBUG('_COOKIE[token] is set');
			//$res = DB::query("SELECT * FROM user WHERE id='" . DB::protect($_COOKIE['token']) . "'");
		}else
			$this->logout();
	}
	private function login($user_info){
		$_SESSION["user_id"] = $user_info['id'];
		$this->id = $user_info['id'];
		$this->profile = $user_info;
		$this->newToken();
		DEBUG('session login');
	}
	public function logout(){
		unset($_SESSION["user_id"]);
		$this->id = 0;
		$this->profile = array(
			"name" => "",
			"email" => ""
		);
		$this->deleteToken();
		DEBUG('session logout');
	}
	public function newToken(){
		setcookie('token', rand ( 0 , 1000000 ), time() + $this->cookie_lifetime);
		//setcookie("TestCookie", $value, time()+3600, "/~rasmus/", "example.com", 1);  >> path, domain, http_only
	}
	public function deleteToken(){
		unset( $_COOKIE['token'] );
	}
	public function refreshCookie(){
	}
 }
 
 $user = new Session();
 
 DEBUG($user->id);
 
 DEBUG('session call');