<?php

	require("../../config.php");
	
	
		//Check if userId is saved in the session
		if ($_SESSION['userType'] == 2)  
		{
			$output = "<fieldset>
						<legend>Users</legend>
						<table>
						<tr>
						<td><a href='manageusers.php'>Manage User Accounts</a></td>
						</tr>
						</table>
						</fieldset>
						
						<fieldset>
						<legend>Posts</legend>
						<table>
						<tr>
						<td><a href='managepost.php'>Manage Post</a> | <a href='addpostcategory.php'>Add Post Category</a> |
						<a href='managepostcategory.php'>Manage Post Category</a></td>
						</tr>
						</table>
						</fieldset>
						
						<fieldset>
						<legend>Reports</legend>
						<table>
						<tr>
						<td><a href='managepostreports.php'>Inappropriate Post</a> | <a href='managecommentreports.php'>Inappropriate Comments</a></td>
						</tr>
						</table>
						</fieldset>";
		}
		
		else 
		{
			$output = "Well how did you get here? Better head back to the site";
		}
			
	include (VIEW_PATH . 'template.php');	