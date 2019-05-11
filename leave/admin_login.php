<?php

require_once("db.php");
// Start the session
session_start();

$conn = startdb();

if(isset($_POST['username'])) {
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$sql = "select * from admin where username=\"$username\" and password=\"$password\"";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {		// Set session variables
		$_SESSION["admin"] = 1;
    header('Location: http://localhost/leave/admin.php');
	} else {
	    die("Invalid login");
	}

}
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
  </head>
  <body>

    <div class="row">
      <div class="large-12 columns text-center">
        <br><h1>Administrator Login</h1><br>
        <br>
        <br>
      </div>
    </div>

    <div class="row">
      <div class="large-12 columns">
        <div class="logincard">
          <form action="admin_login.php" method="POST">
          	<label for="username">Username</label>
          	<input type="text" name="username">

          	 <label for="password">Password</label>
          	<input type="password" name="password">
            
            <input type="submit" value="login" class="button">
          </form>
        </div>
      </div>
    </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
	<style>
	body{
		background: #092756;
		background-size:cover;
		height:100% !important;
	}
	h1 {
		color: white;
		}
	</style>
  </body>
</html>
