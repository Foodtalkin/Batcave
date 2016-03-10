<?php 

	

	include 'functions.php';

	date_default_timezone_set('Asia/Calcutta');

              



    try {

    	$con = connect($config);

    	if(!$con)die("Database connection aborted");

		$query = "INSERT INTO vendors ( category,  contact_name, phone,

        email, org_name, location, capacity, address) VALUES (:category, :contact_name, :phone,

        :email, :org_name, :location, :capacity, :address)";

    	$bind = array(':category'=>$_POST['category'], ':contact_name'=>$_POST['contact_name'] ,':phone'=>$_POST['phone'],

            ':email'=>$_POST['email'], ':org_name'=>$_POST['org_name']

            ,':location'=>$_POST['location'] ,':capacity'=>$_POST['capacity'],':address'=>$_POST['address']); 

    	$result = insertto($query, $bind, $con);

        

    			echo "true";	

    } catch (Exception $e) {

    	echo $e;

    }

         



 ?>