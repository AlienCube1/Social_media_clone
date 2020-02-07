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

      <div class="nav right">
        <a href="main.php" class="nav-link active">Home</a>
        <a href="profile.php" class="nav-link">Profile</a>
        <a href="message.php" class="nav-link">Messages</a>
        <a href="logout.php" class="nav-link">Log out</a>
      </div>
    </nav>
  </header>
  <div id="content">
<?php
include_once('config.php');
session_start();
$username = $_GET['profile'];
$sql = "SELECT username,date_of FROM Register WHERE username =:username";
$sql_stmt = $pdo->prepare($sql);
$sql_stmt->execute(['username'=>$username]);
$post = $sql_stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($post as $row){
  echo "<p> Username: " . $row['username'] . "</p> ";
  echo "<br>";
  echo "<p> Joined: " . $row['date_of'] . "</p>";
}
?>
<form action='create.php' method='post'>
  <input type='hidden' name='user_to_add' value='<?php echo $username ?>'>
  <input type='hidden' name='current_user'value="<?php echo $_SESSION['username'] ?>">
  <input type='submit' name='Add_friend' value='Add Friend'>
</form> 

  </div>
</body>
</html>
<?php





 ?>
