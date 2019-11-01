<?php

	include("../../config.php");
	require("../../Model/posting.model.php");
	$output = '';
	
		//Get a single post Id and display the information
		if (isset ($_GET['postId']))  
		{
			$postId = $_GET['postId'];
			
			//Set the session to update database
			$_SESSION['postId'] = $_GET['postId'];	
			$userId = $_SESSION['userId'];
			
			$post = new Posting();
	
			$postList = $post->userEditPost($postId, $userId);
			
			$postListCount = $postList->rowCount();
			
			$cat = $post->createPostCatList();
			
			
			if ($postListCount == 0)
			{
				$output .= "You do not have permission to edit this post";
			}
				elseif ($postListCount >= 1)
				{
					$item = $postList->fetch(PDO::FETCH_OBJ); 
					
						//Display the information
						$output .= "<table>
						<tr>
						<th>Title:</th>
						<th>Post:</th>
						<th>Category:</th>
						<th>Posted By:</th>
						<th>Posted on:</th>
						<th>Last Modified on:</th>
						<tr>
						<td>" . $item->postTitle . "</td>
						<td>" . $item->postInfo . "</td>
						<td>" . $item->catName . "</td>
						<td>" . $item->username . "</td>
						<td>" . $item->postTime . "</td>
						<td>" . $item->editTime . "</td>
						</tr>
						</table>";
				
					//Form to update post
					//Moves to editpostingpage.php for execution
					$output .=
						'<form action="editpostingpage.php" method="post">
						<label for="newtitle">Title</label>
						<input type="text" id="newtitle" name="newtitle" value="' . $item->postTitle . '"/>
						
						<label for="newpost">Post</label>
						<input type="text" id="newpost" name="newpost" size="70" value="' . $item->postInfo . '"/>
						
						<label for="category">Post Category:</label>
						<select name="category" id="category">';
						
						while($item = $cat->fetch(PDO::FETCH_OBJ)) 
							{
								
								$output .= '<option value="' . $item->catId . '" name="' . $item->catId . '" id="' . $item->catId . '">' . $item->catName . '</option>';
								
							}
			
			
						$output .= '</select>
						
						<input type="submit" name="submit" value="Enter" />
						</form>';
				}			
			}
		else 
		{
			//Error message	
			$output = "Oh snap! We messed up =[";
		}					
					
	
	include ('../template.php');