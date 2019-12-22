<?php
include_once('config.php');


function delete_post($id){
  global $pdo;
  $delete = "DELETE FROM Postovi WHERE id = :id";
  $stmt = $pdo->prepare($delete);
  $stmt->execute(['id' => $id]);
  header("location: main.php");


}



if(isset($_POST['delete_post'])){
  $id = $_POST['post_id'];
  echo($id);
  delete_post($id);
}





 ?>
