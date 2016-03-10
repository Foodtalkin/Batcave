<?php 
	session_start();
    if(!isset($_SESSION['name']) || $_SESSION['name']=="")
        header('location:../index.html');	
	//Get the id and update it's status from zero to 1
	include('../pages/functions.php');
	$con = connect($config);
	if(!$con) die("Database connection aborted");

	$conn = connect1($config);

     if(!$conn)die("Database connection aborted");

      $con2 = connect2($config);

    if(!$con2)die("Database connection aborted");

	
	$details = explode('_', $_GET['id']);
	
	if($details[0] == 'adv'){
		$query = "UPDATE adv set `status` = 1 WHERE id = '".$details[1]."'";
		$stmt = $con->prepare($query);
		$result = $stmt->execute(array());
		echo $result;
	}else if($details[0] == 'bad'){
		$query = "UPDATE bad set `status` = 1 WHERE id = '".$details[1]."'";
		$stmt = $conn->prepare($query);
		$result = $stmt->execute(array());
		echo $result;
	}else if($details[0] == 'eve'){
		$query = "UPDATE contact set `status` = 1 WHERE id = '".$details[1]."'";
		$stmt = $con->prepare($query);
		$result = $stmt->execute(array());
		echo $result;
	}else if($details[0] == 'contact'){
		$query = "UPDATE contact set `status` = 1 WHERE id = '".$details[1]."'";
		$stmt = $con->prepare($query);
		$result = $stmt->execute(array());
		echo $result;
	}else if($details[0] == 'inv'){
		$query = "UPDATE Fb_data set `f_status` = 1 WHERE f_id = '".$details[1]."'";
		$stmt = $con->prepare($query);
		$result = $stmt->execute(array());
		echo $result;
	}else if($details[0] == 'adl'){
		$query = "UPDATE application set `status` = 1 WHERE id = '".$details[1]."'";
		$stmt = $con2->prepare($query);
		$result = $stmt->execute(array());
		echo $result;
	}else if($details[0] == 'cdl'){
		$query = "UPDATE contact_form set `status` = 1 WHERE id = '".$details[1]."'";
		$stmt = $con2->prepare($query);
		$result = $stmt->execute(array());
		echo $result;
	}else if($details[0] == 'dl'){
		$query = "UPDATE delhi_live set `status` = 1 WHERE id = '".$details[1]."'";
		$stmt = $con2->prepare($query);
		$result = $stmt->execute(array());
		echo $result;
	}
	
?>