<?php

	include("../config.php");
	require("../Model/posting.model.php");
	
		//Check if userId is saved in the session
		if (isset ($_SESSION['userId']))  
		{

			//Create object and search for post match the user ID
			$newPost = new Posting();
			
			$newPostList = $newPost->allUserPost();
			
			$postCount = $newPostList->rowCount();	
			
			if ($postCount == 0)
			{
				$output = $_SESSION['username'] . ", You have not posted anything yet. Get started now!! ";
				$output .= "<a href='../../../../../../forum/View/elements/newpost.php'>New Post</a>"; 
			}
				elseif ($postCount >= 1)
				{
						
				
						//Display all the users post	
						$output = "<fieldset>
						<legend>" . $_SESSION['username'] . "'s Postings</legend>
						<table>
						<tr>
						<th>Title:</th>
						<th>Category:</th>
						<th>Posted By:</th>
						<th>Posted on:</th>
						<th>Last Modified on:</th>
						<th></th>
						</tr>";
						
						
				
							while($item = $newPostList->fetch(PDO::FETCH_OBJ)) 
							{
								
								$output .= "<tr>
								<td><a href='../../../../../forum/View/post.php?postId=" . $item->postId . "'>" . $item->postTitle . "</td>
								<td>" . $item->catName . "</td>
								<td>" . $item->username . "</td>
								<td>" . $item->postTime . "</td>
								<td>" . $item->editTime . "</td>
								<td><a href='../../../../../../../forum/View/elements/editposting.php?postId=" . $item->postId . "'>Edit</a> | 
								<a href='../../../../../../../forum/View/elements/deletepost.php?postId=" . $item->postId . "'>Delete</a></td>
								</tr>";
								
							}
							
						$output .= "</table>
						</fieldset>";
					}
		}
			else 
			{
				//Error message	
				$output = "Oh snap! We messed up =[";
			}
	
	include ('template.php');