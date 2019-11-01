<?php

	require("../../config.php");
	$commentId = $_GET['commentId'];
	$postId = $_GET['postId'];
	$userId = $_SESSION['userId'];
	
		require("../../Model/posting.model.php");
		
		$revise  = new Posting();
		
		$reviseComment = $revise->reviseComment($commentId, $userId);
		
		header("Location:" . '../post.php?postId=' . $postId . '&editsuccess=true');
		
		
		
	include (VIEW_PATH . 'template.php');	