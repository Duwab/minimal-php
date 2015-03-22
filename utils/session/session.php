<?php
//http://phppot.com/php/php-login-script-with-session/
//http://www.w3schools.com/php/php_sessions.asp

/* 

routes: login et logout

fonctions dans session manager

start session
if login / password,
	logout,
	vérifier
	si oui
		set session
		set cookie
		set userId

si session
	set userId
	refresh cookie
sinon si pas session
	si cookie
		check
		si mauvais
			logout
		si bon
			set session
			set userId
			refresh cookie
		
		

 */
 
 class Session {
 
	public $id = 0;
	public $token = false;
	private $session_lifetime = 0;
	private $cookie_lifetime = 1000000000000000000000;
	public $profile = array(
		"name" => "",
		"email" => "email"
	);
	
	public function __construct(){
		DEBUG('session_start');
		if(preg_match("/^\/(assets|favicon|file)/", $_SERVER['REQUEST_URI']))
			return;
		
		global $CONF, $DEV_MODE;
		$this->session_lifetime = $CONF['session_lifetime'];
		$this->cookie_lifetime = $CONF['cookie_lifetime'];

		ini_set("session.cookie_lifetime", $this->session_lifetime);
		session_start();
			
		if(preg_match("/^\/logout/", $_SERVER['REQUEST_URI']))
		{
			$this->logout();
			header("Location: /");
		}else if(isset($_POST['login_name']))
		{
			DEBUG('_POST[login_name] is set');
			$res = DB::query("SELECT * FROM user WHERE name='" . DB::protect($_POST['login_name']) . "' AND password=SHA1('" . DB::protect($_POST['login_password']) . "')");
			$result = $res->fetchAll();
			if(isset($result[0]))
			{
				$this->login($result[0]);
				header("Location:profile");
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
			$res = DB::querySafe("SELECT * FROM user WHERE token=:token AND token_expire > NOW()", array(
				"token"=>$_COOKIE['token']
			));
			$u = $res->fetch();
			if($u)
			{
				$this->login($u);
			}else
			{
				$this->logout();
			}
		}else
			$this->logout();
	}
	private function login($user_info){
		$_SESSION["user_id"] = $user_info['id'];
		$this->id = $user_info['id'];
		$this->profile = $user_info;
		if(isset($_COOKIE['token']) || (isset($_POST['cookie_remember']) && $_POST['cookie_remember']))
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
		//$this->deleteToken();
		if(isset($_COOKIE['token']))
			$token = $_COOKIE['token'];
		else
			$token = $this->getAvailableToken();
		$expire = time() + $this->cookie_lifetime;
		setcookie('token', $token, $expire, "/");
		DB::querySafe("UPDATE user SET token=:token, token_expire=FROM_UNIXTIME(:expire) WHERE :id", array(
			"token" => $token,
			"expire" => $expire,
			"id" => $this->id,
		));
		//setcookie("TestCookie", $value, time()+3600, "/~rasmus/", "example.com", 1);  >> path, domain, http_only
	}
	public function getAvailableToken(){
		$found = false;
		
		while(!$found)
		{
			$token = rand ( 0 , 1000000000000000000000 );
			$select = DB::querySafe("SELECT * FROM user WHERE token=:token", array("token" => $token));
			if($select->rowCount() == 0)
				$found = true;
		}
		
		return $token;
	}
	public function deleteToken(){
		setcookie('token', "", 1);
		//unset( $_COOKIE['token'] );
	}
	public function refreshCookie(){
	}
 }
 
 $user = new Session();
 
 DEBUG($user->id);
 
 DEBUG('session call');