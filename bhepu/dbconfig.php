<?php

$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "new_carlisting";
$DB_port = 3306;

try{

	$DB_con = new PDO("mysql:host={$DB_host};port={$DB_port};dbname={$DB_name}", $DB_user, $DB_pass);
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$DB_con->exec("set names utf8");

}catch(PDOException $e){

	$e->getMessage();

}
