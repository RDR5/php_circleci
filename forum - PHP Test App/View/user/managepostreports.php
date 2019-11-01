<?php

	require("../../config.php");
	require("../../Model/admin.model.php");
	$output = "";
	
		//Check if userId is saved in the session
		if ($_SESSION['userType'] == 2)  
		{
			//Create object and search for post match the user ID
			$manPost= new Admin();
			
			$manPostList = $manPost->allPostReports();	
			
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
						<legend>Reported Post</legend>
						<table>
						<tr>
						<th>Flagged Post</th>
						<th></th>
						</tr>";
						
						
				
							while($item = $manPostList->fetch(PDO::FETCH_OBJ)) 
							{
								
								$output .= "<tr>
								<td>" . $item->postInfo . "</td>
								<td><a href='approvepost.php?postId=" . $item->postId . "'>Approve</a> | 
								<a href='admindeletepostreports.php?postId=" . $item->postId . "'>Delete</a></td>
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