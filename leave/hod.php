<?php

require_once("db.php");
// Start the session
session_start();
$conn = startdb();

if(isset($_SESSION['hod'])) {

  $sql = "select * from leave_transaction";

  $result = $conn->query($sql);
  $list = array();
  if ($result->num_rows > 0) {    
    while($row = $result->fetch_assoc()) {
        $ele['leave_id'] = $row['id']; /* Leave_transction ID */
        $ele['name'] = $row['name'];
        $tmp_name  = $ele['name']; 
        $ele['type'] = $row['type'];
        $ele['reason'] = $row['reason'];
        $ele['time'] = $row['time'];
        $ele['state'] = $row['state'];
        $ele['days'] = $row['days'];
        $sql111 = "select * from employee where name = \"$tmp_name\";";
        $result111 = $conn->query($sql111);
        while($row1 = $result111->fetch_assoc()) {
          $id111 = $row1['id']; /* The employee ID */
          $status111 = $row1['status']; /* The employee status */
          $ele['id'] = $id111;
          $ele['status'] = $status111;
        }
        $list[] = $ele;
    }
}}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HoD Panel</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="jquery-ui/jquery-ui.theme.min.css">

  </head>
  <body>

    <div class="row">
      <div class="row text-center">
        <h1>Hello, HOD</h1>
        <a href="logout.php" class="button">Logout</a>
      </div>
      <br><br><br>
      <hr>
  <div class="row">
  <div class="row text-center">
    <h3>Apply/Deny Requests</h3>
  </div>
<?php
      foreach ($list as $ele) {
            if ($ele['type'] == "paid") {
              $type = "Earned";
            }
            else $type="Casual";
            
            if($ele['state']==0) {
          ?><div class="card box" style="padding:2em;">
            <?php
              echo "ID:<span class='id'> ".$ele['leave_id']."</span> <br>";
              echo "Name: <span class='name'>".$ele['name']."</span> <br>";
              echo "Status: ".$ele['status']." <br>";
              echo "Time of Application: ".$ele['time']."<br>";
              echo "Type of leave: ".$type."<br>";
              echo "Reason: ".$ele['reason']."<br>";
              echo "Number of days: <span class='days'>".$ele['days']."</span><br>";
              echo "<div style=\"display:none;\" class=\"type\">".$ele['type']."</div><br>";
              echo '<div class="option">
              <a class="button approve">APPROVE</a>
              <a class="button rejectshow">REJECT</a></div>
              <div id="reasoner">
                <p>Reason for rejection:</p>
                <textarea id="reason"></textarea>
                <a class="button reject">REJECT</a>
              </div>
              ';
          ?></div>
            <?php
          }
          } // foreach

?>

  </div>

  <div class="row">
  <hr>
  <div class="row text-center">
    <h3>History</h3>
  </div>
  <table>
    <tr>
      <td>ID</td>
      <td>Name</td>
      <td>Status</td>
      <td>Time</td>
      <td>Type</td>
      <td>Reason</td>
      <td>Days</td>
      <td>Status</td>
    </tr>
<?php
  foreach ($list as $ele) {
            if ($ele['type'] == "paid") {
              $type = "Earned";
            }
            else $type="Casual";
            
            if ($ele['state'] == 0) {
              $state_text = "Pending";
            }
            else  if ($ele['state'] == 1) {
              $state_text = "Approved";
            } 
            else {
              $state_text = "Rejected";
            }

            echo "<tr>";
          
              echo "<td>".$ele['leave_id']."</td>";
              echo "<td>".$ele['name']."</td>";
              echo "<td>".$ele['status']."</td>";
              echo "<td>".$ele['time']."</td>";
              echo "<td>".$type."</td>";
              echo "<td>".$ele['reason']."</td>";
              echo "<td>".$ele['days']."</td>";
              echo "<td>".$state_text."</td>";
              echo '</tr>';
                    
          } // foreach
?>
  </div></table>
  
    </div>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    <style>
      #reasoner {
        display:none;
      }
    </style>
    <script>

      $(".approve").click(function(){
        var id = $(this).parent().parent().children(".id").text();
        var days = $(this).parent().parent().children(".days").text();
        var type = $(this).parent().parent().children(".type").text();
        var name = $(this).parent().parent().children(".name").text();

        var datastr = "id="+id+"&status=1&reason=abc&days="+days+"&type="+type+"&name="+name;
        $.ajax({
          url: "/leave/hodfunctions.php",
          method: "POST",
          data: datastr,
          success: function ab(a,b,c) {
            console.log(a+c+b);
            alert("Approved holiday. Reload page.");
          }
        });
      });

      $(".rejectshow").click(function(){
        $(".rejectshow").hide();
        $("#reasoner").show();

      });
      $(".reject").click(function(){
        var id = $(this).parent().parent().children(".id").text();
        var reason = $("#reason").val();
        var datastr = "id="+id+"&status=2&reason="+reason+"&days=0&type=wtv&name=name";
        $.ajax({
          url: "/leave/hodfunctions.php",
          method: "POST",
          data: datastr,
          success: function ab(a,b,c) {
            console.log(a+c+b);
            alert("Rejected holiday. Reload page.");
          }
        });
      });
    </script>
		<style>
	body{
		background:url("hod.jpg") no-repeat;
		background-size:cover;
		height:100% !important;
	}
	h1 {
		color: white;
		}
	h3 {
		color: white;
		}
	</style>
  </body>
</html>
