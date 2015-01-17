<h1>Tester les injections mysql</h1>
<form method="POST">
	<input name="strings">
	<textarea name="text"></textarea>
	<input type="submit" value="OK">
</form>
<?php
/* admin for redmine
http://www.redmine.org/projects/redmine/wiki/redmineinstall*/
if(isset($_POST['text']) && $_POST['text'] != "")
{
	DB::querySafe("INSERT INTO test(field) VALUES (:truc)", array(':truc' => $_POST['text']));
	var_dump(DB::lastInsertId());
	echo 'teubé';
}
if(isset($_POST['strings']))
{
	$sth = DB::querySafe("SELECT name FROM user WHERE name = ? AND ?", array($_POST['strings'], 1));
	$res = $sth->fetchAll();
	if(sizeof($res) > 0)
		var_dump($res[0]['name']);
	else
		echo "rien";
	echo 'teub';
}
	