<?php
$db_host = 'localhost';
$db_name = 'cs2team11_db';
$username = 'cs2team11';
$password = 'L1kPexQbN2mHLiW';

try {
	$db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password); 
} catch(PDOException $ex) {
	echo("Could not connect to database.<br>");
	echo($ex->getMessage());
	exit;
}
?>S