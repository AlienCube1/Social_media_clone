<?php
session_start();
if(!$_SESSION['username']){
	header("location: index.php", true, 301); exit;

}
?>



<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" type="text/css" href="/style/style.css">
	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="/javascripts/application.js" type="text/javascript" charset="utf-8" async defer></script>
	<title>AnonyNet</title>


</head>
<body id="mainBody">
	<header id="nav-wrapper">
    <nav id="navbar">
      <div class="nav left">
       <h1 id="logo"><a href="main.php">AnonyNet</a></h1>


      </div>

      <div class="nav center">
      	<img src="/images/newpost2.png" alt="New post" onclick="newPost()">
      </div>
      <div class="nav right">
        <a href="main.php" class="nav-link active">Home</a>
        <a href="profile.php" class="nav-link">Profile</a>
        <a href="message.php" class="nav-link">Messages</a>
        <a href="logout.php" class="nav-link">Log out</a>
      </div>







    </nav>
  </header>
  <div id="content">
  	             <!---Ovdje ti se prikazuje sta je nasao, ako ces sta mjenjat, mjenjaj to. -->
		<div id="searchBar">


			<form>
				<p id="searchLabel">Search:</p>
				<input type="text" onkeyup="showHint(this.value)">
			</form>

			<p><span id="txtHint"> </span> </p>
		</div>

  	<div id="newpost">
		<form action='create.php' method="POST">
			<div id="textPostArea">
				<label class="control-label" for="Title">Title</label>
				<input id="titleBox" type='text' name='Title'>
				<label class="control-label" for="Desc">Description</label>
				<textarea id="descBox" name='Desc' style="resize:none"></textarea>
			</div>
			<div id="imagePostArea">
				<input type="file" id="uploadFile" onchange="readURL(this);"/>
				<img id="image" src="/images/uploadFile.png" alt="your image"/>
				<input class="buttons postnew" type='submit' name='create_post' value="Post">
			</div>
		</form>
	</div>
		<div id="posts">


			<p><?php
			include_once('config.php');
			global $pdo;

	    $id = 1;
	    $sql ="SELECT * FROM Postovi ORDER BY id DESC";
	  	$sql_stmt = $pdo->prepare($sql);
	  	$sql_stmt->execute(['id'=>$id]); //// Ne shvacam zasto je ovo potrebno, dosl. samo pointa na to sta je id koji ne postoji u queryu?
	    $post = $sql_stmt->fetchAll(PDO::FETCH_ASSOC);
	    foreach($post as $row){
				echo "<div class='post'>";
				$current = "<a href='https://marcelbockovac.from.hr/show_profile.php?profile=" . $row['Username'] . "'>".$row['Username'] . "</a>";
				?>

				<p class="postedBy"><?php echo $current ?></p>

				<p class="postTitle"><?php echo $row['Title'] ?></p>

				<p class="postDesc"><?php echo $row['Description'] ?></p>

				<p class="postTime"><?php echo $row['Time_of_post'] ?></p>

				<p class="postDate"><?php echo $row['Date_of_post'] ?></p>

				<p class="postLikes" id='results'><?php echo $row['Likes'] ?> </p>




				<div class="buttondivs">



				 <script>
				function SubmitFormData() {
					<?php
					session_start();
					$_SESSION['liked'] = true;

					 ?>
					var current_likes = document.getElementById("results").innerHTML;
					document.getElementById("submitFormData").disabled = true;
						var post_id = $("#post_id").val();
						var like_post = $("#like_post").val();
						$.post("update.php", { post_id:post_id, like_post:like_post },
						function(data) {
					 //$('#results').html(data);
					 document.getElementById("results").innerHTML =  parseInt(current_likes)+1;
					 $('#myForm')[0].reset();
						});
					}




				</script>


				<!--<form id="myForm" method='post'>
					 <input type='hidden' name='post_id' id='post_id' value='<?php //echo $row['id']; ?>'/>
					 <input type='hidden' name='like_post' id='like_post' value='like_post'/>
					 <input class='buttons'type='button' id='submitFormData' onclick='SubmitFormData();' value='Submit' />
				 </form>-->

				 <!--<form action='update.php' method='POST'>
				 	 <input type='hidden' name='post_id' value= '<?php #echo $row['id']; ?>'>
				 	 <input class="buttons" id="like" type='submit' name='like_post' value='Like'>
				 </form>-->

				 <form id="likePost" action=update.php method='POST'>
					 <input type='hidden' name='post_id' value ='<?php echo $row['id']; ?>'/>
					 <input class='buttons' id='like' type='submit' name='like_post' value='Like'>
				 </form>
				</div>


				<!--<iframe name="votar" id='votar'></iframe> -->
				<div class="buttondivs">
			<form action='update.php' method='POST'>
					 <input type='hidden' name='dis_id' value= '<?php echo $row['id']; ?>'>
					 <input class="buttons" id="dislike" type='submit' name='dis_post' value='Dislike'>
				</form>
		</div>


				<?php
				if ($row['Username'] == $_SESSION['username']){?>
				<div class="buttondivs">
				<form action='delete.php' method='POST'>
					<input type='hidden' name='post_id' value= '<?php echo $row['id'];     ?> '>
					<input class="buttons" id="delete" type='submit' name='delete_post' value='Delete'>
				</form>
		</div>


				<?php
			}
				echo"</div>";
			}


			 ?></p>




    </div>
		<div id="picsOfTheDay">

		<?php
		include_once('config.php');
		$Likes = 0;
		$top_of_day = "SELECT Title,Description,Username,Likes,Date_of_post FROM Postovi ORDER BY Likes DESC";
		$top_of_day_query = $pdo->prepare($top_of_day);
		$top_of_day_query->execute(['Likes'=>$Likes]);
		$post_query = $top_of_day_query->fetchAll(PDO::FETCH_ASSOC);
		//var_dump($post_query);
		$counter = 0;
		foreach($post_query as $postt) {
			if(date("d/m/Y") == $postt['Date_of_post']){
			if($counter>=5){
				break;
			}
			echo"<div>";
			$counter+=1;
			?>
				<p class="postedBy"><?php echo $postt['Username']; ?></p>
				<p class="postTitle"><?php echo $postt['Title']; ?></p>
				<p class="postDesc"><?php echo $postt['Description']; ?></p>
				<p class="topPostLikes"><?php echo $postt['Likes'] . " likes";?></p>

			<?php
			echo"</div>";
				}

		}
