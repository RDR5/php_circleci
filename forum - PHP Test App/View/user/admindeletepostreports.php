<?php

	require("../../config.php");
	$postId = $_GET['postId'];
	
	$output = 'Are you sure you want to delete this flagged post? <br />
	
	<form action="admindeletepostreports.php?postId=' . $postId . '" method="post">
	<input type="submit" name="delete" value="Delete" /> | <input type="submit" name="cancel" value="Cancel" />
	</form>';
	
	if (isset($_POST['delete'])) 
	{
		require("../../Model/admin.model.php");
		
		$delete  = new Admin();
		
		$deletePost = $delete->deletePost($postId);
		
		header("Location:" . 'managepostreports.php?deletesuccess=true');
		
		
	}
	elseif (isset($_POST['cancel'])) 
	{
		header("Location:" . 'managepostreports.php');
	}
		
		
	include (VIEW_PATH . 'template.php');	