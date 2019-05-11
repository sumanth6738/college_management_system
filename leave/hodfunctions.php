<?php

require_once("db.php");
// Start the session
session_start();
$conn = startdb();

if(isset($_POST['id'])) {
	var_dump($_POST);
  $trans_id = $_POST['id'];
  $status = $_POST['status'];
  $reason = $_POST['reason'];
  $days = $_POST['days'];
  $type = $_POST['type'];
  $name = $_POST['name'];
  if($status == 1) {
  	$reason = "";
  	// Leave approved. Therefore, minus


  	$current_val_query = "select * from employee where name=\"$name\"";
  	$result1 = $conn->query($current_val_query);

  	 if ($result1->num_rows > 0) {    
	    while($row = $result1->fetch_assoc()) {
	        $id = $row["id"];
	    }
  		
  		$query1 = "select * from leave_master where id=$id";
  		$result4 = $conn->query($query1);

	    while($row = $result4->fetch_assoc()) {
	        $paid = $row["earned"];
	        $casual = $row["casual"];
	    }


	    if($type=="paid" && $days <= $paid) {
	    	$new_paid_days = $paid-$days;
	    	$sql2 = "update leave_master set earned=$new_paid_days where id=$id";
            $result2 = $conn->query($sql2);
	    }
	    if($type=="casual" && $days <= $casual) {
	    	$new_casual_days = $casual-$days;
	    	$sql3 = "update leave_master set casual=$new_casual_days where id=$id";
            $result3 = $conn->query($sql3);
	    }
	}
  } 

  $sql = "update leave_transaction set state=$status where id=$trans_id";
  $result = $conn->query($sql);
  $sql = "update leave_transaction set hod_reason=\"$reason\" where id=$trans_id";
  $result = $conn->query($sql);


}