echo "</div>";
		 ?>


  </div>
</body>
</html>
<script type="text/javascript">
//Sta je ovo?
function newPost() {
    document.getElementById("newpost").style.visibility = "visible";
}
//Sta je ovo? --Pojma nemam stv, pokusavam skontat al ne ide mi
function readURL(input) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();

           reader.onload = function (e) {
               $('#image')
                   .attr('src', e.target.result);
           };

           reader.readAsDataURL(input.files[0]);
       }
}
function showHint(str) {

		if (str.length == 0) {
				document.getElementById("txtHint").innerHTML = "";
				return;
		} else {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
								document.getElementById("txtHint").innerHTML = this.responseText;
						}
				};
				xmlhttp.open("GET", "search.php?q=" + str, true);
				xmlhttp.send();
		}
}
$("#image").click(function () {
    $("#uploadFile").trigger('click');
});

/* POGLEDAJ OVO ˘˘˘˘˘˘ evo ti i link -> https://www.sanwebe.com/2016/07/ajax-form-submit-examples-using-jquery
				ovo radi al nez kako bi updateao likeove jer ne znam sta ti treba iz responsea

				$("#likePost").submit(function(event){

					var current_likes = document.getElementById("results").innerHTML;

					event.preventDefault(); //prevent default action
					var post_url = $(this).attr("action"); //get form action url
					var request_method = $(this).attr("method"); //get form GET/POST method
					var form_data = $(this).serialize(); //Encode form elements for submission

					$.ajax({
						url : post_url,
						type: request_method,
						data : form_data
					}).done(function(response){ //
						document.getElementById("results").innerHTML =  parseInt(current_likes)+1;
						$("#server-results").html(response);
					});
				});
*/
</script>
