<?php
include_once('config.php');
function update_likes($likes, $post_id){
  if($_SESSION['!is_liked']){
  global $pdo;
  $sql = "UPDATE Postovi SET Likes = :likes WHERE id = :post_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['likes'=> $likes, "post_id" => $post_id ]);
  $_SESSION['is_liked'] = true;

header("location: main.php");}
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
  /*var_dump($post_select);
  foreach($post_select as $row){
    echo (int)$row;
  }*/


  echo (int)$post_select['Likes'];
  $post_like= intval($post_select['Likes'] + 1);
  return $post_like;
  //update_likes($post_like, $id);


}



if(isset($_POST['like_post'])){
  $post_id = $_POST['post_id'];
  session_start();
  $_SESSION['is_liked']==true{
    dislike(get_likes($post_id), $post_id);
  }
  else{
  update_likes(get_likes($post_id), $post_id);
}
  //header("location: main.php");
}



 ?>
