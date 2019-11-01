<?php

	require("../../config.php");
	$commentId = $_GET['commentId'];
	
	$output = 'Are you sure you want to delete this flagged comment? <br />
	
	<form action="admindeletecommentreports.php?commentId=' . $commentId . '" method="post">
	<input type="submit" name="delete" value="Delete" /> | <input type="submit" name="cancel" value="Cancel" />
	</form>';
	
	if (isset($_POST['delete'])) 
	{
		require("../../Model/admin.model.php");
		
		$delete  = new Admin();
		
		$deleteComment = $delete->deleteComment($commentId);
		
		header("Location:" . 'managecommentreports.php?deletesuccess=true');
		
		
	}
	elseif (isset($_POST['cancel'])) 
	{
		header("Location:" . 'managecommentreports.php');
	}
		
		
	include (VIEW_PATH . 'template.php');	