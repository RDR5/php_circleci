<?php

	require("../../config.php");
	$postId = $_GET['postId'];
	$userId = $_SESSION['userId'];
	
		require("../../Model/posting.model.php");
		
		$revise  = new Posting();
		
		$revisePost = $revise->revisePost($postId);
		
		header("Location:" . '../../index.php');
		
		
		
	include (VIEW_PATH . 'template.php');	