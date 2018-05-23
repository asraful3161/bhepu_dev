<?php
// Error Reporting Turn On
ini_set('error_reporting', E_ALL);

// Setting up the time zone
date_default_timezone_set('Asia/Dhaka');

// Host Name
$dbhost = 'localhost';

// Database Name
$dbname = 'bhepu_dev';

// Database Username
$dbuser = 'root';

// Database Password
$dbpass = '12345678';

$dbport = 3307;

// Defining base url
define("BASE_URL", "http://localhost/bhepu/");

// Getting Admin url
define("ADMIN_URL", BASE_URL . "admin" . "/");

try {
	$pdo = new PDO("mysql:host={$dbhost};port={$dbport};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $exception ) {
	echo "Connection error :" . $exception->getMessage();
}

require 'Medoo.php';

$medoo = new \Medoo\Medoo([

	'database_type' => 'mysql',
	'database_name' => $dbname,
	'server' => $dbhost,
	'username' => $dbuser,
	'password' => $dbpass,
	'charset' => 'utf8',
	'port' => $dbport

]);