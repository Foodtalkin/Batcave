<?php
error_reporting(E_ALL ^ E_NOTICE);
	if(!$do_login) exit;
	session_start();

	header('Cache-control: private'); // IE 6 FIX
 
	// always modified
	header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
	// HTTP/1.1
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', false);
	// HTTP/1.0
	header('Pragma: no-cache');


	include '../pages/functions.php';
	$con = connect($config);
	if(!$con)die("Database connection aborted");	
	$name =  $_POST['u_name'];
	$password =  $_POST['password'];
	$post_autologin = $_POST['autologin'];
	die();
	$query = 'SELECT * FROM login_backend WHERE username = :name';
	$bind = array(
			':name' => $name
		);
	$result = query($query, $bind, $con);
	if(!$result){
		session_destroy();
		$_SESSION = array();
		echo "2";
		die();
	}
	$config_password='';
	$config_username='';
	foreach ($result as $y) {
		$config_username = $result['username'];
		$config_password = $result['password'];
	}
	
	$cookie_name = 'siteAuth';
	$cookie_time = (3600 * 24 * 30); // 30 days

	if(!$_SESSION['user'])
		{
		if(isSet($cookie_name))
			{
			    // Check if the cookie exists
			if(isSet($_COOKIE[$cookie_name]))
			    {
			    parse_str($_COOKIE[$cookie_name]);
			 
			    // Make a verification
			 
			    if(($usr == $config_username) && ($hash == md5($config_password)))
			        {
			        // Register the session
			        	foreach ($result as $k) {
			        		$_SESSION['user'] = $k;
			        	} 
			        }
			    }
			}
		}
	foreach ($result as $key) {
		if($key['password'] === $password){
			$_SESSION['user'] = $key;

				if($post_autologin == 1)
				    {
				    $password_hash = md5($config_password); // will result in a 32 characters hash
				 
				    setcookie ($cookie_name, 'usr='.$config_username.'&hash='.$password_hash, time() + $cookie_time);
				    }
			echo "0";
		}else{
		session_destroy();
		$_SESSION = array();
		echo "1";
		die();
		}
	}
?>