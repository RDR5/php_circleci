<?php

	require("../../config.php");
	$userId = $_GET['userId'];

	$output = 'Are you sure you want to delete this user account? <br />
	
	<form action="admindeleteuser.php?userId=' . $userId . '" method="post">
	<input type="submit" name="delete" value="Delete" /> | <input type="submit" name="cancel" value="Cancel" />
	</form>';
	
	$output .= $userId;
	
	if (isset($_POST['delete'])) 
	{
		require("../../Model/admin.model.php");
		
		$delete  = new Admin();
		
		$deleteUser = $delete->deleteUser($userId);
		
		header("Location:" . 'manageusers.php?deletesuccess=true');
		
		
	}
	elseif (isset($_POST['cancel'])) 
	{
		header("Location:" . 'manageusers.php');
	}
		
		
	include (VIEW_PATH . 'template.php');	