<?php

require_once("db.php");
// Start the session
session_start();

$conn = startdb();


if(isset($_POST['username'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $doj = $_POST['doj'];
  $qual = $_POST['qual'];
  $dob = $_POST['dob'];
  $status = $_POST['status'];
  $fullname = $_POST['fullname'];

  if($password != $cpassword) {
    die("Passwords do not match!");
  }
  $date_join = new DateTime($doj);
  $today = new DateTime();
  $days = $today->diff($date_join)->format("%a");
  $years1 = (int)floor($days/365);

  echo "year => $years1 ";

  $paid = 10 * $years1;
  $sessionstr = "";
  for($i=1;$i<=$years1;$i++) {
    $theyear = $date_join;
    $theyear->add(date_interval_create_from_date_string('1 year'));
    $leaves = $i * 10;
    $sessionstr = $sessionstr.$theyear->format('Y')." -> ". $leaves."\n";
  }
  echo $sessionstr;

  /* Casual mods for date join*/
   if($years1>=2) {
    $casual = 15;
  }else {
    /* The monthly algorithm */
    $months1 = (int)floor($days/30); /* One month = 30 approx*/ 
    echo "Number of months = $months1";
    $casual = $months1 % 12;
  }

  $sql = "insert into employee(name,password,doj,qual,dob, status,fullname) values 
          (\"$username\", \"$password\", \"$doj\", \"$qual\", \"$dob\",\"$status\",\"$fullname\"); ";
  $result = $conn->query($sql);

  /* Additional operations */
  $sql100 = "select * from employee where name=\"$username\"";

  $result100 = $conn->query($sql100);

  if ($result100->num_rows > 0) {    // Set session variables
    // output data of each row
    while($row = $result100->fetch_assoc()) {
        $id = $row["id"];
    }
  }
  $sql101 = "insert into leave_master(id, earned, casual, session) values($id,$paid,$casual,\"$sessionstr\")";
  $result101 = $conn->query($sql101);
  echo "Successfully added Employee \"$username\" ! <br> Note: Days after joining = $days ";

}




if(isset($_SESSION['admin'])) {

  if ($_SESSION['admin'] != 1 ) {
      die("<h1>Error</h1><br><h4>Restricted Access to this page!</h4>");
  }
  
} else {
    die("<h1>Error</h1><br><h4>Restricted Access to this page!</h4>");
}
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
        <link rel="stylesheet" href="jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="jquery-ui/jquery-ui.theme.min.css">

  </head>
  <body>

    <div class="row">
      <div class="large-12 columns text-center"><br>
        <h1>Administrator Panel</h1>
        <a href="logout.php" class="button">Logout</a>
        <hr>
        <p>Enter teacher details</p>
        <br>
      </div>
    </div>

    <div class="row">
      <div class="large-12 columns">
        <form action="admin.php" method="POST" id="adminform">
          
          <label for="username">Full Name:</label>
          <input type="text" name="fullname" id="fullname">

          <label for="username">Username:</label>
          <input type="text" name="username" id="username">

          <label for="name">Password:</label>
          <input type="password" name="password" id="pass">

          <label for="name">Confirm Password:</label>
          <input type="password" name="cpassword" id="cpass">

          <label for="name">Date of Joining:</label>
          <input type="text" name="doj" id="doj" >
      
          <label for="name">Designation:</label>
          <select name="qual" id="qual">
            <option value="xxx">Professor</option>
            <option value="yyy">Assistant Professor</option>
            <option value="zzz">Associate Professor</option>
          </select>

          <label for="name">Date of Birth:</label>
          <input type="text" name="dob" id="dob">

          <label for="name">Status:</label>
          <select name="status" id="status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
            <option value="NA">Not Applicable</option>
          </select>
  <br>
          <input type="button" value="Add Employee" class="button" onClick='sForm()'>

        </form>

      </div>
    </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="jquery-ui/jquery-ui.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    <script>
        $( function() {
    //$( "#doj" ).datepicker();
    $( "#dob" ).datepicker();
    // Set Join date validation
      var date = new Date();
      var datestring = ("0" + (date.getMonth() + 1).toString()).substr(-2) + "/" + ("0" + date.getDate().toString()).substr(-2)  + "/" + (date.getFullYear().toString());
      $("#doj").val(datestring);
    } );

    function sForm() {
      var today = new Date();
      var dobtxt = $("#dob").val();
      var dob = new Date(dobtxt);
      var yr = today.getFullYear() - dob.getFullYear();
      if(yr<25) {
        alert("Age is less than 25!");
      }
      else if(yr>70) {
        alert("Age is more than 70!");
      }
      else {
        /* More validation */
          var username = $("#username").val();
          $("#username").val(username.trim());
          var fullname = $("#fullname").val();
          $("#fullname").val(fullname.trim());

        $( "#adminform" ).submit();
      }
        }
    </script>
	<style>
	body{
		background:url("admin.jpg") no-repeat;
		background-size:cover;
		height:100% !important;
	}
	</style>
  </body>
</html>
