<html>
<head>
<style>
#Alredy_exists {
visibility: hidden;

}


</style>


</head>

<body>

Change Username:
<p id='Alredy_exists'> Username alredy exists, please try another username! </p>
<form action='update.php' method='post'>
  <input type='text' name='username'><br>
  <input type='submit' name='send_change' value='Change username'/>
</form>
Change Password:
<form action='update.php' method='post'>
    Current password<input type='password' name='curr_pass'> <br>
    New Password<input type='password' name='new_pw'><br>
    Repeat New Password<input type='password' name='rpsw'><br>
    <input type='submit' name='change_pw' value='Change Password' />
</form>

<?php

session_start();
if($_SESSION['Username_taken'] == true){
  ?>
<script>
alert("KOOOO");
document.getElementById("Alredy_exists").style.visibility = "visible";
</script>
<?php
} ?>


</body>
</html>
