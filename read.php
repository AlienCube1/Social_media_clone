<?php
include_once('config.php');

function show_post(){
    global $pdo;
    echo"testis",
    $id = 1;
    $sql ="SELECT * FROM Postovi";
  	$sql_stmt = $pdo->prepare($sql);
  	$sql_stmt->execute(['id'=>$id]); //// Ne shvacam zasto je ovo potrebno, dosl. samo pointa na to sta je id koji ne postoji u queryu?
    $post = $sql_stmt->fetchAll(PDO::FETCH_ASSOC);

    /*
    foreach($post as $row){
      echo $row['Title'] . "<br>";
    }*/


}
////Dodaj u bazu kad se netko prijavio
function login_stamp($username){
  global $pdo;
  $date = date("d/m/Y");
  $time = date("h:i:sa");
  $insert_sql = "INSERT INTO Login_stamps(username,date_of_login,time_of_login) VALUES(:username, :date_of, :time_of)";
  $insert_stmt = $pdo->prepare($insert_sql);
  $insert_stmt->execute(['username'=>$username, 'date_of'=>$date, 'time_of'=>$time]);
}


function login($username,$password){

  global $pdo;
  $hashed = md5($password);
  $get_user = "SELECT username,password FROM Register WHERE username =:username && password =:password && confirmed = :confirmed";
	$stmt = $pdo->prepare($get_user);
	$stmt->execute(['username' => $username, 'password' => $hashed, 'confirmed' => 1]);
	$post = $stmt->fetchAll();
  if($post){
    login_stamp($username);
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
//show_post();
