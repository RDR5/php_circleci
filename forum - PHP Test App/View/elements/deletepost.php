<?php

	require("../../config.php");
	$postId = $_GET['postId'];
	
	$output = 'Are you sure you want to delete this post? <br />
	
	<form action="deletepost.php?postId=' . $postId . ' " method="post">
	<input type="submit" name="delete" value="Delete" /> | <input type="submit" name="cancel" value="Cancel" />
	</form>';
	
	if (isset($_POST['delete'])) 
	{
		require("../../Model/posting.model.php");
		
		$delete  = new Posting();
		
		$deletePost = $delete->deletePost($postId);
		
		header("Location:" . './../../../../../forum/View/userprofile.php');
		
	}
	elseif (isset($_POST['cancel'])) 
	{
		header("Location:" . './../../../../../forum/View/userprofile.php');
	}
		
		
	include (VIEW_PATH . 'template.php');	