<?php

session_start();
unset($_SESSION["loggedin"]);
unset($_SESSION["username"]);
unset($_SESSION['wrong_username_or_pw']);
session_destroy();
setcookie('username', "", time() - 3600);
setcookie('password', "", time() - 3600);
header("Location: index.php");


 ?>
