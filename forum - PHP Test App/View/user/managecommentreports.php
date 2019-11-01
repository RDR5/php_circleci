<?php

	require("../../config.php");
	require("../../Model/admin.model.php");
	$output = "";
	
		//Check if userId is saved in the session
		if ($_SESSION['userType'] == 2)  
		{
			//Create object and search for post match the user ID
			$manComment = new Admin();
			
			$manCommentList = $manComment->allCommentReports();	
			
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
						<legend>Reported Comments</legend>
						<table>
						<tr>
						<th>Flagged Comment</th>
						<th></th>
						</tr>";
						
						
				
							while($item = $manCommentList->fetch(PDO::FETCH_OBJ)) 
							{
								
								$output .= "<tr>
								<td>" . $item->commentInfo . "</td>
								<td><a href='approvepostcomments.php?commentId=" . $item->commentId . "'>Approve</a> | 
								<a href='admindeletecommentreports.php?commentId=" . $item->commentId . "'>Delete</a></td>
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