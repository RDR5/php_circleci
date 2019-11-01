<?php

	require("../../config.php");
	$userId = $_GET['userId'];

	$output = 'Are you sure you want to remove this admin? <br />
	
	<form action="removeadmin.php?userId=' . $userId . ' " method="post">
	<input type="submit" name="revokeaccess" value="Revoke Access" /> | <input type="submit" name="cancel" value="Cancel" />
	</form>';
	
	if (isset($_POST['revokeaccess'])) 
	{
		require("../../Model/admin.model.php");
		
		$delete  = new Admin();
		
		$deleteCat = $delete->removeAdmin($userId);
		
		header("Location:" . 'manageusers.php?editsuccess=true');
		
		
	}
	elseif (isset($_POST['cancel'])) 
	{
		header("Location:" . 'manageusers.php');
	}
		
		
	include (VIEW_PATH . 'template.php');	