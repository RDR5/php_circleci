<?php

	require("../../config.php");
	$userId = $_GET['userId'];

	$output = 'Are you sure you want to make this user an Admin? <br />
	
	<form action="makeuseradmin.php?userId=' . $userId . ' " method="post">
	<input type="submit" name="makeadmin" value="Make Admin" /> | <input type="submit" name="cancel" value="Cancel" />
	</form>';
	
	if (isset($_POST['makeadmin'])) 
	{
		require("../../Model/admin.model.php");
		
		$admin  = new Admin();
		
		$adminStatus = $admin->makeAdmin($userId);
		
		header("Location:" . 'manageusers.php?editsuccess=true');
		
		
	}
	elseif (isset($_POST['cancel'])) 
	{
		header("Location:" . 'manageusers.php');
	}
		
		
	include (VIEW_PATH . 'template.php');	