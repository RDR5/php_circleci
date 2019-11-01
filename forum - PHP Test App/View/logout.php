<?php

	require("../config.php");
	
	//Unset user information
	unset($_SESSION['username']);
	unset($_SESSION['userType']);
	unset($_SESSION['userId']);
	
	session_destroy();
	
	$output = "You have now been logged out. See you again soon!!!";
		
	include (VIEW_PATH . 'template.php');