<?php
	session_start();
    if(!isset($_SESSION['user']) || $_SESSION['user'] == "")
     http_response_code(404);


     session_destroy();
     header('Location: index.php');
?>