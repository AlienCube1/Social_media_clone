<?php
include_once('config.php');

function login($username,$password){

  global $pdo;
  $hashed = md5($password);
  $get_user = "SELECT username,password FROM Register WHERE username =:username && password =:password && confirmed = :confirmed";
	$stmt = $pdo->prepare($get_user);
	$stmt->execute(['username' => $username, 'password' => $hashed, 'confirmed' => 1]);
	$post = $stmt->fetchAll();
  if($post){
    echo("TU");
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['loggedin'] = true;
    $_SESSION['wrong_username_or_pw'] == false;
    setcookie("username", $_POST['username'], time()+3600);
    setcookie("password", $_POST['password'], time()+3600);
    header("location: main.php");
    unset($_SESSION['wrong_username_or_pw']);
  }
  else{
    session_start();
    $_SESSION['wrong_username_or_pw'] = true;
    header("location: index.php");
  }
}




if(isset($_POST['login_button'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  login($username, $password);
}


 ?>
