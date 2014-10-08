<?php
try{
	$pdo = new PDO( 'mysql:host=localhost;dbname=mydbname', 'name', 'passwd' );
	$res = $pdo->query("SELECT * FROM Test");
	foreach  ($res as $row) {
			echo $row['name'] . "    ";
			echo $row['email'] . "    ";
			echo $row['password'] . "<br>";
	}
}catch(Exception $e){
	echo 'error';
}
?>