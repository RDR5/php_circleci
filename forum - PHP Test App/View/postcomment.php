<?php

	include("../config.php");
	require("../Model/posting.model.php");
	
					if (isset($_POST['submit'])) 
					{
							//Set variables needed to create new posting
							$postTitle = $_POST['postComment'];
							$postId = $_SESSION['postId'];
							$userId = $_SESSION['userId'];
							
							$comment= new Posting();
							
							$postComment = $comment->createComment($postTitle, $postId, $userId);
							
							unset($_SESSION['postId']);
							
							header("Location:" . 'post.php?success=true');
							
				
					}
					
	include ('template.php');