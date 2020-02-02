<html>
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
<style>

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f1f1f1;
}

li a {
  display: block;
  color: #000;
  padding: 8px 16px;
  text-decoration: none;
}

/* Change the link color on hover */
li a:hover {
  background-color: #555;
  color: white;
}
#para {
  position:relative;
  left:400px;
}
</style>
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
        <a href="#work" class="nav-link">Messages</a>
        <a href="logout.php" class="nav-link">Log out</a>
      </div>
    </nav>
  </header>



<div class="profile_nav">
  <ul>
  <li><button type='button' onclick='my_acc()'>My Account</button></li>
  <li><a href="news.asp">Privacy</a></li>
  <li><a href="contact.asp">Administration</a></li>
</ul>
</div>
<div id="para">
</div>


<script>
function my_acc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("para").innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "acc_man.php", true);
  xhttp.send();
}
</script>



</body>



</html>






<?php




 ?>
