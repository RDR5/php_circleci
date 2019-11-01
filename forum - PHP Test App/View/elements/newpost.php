<?php

	require("../../config.php");
	include(MODL_PATH . 'posting.model.php');
	$output = "";
			
	$newCat = new Posting();
	
	$cat = $newCat->createPostCatList();
	
	
	if (isset($_GET['success']))
			{
				$output .= "The post was successfully added!";
				
				header('refresh:5;url=../../../../../../forum/View/userprofile.php');
			}	
	

//Form to submit post information
	$output .= '<form action="newpost.php" method="post">
	<label for="postTitle">Post Title:</label>
	<input type="text" id="postTitle" name="postTitle" />
	
	<label for="postInfo">Post Info:</label>
	<input type="text" id="postInfo" name="postInfo" />
	
	<label for="category">Post Category:</label>
	<select name="category" id="category">';
	
	while($item = $cat->fetch(PDO::FETCH_OBJ)) 
		{
			
			$output .= '<option value="' . $item->catId . '" name="' . $item->catId . '" id="' . $item->catId . '">' . $item->catName . '</option>';
			
		}
	
	
	$output .= '</select>
	<input type="submit" name="submit" value="Enter" />
	</form>';
	
//Check if submit button has been pressed
	if (isset($_POST['submit'])) 
	{
			//Set variables needed to create new posting
			$postTitle = $_POST['postTitle'];
			$postInfo = $_POST['postInfo'];
			$userId = $_SESSION['userId'];
			$postCat = $_POST['category'];
			
			
			$auth = $newCat->createPost($postTitle, $postInfo, $userId, $postCat);
			
			header("Location:" . 'newpost.php?success=true');
			

	}
		
	
	
	
	include (VIEW_PATH . 'template.php');