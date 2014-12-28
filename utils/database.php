<?php
class DB {
	private static $pdo = false;
	public static function query($string){
		global $CONF;
		//DEBUG('mysql query ' . $string);
		if(DB::$pdo ===false)
		{
			try{
				DEBUG('try pdo connection');
				$db = $CONF['database'];
				DB::$pdo = new PDO( 'mysql:host=' . $db['host'] . ';dbname=' . $db['database'], $db['username'], $db['password'] );
				DEBUG('pdo connection ok');
			}catch(Exception $e){
				DEBUG('pdo connection fail');
				return false;
			}
		}
		return DB::$pdo->query($string);
	}
	public static function protect($string){
		// TODO : add pro
		if(preg_match('/^(\w|-|_)*$/', $string))
			return $string;
		else
		{
			DEBUG('tentative de hack');
			return '';
		}
	}
}

/* $res = DB::query('SELECT 1');
$result = $res->fetchAll();
print_r($result); */

?>