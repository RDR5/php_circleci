<?php

	require("../config.php");
	

//Form to submit username & password
	$output = '<form action="login.php" method="post">
	<label for="username">Username:</label>
	<input type="username" id="username" name="username" />
	
	<label for="password">password:</label>
	<input type="password" id="password" name="password" />
	
	<input type="submit" name="submit" value="Enter" />
	</form>';
	
//Check if submit button has been pressed
	if (isset($_POST['submit'])) 
	{
			//Set username & password variables to the posted username & password
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			
			//Check if username & password are found in the database
			include(MODL_PATH . 'user.model.php');
			
			$user = new User();
			
			$auth = $user->login($username, $password);
			
			$user_count = $auth->rowCount();
			
			//If the username & password are found, set session info and display the username
			if ($user_count == 1) 
			{
				$authUser = $auth->fetch(PDO::FETCH_OBJ);
				
				$_SESSION['username'] = $authUser->username;
				$_SESSION['userId'] = $authUser->userId;
				$_SESSION['userType'] = $authUser->userType;
				$_SESSION['firstName'] = $authUser->firstName;
				$_SESSION['lastName'] = $authUser->lastName;
			}
			
			
	}
		
	
	
	//Include the template file
	include (VIEW_PATH . 'template.php');