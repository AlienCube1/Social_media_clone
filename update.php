<?php
include_once('config.php');
function update_likes($likes, $post_id){
  echo "HAAAAI";
  global $pdo;
  $sql = "UPDATE Postovi SET Likes = :likes WHERE id = :post_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['likes'=> $likes, "post_id" => $post_id ]);
  //$_SESSION['is_liked'] = true;

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
/*  echo "<br>"."Dislikeee";
  $delete = "DELETE FROM Liked_posts WHERE post_id = :post_id";
  $stmt = $pdo->prepare($delete);
  $stmt->execute(['post_id' => $post_id]);
  update_likes(get_likes($post_id,0 ),$post_id);*/


/*function update_likes($likes, $post_id){

  global $pdo;
  $sql = "UPDATE Postovi SET Likes = :likes WHERE id = :post_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['likes'=> $likes, "post_id" => $post_id ]);
  $_SESSION['is_liked'] = true;

header("location: main.php");
}

function dislike($likes, $post_id){
  if($_SESSION['is_liked']){
  $likes = $likes-2;
  global $pdo;
  $sql_dis = "UPDATE Postovi SET Likes = :likes WHERE id = :post_id";
  $dis_stmt = $pdo->prepare($sql_dis);
  $dis_stmt->execute(['likes'=>$likes, "post_id" => $post_id]);
  //header("location: main.php");
  $_SESSION['is_liked'] = false;
}

}





function get_likes($id){
  global $pdo;

  $sql_select = "SELECT Likes FROM Postovi WHERE id = :post_id";
  $select_stmt = $pdo->prepare($sql_select);
  $select_stmt->execute(['post_id' => $id]);
  $post_select = $select_stmt->fetch(PDO::FETCH_ASSOC);
  //var_dump($post_select);
  foreach($post_select as $row){
    echo (int)$row;
  }


  echo (int)$post_select['Likes'];
  $post_like= intval($post_select['Likes'] + 1);
  return $post_like;
  //update_likes($post_like, $id);

}
function get_dis($id){
  global $pdo;

  $sql_select = "SELECT Likes FROM Postovi WHERE id = :post_id";
  $select_stmt = $pdo->prepare($sql_select);
  $select_stmt->execute(['post_id' => $id]);
  $post_select = $select_stmt->fetch(PDO::FETCH_ASSOC);
if($alredy_disliked == false){
  $sql_dis = "UPDATE Liked_posts SET liked = :liked";
  $dis_stmt = $pdo->prepare($sql_dis);
  $dis_stmt->execute(['liked'=>0]);


  echo (int)$post_select['Likes'];
  $post_like= intval($post_select['Likes'] - 1);
  return $post_like;}
  //update_likes($post_like, $id);
  $alredy_disliked = true;
  global $alredy_disliked;
  global $alredy_liked;
  $alredy_liked = false;


}
function like($post_id, $user_id){
  echo "Again";
  global $pdo;
  $select_likes = "SELECT liked FROM Liked_posts WHERE user_id = :user_id && post_id = :post_id";
  $likes_stmt = $pdo->prepare($select_likes);
  $likes_stmt->execute(['user_id' => $user_id, 'post_id' => $post_id]);
  $likes_select = $likes_stmt->fetch();
  if($likes_select){
    $sql_dis = "UPDATE Liked_posts SET liked = :liked";
    $dis_stmt = $pdo->prepare($sql_dis);
    $dis_stmt->execute(['liked'=>1]);
    return 1;

  }
  $zero_one = $likes_select->liked;

  if($zero_one == 0){
    if($create!=1){
    echo "f";
    #echo "Post Id: " . $post_id . "<br>" . "User Id: " . $user_id;
    $sql = "INSERT INTO Liked_posts(user_id,post_id,liked) VALUES (:user_id, :post_id, :liked)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["user_id"=>$user_id, "post_id" =>$post_id,"liked"=>1]);
    $create = true;
    return 1;
  }
}


}

function like_nope($post_id, $user_id){
  global $pdo;
  $select_likes = "SELECT liked FROM Liked_posts WHERE user_id = :user_id && post_id = :post_id";
  $likes_stmt = $pdo->prepare($select_likes);
  $likes_stmt->execute(['user_id' => $user_id, 'post_id' => $post_id]);
  $likes_select = $likes_stmt->fetch();
  $zero_one = $likes_select->liked;
  if($zero_one == 1){
    return 0;
  }


}*/

 ?>
