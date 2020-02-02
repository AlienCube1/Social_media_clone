<?php
include_once('config.php');


function delete_post($id){
  global $pdo;
  $delete = "DELETE FROM Postovi WHERE id = :id";
  $stmt = $pdo->prepare($delete);
  $stmt->execute(['id' => $id]);

  header("location: main.php");


}
function delete_likes($id){
  global $pdo;
  $delete_stmt = "DELETE FROM Liked_posts WHERE post_id = :post_id";
  $stmt = $pdo->prepare($delete_stmt);
  $stmt->execute(['post_id' => $id]);

}


if(isset($_POST['delete_post'])){
  $id = $_POST['post_id'];
  echo($id);
  delete_post($id);
  delete_likes($id);
}





 ?>
