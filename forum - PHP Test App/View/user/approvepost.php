<?php

	require("../../config.php");
	$postId = $_GET['postId'];
	
		require("../../Model/admin.model.php");
		
		$revise  = new Admin();
		
		$revisePost = $revise->revisePost($postId);
		
		header("Location:" . 'managepostreports.php?&editsuccess=true');
		
		
		
	include (VIEW_PATH . 'template.php');	