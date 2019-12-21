 <html>
 <head>
 	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
 	<link rel="stylesheet" type="text/css" href="/style/style.css">
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
 	<title>Lorem ipsum...</title>
 </head>
 <body id="body">
 	<div class="landing" id="title">
 		<h1>Lorem ipsum...</h1>
 	</div>
    <div class="landing" id="login">
    <form class="form-horizontal" action='read.php' method="POST">
      <fieldset>
      <div id="legend">
          <legend class="logAndSignup">Log In</legend>
          <p id='wrongPass'>Wrong password or entered username doesnt match any account. Please try again.</p>
      </div>
      <div class="control-group">
        <!-- Username -->
          <label class="control-label"  for="username">Username</label>
          <div class="controls">
            <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
          </div>
      </div>



      <div class="control-group">
        <!-- Password-->
          <label class="control-label" for="password">Password</label>
          <div class="controls">
            <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
          </div>
      </div>


      <div class="control-group">
        <!-- Button -->
          <div class="controls">
          <button name="login_button" class="btn btn-success">Log In</button>
          </div>
      </div>
      </fieldset>
    </form>
  </div>
 	<div class="landing" id="register">
 		<form class="form-horizontal" action='create.php' method="POST">
  		<fieldset>
    	<div id="legend">
      		<legend class="logAndSignup">Register</legend>
          <p id="invalidUsername">Username or email is already being used by another account. Please try again or log in.</p>
    	</div>
    	<div class="control-group">
      	<!-- Username -->
      		<label class="control-label"  for="username">Username</label>
      		<div class="controls">
        		<input type="text" id="username" name="username" placeholder="" class="input-xlarge">
        		<p class="help-block">Username can contain any letters or numbers, without spaces</p>
      		</div>
    	</div>

    	<div class="control-group">
      	<!-- E-mail -->
      		<label class="control-label" for="email">E-mail</label>
      		<div class="controls">
        		<input type="text" id="email" name="email" placeholder="" class="input-xlarge">
        		<p class="help-block">Please provide your E-mail</p>
      		</div>
    	</div>

    	<div class="control-group">
      	<!-- Password-->
      		<label class="control-label" for="password">Password</label>
      		<div class="controls">
        		<input type="password" id="password" name="password" placeholder="" class="input-xlarge">
        		<p class="help-block">Password should be at least 4 characters</p>
      		</div>
    	</div>

    	<div class="control-group">
      	<!-- Password -->
      		<label class="control-label"  for="password_confirm">Password (Confirm)</label>
      		<div class="controls">
        		<input type="password" id="password_confirm" name="password_confirm" placeholder="" class="input-xlarge">
        		<p class="help-block">Please confirm password</p>
      		</div>
    	</div>

    	<div class="control-group">
      	<!-- Button -->
      		<div class="controls">
        	<button name="register_button" class="btn btn-success">Register</button>
      		</div>
    	</div>
  		</fieldset>
		</form>
 	</div>

  <?php
  session_start();
  if($_SESSION['loggedin'] == true){
    header("location:main.php");
  }
  if($_SESSION['wrong_username_or_pw'] == true){
    ?>
  <script>
  document.getElementById("wrongPass").style.visibility = "visible";
  </script>
  <?php
  }
  if($_SESSION['user_email_exists'] == true){
    ?>
    <script>
    document.getElementById("invalidUsername").style.visibility = "visible";
    </script>
    <?php
  }
   ?>




</body>
</html>
