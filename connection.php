<?php 

date_default_timezone_set("Asia/Manila");

$dsn = "mysql:host=localhost;dbname=nexus";
$username = "root";
$password = "";
$options = array(
PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

try {
$connection = new PDO($dsn,$username,$password,$options);
}

catch (PDOException $e) {
echo "Error!".$e->getMessage();
$connection.die();
}