<?php
	session_start();
	include 'pages/functions.php';
	$con = connect($config);
	if(!$con)die("Database connection aborted");	
	$name =  $_POST['u_name'];
	$password =  $_POST['password'];

	$query = 'SELECT * FROM login_backend WHERE username = :name';
	$bind = array(
			':name' => $name
		);
	$result = query($query, $bind, $con);

	
	if(!$result){
		session_destroy();
		$_SESSION = array();
		header('Location: index.php');
		echo "2";
		die();
	}
	foreach ($result as $key) {
		if($key['password'] === $password){
			$_SESSION['user'] = $key;
			header('Location: pages/index.php');
			echo "0";
		}else{
		session_destroy();
		$_SESSION = array();
		header('Location: index.php');
		echo "1";
		die();
		}
	}
?>