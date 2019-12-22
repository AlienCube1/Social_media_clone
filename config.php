<?php
$host = "localhost";
$name = "marcelbockovac";
$pw = "Marcel123";
$dbname = 'information';
// SET DSN
$dsn = 'mysql:host='. $host .';dbname='. $dbname;
// Create a PDO instance
$pdo = new PDO($dsn, $name, $pw);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
?>
