<?php

	require("../../config.php");
	$commentId = $_GET['commentId'];
	
		require("../../Model/admin.model.php");
		
		$revise  = new Admin();
		
		$revisePost = $revise->reviseComment($commentId);
		
		header("Location:" . 'managecommentreports.php?&editsuccess=true');
		
		
		
	include (VIEW_PATH . 'template.php');	