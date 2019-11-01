<?php

	require("../../config.php");
	require("../../Model/admin.model.php");
	$output = "";
	$loggedInUser = $_SESSION['userId'];
	
		//Check if userId is saved in the session
		if ($_SESSION['userType'] == 2)  
		{	
			
			if (isset($_GET['editsuccess']))
			{
				$output .= "The item was successfully edited!";
			}
			elseif (isset($_GET['deletesuccess']))
			{
				$output .= "The item was successfully deleted!";
			}		
					
					
					  //Create object and search for post match the user ID
						$manAdmins = new Admin();
						
						$manAdminsList = $manAdmins->allAdmins($loggedInUser);
						
						$admin_count = $manAdminsList->rowCount();
						
						if($admin_count == 0)
						{
							$output .= "<fieldset>
						<legend>Admin Accounts</legend>
						No admins to display
						</fieldset>";
						}
						else 
						{
					   //Display all the users accounts	
						$output .= "<fieldset>
						<legend>Admin Accounts</legend>
						<table>
						<tr>
						<th>UserName:</th>
						</tr>";

							while($item2 = $manAdminsList->fetch(PDO::FETCH_OBJ)) 
							{
								
								$output .= "<tr>
								<td>" . $item2->username . "</td>
								<td><a href='admindeleteuser.php?userId=" . $item2->userId . "'>Delete Account</a> | 
								<a href='removeadmin.php?userId=" . $item2->userId . "'>Remove Admin</a></td>
								</tr>";
								
							}
							
						$output .= "</table>
						</fieldset>";
						}
						
						
						
						
						
						
						
						
						
						
						//Create object and search for post match the user ID
						$manUser = new Admin();
						
						$manUserList = $manUser->allUsers($loggedInUser);
						
						$user_count = $manUserList->rowCount();
					    
						if($user_count == 0)
						{
							$output .= "<fieldset>
						<legend>User Accounts</legend>
						No users to display
						</fieldset>";
						}
						else 
						{
						//Display all the users accounts	
						$output .= "<fieldset>
						<legend>User Accounts</legend>
						<table>
						<tr>
						<th>UserName:</th>
						</tr>";

							while($item = $manUserList->fetch(PDO::FETCH_OBJ)) 
							{
								
								$output .= "<tr>
								<td>" . $item->username . "</td>
								<td><a href='admindeleteuser.php?userId=" . $item->userId . "'>Delete Account</a> | 
								<a href='makeuseradmin.php?userId=" . $item->userId . "'>Make Admin</a></td>
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
	
	include ('../template.php');