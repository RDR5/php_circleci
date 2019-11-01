<?php

	include("../../config.php");
	require("../../Model/posting.model.php");
	
					//Receives request to update a post
					if (isset($_POST['submit'])) 
					{
						
						//Sets all variables needed	
						$postId = $_SESSION['postId'];
						$userId = $_SESSION['userId'];
						$postTitle = $_POST['newtitle'];
						$postInfo = $_POST['newpost'];
						$postCat = $_POST['category'];
						
						$postUpdate = new Posting();
						
						$auth = $postUpdate->userUpdatePost($postId, $postTitle, $postInfo, $postCat, $userId);
						
						//Acknowledges a successful update
						$output = "Your post has been successfully updated! Thank you!";
						
						unset($_SESSION['postId']);
		
					}
					else
					{
						//Error message if update fails	
						$output .= "Welp, that didnt work =/";
					}		
					
				
					
	
	include ('../template.php');