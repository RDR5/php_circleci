<?php

	require("../../config.php");
	$postId = $_GET['postId'];
	
	$output = 'Are you sure you want to delete this post? <br />
	
	<form action="admindeletepost.php?postId=' . $postId . ' " method="post">
	<input type="submit" name="delete" value="Delete" /> | <input type="submit" name="cancel" value="Cancel" />
	</form>';
	
	if (isset($_POST['delete'])) 
	{
		require("../../Model/admin.model.php");
		
		$delete  = new Admin();
		
		$deletePost = $delete->deletePost($postId);
		
		header("Location:" . 'managepost.php?success=true');
		
		
	}
	elseif (isset($_POST['cancel'])) 
	{
		header("Location:" . 'managepost.php');
	}
		
		
	include (VIEW_PATH . 'template.php');	