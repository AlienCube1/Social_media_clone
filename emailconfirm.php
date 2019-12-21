<?php

$username = $_GET['username'];
$code = $_GET['code'];
include_once("config.php");

  $sql = "UPDATE Register SET code=0, confirmed=1 WHERE username = :username";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['username' => $username]);

  header("location: main.php");

 ?>
