<?php

$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "12345678";
$DB_name = "bhepu_dev";
$DB_port = 3307;

try{

	$DB_con = new PDO("mysql:host={$DB_host};port={$DB_port};dbname={$DB_name}", $DB_user, $DB_pass);
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){

	$e->getMessage();

}
