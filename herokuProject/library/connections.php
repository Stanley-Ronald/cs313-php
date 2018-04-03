<?php


function herokuConnect() {
	$server = 'localhost';
	$dbname= 'heroku';
	$username = 'mgs_user';
	$password = 'pa55word';
	$dsn = "mysql:host=$server;dbname=$dbname";
	$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	
	// Create the actual connection object and assign it to a variable
try {
	
	$link = new PDO($dsn, $username, $password, $options);
	return $link;
} 
catch(PDOException $e) 
{
	header('Location: http://localhost/herokuProject/');
	exit;
}
}
 ?>
