<?php 

	

	include 'functions.php';

	date_default_timezone_set('Asia/Calcutta');

              



    try {

    	$con = connect($config);

    	if(!$con)die("Database connection aborted");

		$query = "INSERT INTO bloggers_category (category_name) VALUES (:category_name)";

    	$bind = array(':category_name'=>$_POST['category_name']); 

    	$result = insertto($query, $bind, $con);

        

    			echo "true";	

    } catch (Exception $e) {

    	echo $e;

    }

         



 ?>