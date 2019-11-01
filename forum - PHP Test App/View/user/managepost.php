<?php

	require("../../config.php");
	require("../../Model/admin.model.php");
	$output = "";
	
		//Check if userId is saved in the session
		if ($_SESSION['userType'] == 2)  
		{
			//Create object and search for post match the user ID
			$manPost = new Admin();
			
			$manPostList = $manPost->allPost();	
			
			if (isset($_GET['editsuccess']))
			{
				$output .= "The item was successfully edited!";
			}
			elseif (isset($_GET['deletesuccess']))
			{
				$output .= "The item was successfully deleted!";
			}				
				
						//Display all the users post	
						$output .= "<fieldset>
						<legend>Postings</legend>
						<table>
						<tr>
						<th>Title:</th>
						<th>Category:</th>
						<th>Posted By:</th>
						<th>Posted on:</th>
						<th>Last Modified on:</th>
						<th></th>
						</tr>";
						
						
				
							while($item = $manPostList->fetch(PDO::FETCH_OBJ)) 
							{
								
								$output .= "<tr>
								<td><a href='../../../../../forum/View/post.php?postId=" . $item->postId . "'>" . $item->postTitle . "</td>
								<td>" . $item->catName . "</td>
								<td>" . $item->username . "</td>
								<td>" . $item->postTime . "</td>
								<td>" . $item->editTime . "</td>
								<td><a href='admineditposting.php?postId=" . $item->postId . "'>Edit</a> | 
								<a href='admindeletepost.php?postId=" . $item->postId . "'>Delete</a></td>
								</tr>";
								
							}
							
						$output .= "</table>
						</fieldset>";
		}
			else 
			{
				//Error message	
				$output = "Oh snap! We messed up =[";
			}
	
	include ('../template.php');