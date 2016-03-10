<?php 

	

	include 'functions.php';

	date_default_timezone_set('Asia/Calcutta');

              



    try {

    	$con = connect($config);

    	if(!$con)die("Database connection aborted");

		$query = "INSERT INTO bloggers ( category,  name, phone,

        email, blog, location, designation, url) VALUES (:category, :name, :phone,

        :email, :blog, :location, :designation, :url)";

    	$bind = array(':category'=>$_POST['category'], ':name'=>$_POST['name'] ,':phone'=>$_POST['phone'],

            ':email'=>$_POST['email'], ':blog'=>$_POST['blog']

            ,':location'=>$_POST['location'] ,':designation'=>$_POST['designation'],':url'=>$_POST['url']); 

    	$result = insertto($query, $bind, $con);

        

    			echo "true";	

    } catch (Exception $e) {

    	echo $e;

    }

         



 ?>