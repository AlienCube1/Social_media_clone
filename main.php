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
	<title>Lorem ipsum...</title>
</head>
<body id="mainBody">
	<header id="nav-wrapper">
    <nav id="navbar">
      <div class="nav left">
       <h1 id="logo"><a href="main.php">Lorem ipsum...</a></h1>

      </div>
      <div class="nav center">
      	<img src="/images/newpost.png" alt="New post" onclick="newPost()">
      </div>
      <div class="nav right">
        <a href="main.php" class="nav-link active">Home</a>
        <a href="#about" class="nav-link">Profile</a>
        <a href="#work" class="nav-link">Messages</a>
        <a href="logout.php" class="nav-link">Log out</a>
      </div>
    </nav>
  </header>
  <div id="content">
  	<div id="newpost">
		<form action='create.php' method="POST">
			<label class="control-label" for="Title">Title</label>
			<input type='text' name='Title'>
			<label class="control-label" for="Desc">Description</label>
			<input type='text' name='Desc'>
			<input class="buttons postnew" type='submit' name='create_post' value="Post">
		</form>
	</div>
		<div id="posts">

<!--- Nemoj se usrat sto ti stranica ne radi kak je red, ja sam kriv, treba uredit ovaj ispis samo
svaki row je jedan dio sto treba ispisat, zatvoris php tag napises svoj html element i opet otvoris php tag -->
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
				?>
				<p class="postedBy"><?php echo $row['Username'] ?></p>


				<p class="postTitle"><?php echo $row['Title'] ?></p>

				<p class="postDesc"><?php echo $row['Description'] ?></p>

				<p class="postTime"><?php echo $row['Time_of_post'] ?></p>

				<p class="postDate"><?php echo $row['Date_of_post'] ?></p>

				<p class="postLikes"><?php echo $row['Likes'] ?> likes</p>

				<div class="buttondivs">
				<form action='update.php' method='POST'>
					 <input type='hidden' name='post_id' value= '<?php echo $row['id']; ?>'>
					 <input class="buttons" id="like" type='submit' name='like_post' value='Like'>
				</form>
				</div>

				<div class="buttondivs">
				<form action='update.php' method='POST'>
					 <input type='hidden' name='dis_id' value= '<?php echo $row['id']; ?>'>
					 <input class="buttons" id="dislike" type='submit' name='dis_post' value='Dislike'>
				</form>
				</div>

				<div class="buttondivs">
				<form action='delete.php' method='POST'>
					<input type='hidden' name='post_id' value= '<?php echo $row['id'];     ?> '>
					<input class="buttons" id="delete" type='submit' name='delete_post' value='Delete'>
				</form>
				</div>
				<?php
				echo"</div>";
			}


			 ?></p>


    </div>
    <div id="picsOfTheDay">
      <div>
      <p>today's most liked post</p>
      </div>

      <div>
      <p>today's most liked post #2</p>
      </div>

      <div>
      <p>today's most liked post #3</p>
      </div>

      <div>
      <p>i tako dalje</p>
      </div>

    </div>
  </div>
</body>
</html>
<script type="text/javascript">
function newPost() {
    document.getElementById("newpost").style.visibility = "visible";
}
</script>
