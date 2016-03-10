<?php 

	

	include 'functions.php';

	date_default_timezone_set('Asia/Calcutta');

              



    try {

    	$con = connect($config);

    	if(!$con)die("Database connection aborted");

		$query = "INSERT INTO media ( category,  name, phone,

        email, publication, location, designation, website) VALUES (:category, :name, :phone,

        :email, :publication, :location, :designation, :website)";

    	$bind = array(':category'=>$_POST['category'], ':name'=>$_POST['name'] ,':phone'=>$_POST['phone'],

            ':email'=>$_POST['email'], ':publication'=>$_POST['publication']

            ,':location'=>$_POST['location'] ,':designation'=>$_POST['designation'],':website'=>$_POST['website']); 

    	$result = insertto($query, $bind, $con);

        

    			echo "true";	

    } catch (Exception $e) {

    	echo $e;

    }

         



 ?>