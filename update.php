<?php
include_once('config.php');
function update_likes($likes, $post_id){
  echo "HAAAAI";
  global $pdo;
  $sql = "UPDATE Postovi SET Likes = :likes WHERE id = :post_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['likes'=> $likes, "post_id" => $post_id ]);
  //$_SESSION['is_liked'] = true;
  echo $likes;
header("location: main.php");
}


function get_likes($id,$like_dislike){
  global $pdo;

  $sql_select = "SELECT Likes FROM Postovi WHERE id = :post_id";
  $select_stmt = $pdo->prepare($sql_select);
  $select_stmt->execute(['post_id' => $id]);
  $post_select = $select_stmt->fetch(PDO::FETCH_ASSOC);
  //var_dump($post_select);
  foreach($post_select as $row){
    echo (int)$row;
  }

  if($like_dislike == 1){
    echo (int)$post_select['Likes'];
    $post_like= intval($post_select['Likes'] + 1);
    return $post_like;
  }
  else if($like_dslike == 0){
    echo (int)$post_select['Likes'];
    $post_like= intval($post_select['Likes'] - 1);
    return $post_like;
  }
  //update_likes($post_like, $id);

}
function dislike($post_id, $user_id){
  global $pdo;
  $select_likes = "SELECT liked FROM Liked_posts WHERE user_id = :user_id && post_id = :post_id";
  $likes_stmt = $pdo->prepare($select_likes);
  $likes_stmt->execute(['user_id' => $user_id, 'post_id' => $post_id]);
  $likes_select = $likes_stmt->fetch();

  if($likes_select == true){
    $delete = "DELETE FROM Liked_posts WHERE post_id = :post_id";
    $stmt = $pdo->prepare($delete);
    $stmt->execute(['post_id' => $post_id]);
    update_likes(get_likes($post_id, 0),$post_id);
  }
  header("location: main.php");

}


function like($post_id, $user_id){
  global $pdo;
  $select_likes = "SELECT liked FROM Liked_posts WHERE user_id = :user_id && post_id = :post_id";
  $likes_stmt = $pdo->prepare($select_likes);
  $likes_stmt->execute(['user_id' => $user_id, 'post_id' => $post_id]);
  $likes_select = $likes_stmt->fetch();
  //var_dump($likes_select);
  if($likes_select==true){
    echo "im just chilling";
    header("location: main.php");


  }
  else if(!$select_likes==false){
    $sql = "INSERT INTO Liked_posts(user_id,post_id,liked) VALUES (:user_id, :post_id, :liked)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["user_id"=>$user_id, "post_id" =>$post_id,"liked"=>1]);
    update_likes(get_likes($post_id, 1),$post_id);
  }
  header("location: main.php");

  }


function change_username($current_user, $change_username, $id_of_current_user){
  global $pdo;
  $sql = "SELECT * FROM Register WHERE username = :username";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['username'=>$change_username]);
  $select = $stmt->fetch();
  if(!$select){
    $change_sql = "UPDATE Register SET username = :username WHERE id = :id";
    $change_stmt = $pdo->prepare($change_sql);
    $change_stmt->execute(['username'=> $change_username, "id" => $id_of_current_user ]);
    session_start();
    $_SESSION['Username_taken'] = false;
    $_SESSION['username'] = $change_username;
    header("location: profile.php");
  }
  else{
    echo "Username is taken!";
    session_start();
    $_SESSION['Username_taken'] = true;
    header("location:profile.php");
  }
}


function change_password($username, $current_pass, $new_pass, $rpsw){
  global $pdo;
  $current_pass = md5($current_pass);
  $sql = "SELECT password FROM Register WHERE username = :username";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['username'=> $username]);
  $select = $stmt->fetchAll();
  //var_dump($select);
  //echo $select[0]->password;
  $hashed_current = $select[0]->password;
  if($current_pass = $hashed_current){
    if($new_pass == $rpsw){
    $new_pass = '*-MyNamesJeff-*' . $new_pass . '-+*48812';
    $new_pass = md5($new_pass);
    $change_pw_sql = "UPDATE Register SET password = :password WHERE username= :username";
    $change_pw_sql_stmt = $pdo->prepare($change_pw_sql);
    $change_pw_sql_stmt->execute(['password'=>$new_pass, 'username'=>$username]);
    header("location:profile.php");
  }
}

}
if(isset($_POST['like_post'])){
  echo "You are reaching this page because im currently working on it. Gimme a bit please!" . "<br>" ;

  session_start();
  $post_id = $_POST['post_id'];
  $user_id = $_SESSION['id'];
  echo "post id: " . $post_id . "<br>";
  echo "user id: " . $user_id . "<br>";
  like($post_id, $user_id);

}

if(isset($_POST['dis_post'])){
  session_start();
  $post_id = $_POST['dis_id'];
  $user_id = $_SESSION['id'];
  dislike($post_id, $user_id);
}
if(isset($_POST['send_change'])){
  session_start();
  $current_user = $_SESSION['username'];
  $change_username = $_POST['username'];
  $id_of_current_user = $_SESSION['id'];
  change_username($current_user, $change_username, $id_of_current_user);
}
if(isset($_POST['change_pw'])){
  session_start();
  $username = $_SESSION['username'];
  $current_pass = $_POST['curr_pass'];
  $new_pass = $_POST['new_pw'];
  $rpsw = $_POST['rpsw'];
  change_password($username, $current_pass, $new_pass, $rpsw);
}

 ?>
