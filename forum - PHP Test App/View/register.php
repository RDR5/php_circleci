<?php

	require("../config.php");
	

//Form to submit username & password
	$output = '<form action="register.php" method="post">
	<label for="username">Username:</label>
	<input type="username" id="username" name="username" />
	
	<label for="password">password:</label>
	<input type="password" id="password" name="password" />

	<label for="firstName">First Name:</label>
	<input type="firstName" id="firstName" name="firstName" />

	<label for="lastName">Last Name:</label>
	<input type="lastName" id="lastName" name="lastName" />
	
	<input type="submit" name="submit" value="Enter" />
	</form>';
	
//Check if submit button has been pressed
	if (isset($_POST['submit'])) 
	{
			//Set username & password variables to the posted username & password
			$username = $_POST['username'];
			$password = $_POST['password'];
			$firstName = $_POST['firstName'];
			$lastName = $_POST['lastName'];
			
			
			//Check if username & password are found in the database
			include(MODL_PATH . 'user.model.php');
			
			$user = new User();
			
			$auth = $user->register($username, $password, $firstName, $lastName);
			
			unset($user);
			
			//Redirect the user to the first_login page
			header("Location:" . './../../../../../forum/View/first_login.php');

	}
		
	
	
	
	include (VIEW_PATH . 'template.php');