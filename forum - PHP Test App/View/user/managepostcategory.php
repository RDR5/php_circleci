<?php

	require("../../config.php");
	require("../../Model/admin.model.php");
	$output = "";
	
		//Check if userId is saved in the session
		if ($_SESSION['userType'] == 2)  
		{
			//Create object and search for post match the user ID
			$manCat = new Admin();
			
			$manCatList = $manCat->allCat();	
			
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
						<legend>Categories</legend>
						<table>
						<tr>
						<th>Category Name:</th>
						</tr>";

							while($item = $manCatList->fetch(PDO::FETCH_OBJ)) 
							{
								
								$output .= "<tr>
								<td>" . $item->catName . "</td>
								<td><a href='admineditcat.php?catId=" . $item->catId . "'>Edit</a> | 
								<a href='admindeletecat.php?catId=" . $item->catId . "'>Delete</a></td>
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