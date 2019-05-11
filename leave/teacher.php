<?php

require_once("db.php");
// Start the session
session_start();
$conn = startdb();

if(isset($_SESSION['username'])) {
  $username = $_SESSION['username'];

  $sql = "select * from employee where name=\"$username\"";

  $result = $conn->query($sql);

$fullname = "";

  if ($result->num_rows > 0) {    // Set session variables
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $fullname = $row["fullname"];
    }


      $sql100 = "select * from leave_master where id=$id";
      $result100 = $conn->query($sql100);
      while($row = $result100->fetch_assoc()) {
          $paid = $row["earned"];
          $casual = $row["casual"];
      }

        $paidval =  $paid;
        if ($paid<0) {
          $paid_status = "No more leaves left";
        }
        else {
          $paid_status = "$paid leaves left";
        }

        $casualval = $casual;
        if ($casual<0) {
          $casual_status = "No more leaves left";
        }
        else {
          $casual_status = "$casual leaves left";
        }

        if(isset($_POST["from"]) && isset($_POST["to"]) ) {
          $from = strtotime($_POST["from"]);
          $to = strtotime($_POST["to"]);
          if ($from > $to) {
            die("Invalid date set!");
          }
          
          $datediff = $to - $from;
          $days = floor($datediff / (60 * 60 * 24));
          $type = $_POST["type"];
          $reason = $_POST["reason"];
          $proceed = 0;
          if($type=="paid" && $days <= $paidval) {
            $paidleft = $paid - $days;
            $sql1 = "update teacher set paid=$paidleft where name=\"$username\""; /* Legacy*/
            $result1 = $conn->query($sql1);
            $proceed = 1;
          }
          else if($type=="casual" && $days <= $casual) {
            echo "$days<br>";
            $casualleft = $casual - $days;
            $sql2 = "update teacher set casual=$casualleft where name=\"$username\"";  /* Legacy*/
            $result2 = $conn->query($sql2);
            $proceed = 1;
          } else {
            die("Invalid dates chosen!");
          }
          if($proceed) {
              $time = date(DATE_RFC2822);
              $sql = "insert into leave_transaction(name,type,reason,time,days,hod_reason,emp_id) values(\"$username\",\"$type\", \"$reason\",\"$time\", $days, \"\",$id)";  
              $result = $conn->query($sql);
              echo "<br> Successfully applied for leave";
          }
        }

  } else {
      die("Error retreiving data");
  }

}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Leave Panel</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="jquery-ui/jquery-ui.theme.min.css">

  </head>
  <body>

    <div class="row">
      <div class="row text-center">
        <h1>Teacher Management Area</h1>
        <a href="logout.php" class="button">Logout</a>
      </div>
      <br><br><br>
      <div class="row">
        <div style="background-color: #fff;">
        <h4>Hello, <?php echo $fullname; ?></h4>
          <table>
            <tr>
              <td><strong>Type</strong></td>
              <td><strong>Days Left</strong></td>
            </tr>
            <tr>
              <td>Earned</td>
              <td><?php echo $paid_status; ?></td>
            </tr>
            <tr>
              <td>Casual</td>
              <td><?php echo $casual_status; ?></td>
            </tr>
          </table>
        </div>
      </div>

      <div class="row">
        <div style="background-color: #fff;">
        <h4>Leave Application Status</h4>
          <table>
            <tr>
              <td><strong>Type</strong></td>
              <td><strong>Reason</strong></td>
              <td><strong>Days</strong></td>
              <td><strong>Time</strong></td>
              <td><strong>Status</strong></td>
            </tr>

            <?php

            $sql10 = "select * from leave_transaction where name=\"$username\"";
              $result10 = $conn->query($sql10);

              if ($result10->num_rows > 0) {    // Set session variables
                // output data of each row
                while($row = $result10->fetch_assoc()) {
                    $type = $row["type"];
                    if($type=="paid") {
                      $type="Earned";
                    }
                    $reason = $row["reason"];
                    $days = $row["days"];
                    $time = $row["time"];
                    $id = $row["id"];
                    $state = 0;
                    $reasons = "";
                    $state = $row["state"];
                    $reasons = $row["hod_reason"];
                    if($state==0) {
                      $text = "Pending";
                    }
                    else if($state==1) {
                      $text = "Approved";
                    }
                    else if($state==2) {
                      $text = "Rejected. <br>Reason:$reasons";
                    }

                    echo "<tr>
                      <td>$type</td>
                      <td>$reason</td>
                      <td>$days</td>
                      <td>$time</td>
                      <td>$text</td>
                        </tr>";

                }
              }

            ?>

          </table>
        </div>
      </div>


  <hr>

  <div class="row">
  <div class="row text-center">
    <h3>Apply for a leave</h3>
  </div>
    <form action="teacher.php" id="ApplyForm" method="POST">
      <label for="from">From</label>
      <input type="text" name="from" id="from" >
      <label for="to">To</label>
      <input type="text" name="to" id="to">
      <textarea name="reason" cols="30" rows="10"></textarea>
      <select name="type" id="typeofleave">
        <option value="paid">Earned</option>
        <option value="casual">Casual</option>
      </select>
      <input type="button" value="Apply" class="button" onclick="Apply()">
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
    $( "#from" ).datepicker();
    $( "#to" ).datepicker();

  } );

  function Apply() {
    var from = new Date($("#from").val());
    var to = new Date($("#to").val());
    var timeDiff = Math.abs(to.getTime() - from.getTime());
    var days = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
    console.log(days);

    var type = $("#typeofleave").val();
    var allok = 0;
    if(type=="paid") {
      if(days<3) {
        alert("Cannot apply less than 3 days for earned leaves");
      }
      else {
        allok = 1;
      }
    }
    if(type=="casual") {
      if(days>3) {
        alert("Cannot apply more than 3 days for casual leaves ");
      }
      else {
        allok = 1;
      }
    }
    if(allok) {
      $("#ApplyForm").submit();
    }
  }

  </script>
  <style>
	body{
		background:url("teacher.jpg") no-repeat;
		background-size:cover;
		height:100% !important;
	}
	h1 {
		color: black;
		}
	</style>
  </body>
</html>
