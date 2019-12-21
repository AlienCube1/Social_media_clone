<?php

include_once("config.php");
include('header.php');
$confirm_code = rand();


function register_insert($username, $password, $email, $code){
  global $pdo;
  global $confirm_code;
  $hashed = md5($password);
  $sql = "INSERT INTO Register(username,password,email,code) VALUES (:username, :password, :email, :code)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['username' => $username, 'password' => $hashed, 'email' => $email, 'code' => $code]);
  $message = "
			Potvrdite Vaš email kako bi počeli koristiti našu web stranicu.
			Pritisnite link ispod kako bi potvrdili svoj račun.
			https://marcelbockovac.from.hr/emailconfirm.php?username=$username&code=$code
			";
			mail($email, "Potvrdite vašu email adresu", $message, "From: dimworks.contact@gmail.com");
			echo "Uspješno ste napravili račun, poslali smo aktivacijski email na Vašu adresu: " . $email . "<br>";
			echo " Niste dobili mail? Molimo provjerite spam mapu.";
  header("location: index.php", true, 301); exit;
}



function check_avail($username, $mail){
  global $okay_go;
  global $pdo;
  $exists = "SELECT username FROM Register WHERE username =:username OR email=:email";

  $exists_stmt = $pdo->prepare($exists);
  $exists_stmt->execute(['username'=>$username, 'email'=>$mail]);
  $exists_post = $exists_stmt->fetchAll();
  var_dump($exists_post);

  if($exists_post){
    $okay_go = false;
    return $okay_go;
  }
  elseif(!$exists_post) {
    echo"Sve 5";
    $okay_go = true;
    return $okay_go;
  }
  return $okay_go;
}


if(isset($_POST['register_button'])){
  $okay_go = false;
  $username = $_POST['username'];
  $password = $_POST['password'];
  $repeatpw = $_POST['password_confirm'];
  $email = $_POST['email'];
  if($password == $repeatpw){
    check_avail($username, $email);
    if($okay_go == true){
        session_start();
        $_SESSION['user_email_exists'] = false;
        register_insert($username, $password, $email,$confirm_code);

        header("location: main.php");
        unset($_SESSION['user_email_exists']);
        
}
  else{
    session_start();
    $_SESSION['user_email_exists'] = true;
    echo "Username or email alredy exists!";
    header("location: index.php");
  }

 }

elseif($password != $repeatpw){
  session_start();
  $_SESSION['pw_not_matching'] = true;
  echo "Lozinke se ne podudaraju!";
}
}
 ?>
