<?php

	include("../../config.php");
	require("../../Model/admin.model.php");
	
		//Get a single post Id and display the information
		if (isset ($_GET['postId']))  
		{
			$postId = $_GET['postId'];
			
			//Set the session to update database
			$_SESSION['postId'] = $_GET['postId'];	
			
			$post = new Admin();
	
			$postList = $post->adminEditPost($postId);
			
			$cat = $post->createPostCatList();
	
			$item = $postList->fetch(PDO::FETCH_OBJ); 
			
				//Display the information
				$output = "<table>
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
				'<form action="admineditposting.php" method="post">
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
		elseif (isset($_POST['submit'])) 
		{
			
						
				
						
						//Sets all variables needed	
						$postId = $_SESSION['postId'];
						$postTitle = $_POST['newtitle'];
						$postInfo = $_POST['newpost'];
						$postCat = $_POST['category'];
						
						$post = new Admin();
						
						$auth = $post->adminUpdatePost($postId, $postTitle, $postInfo, $postCat);
						
						header("Location:" . 'managepost.php?editsuccess=true');
						
						unset($_SESSION['postId']);
		
		}	
		else 
		{
			//Error message	
			$output = "Oh snap! We messed up =[";
		}					
					
	
	include ('../template.php');