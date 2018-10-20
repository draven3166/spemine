<?php
define('BASE_PATH', '/');
include_once ('_constants.php');
$servername = DBHOST;
$username = DBUSER;
$password = DBPASS;
$dbname = DBNAME;
global $conn;
try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo "Error: " . $e->getMessage();
}
require_once '_settings.php';