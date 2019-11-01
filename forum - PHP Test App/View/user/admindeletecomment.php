<?php

	require("../../config.php");
	$commentId = $_GET['commentId'];
	$postId = $_GET['postId'];
	
	$output = 'Are you sure you want to delete this comment? <br />
	
	<form action="admindeletecomment.php?commentId=' . $commentId . '&postId=' . $postId . ' " method="post">
	<input type="submit" name="delete" value="Delete" /> | <input type="submit" name="cancel" value="Cancel" />
	</form>';
	
	if (isset($_POST['delete'])) 
	{
		require("../../Model/admin.model.php");
		
		$delete  = new Admin();
		
		$deleteComment = $delete->deleteComment($commentId);
		
		header("Location:" . '../post.php?postId=' . $postId . '&deletesuccess=true');
		
		
	}
	elseif (isset($_POST['cancel'])) 
	{
		header("Location:" . '../post.php?postId=' . $postId . '');
	}
		
		
	include (VIEW_PATH . 'template.php');	