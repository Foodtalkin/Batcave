<?php 

	

	include 'functions.php';

	date_default_timezone_set('Asia/Calcutta');

              



    try {

    	$con = connect($config);

    	if(!$con)die("Database connection aborted");

		$query = "INSERT INTO influencer ( category,  name, phone,

        email, location, address) VALUES (:category, :name, :phone,

        :email, :location, :address)";

    	$bind = array(':category'=>$_POST['category'], ':name'=>$_POST['name'] ,':phone'=>$_POST['phone'],

            ':email'=>$_POST['email']

            ,':location'=>$_POST['location'],':address'=>$_POST['address'] ); 

    	$result = insertto($query, $bind, $con);

        

    			echo "true";	

    } catch (Exception $e) {

    	echo $e;

    }

         



 ?>