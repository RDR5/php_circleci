<?php
	
	//Include the main navigation page
	include('main_nav.php');
	
?>
	<!-- Start the webpage -->
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Racing Forum</title>
	</head>
	<body>
		
<?php 

	//See if user has logged in and display their username
	if(isset($_SESSION['username']) && ($_SESSION['userType'] == 2))
	{
		echo $_SESSION['username'];
		echo $main_nav3;
		
	}
	elseif (isset($_SESSION['username']))
	{
		echo $_SESSION['username'];	
		echo $main_nav2;
	}
	else 
	{
		echo $main_nav;
	}
	
?>
		
