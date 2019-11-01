<?php

	require("../../config.php");
	$output = "";
	
		//Check if userId is saved in the session
		if ($_SESSION['userType'] == 2)  
		{
				
			
			if (isset($_GET['success']))
			{
				$output .= "The new category was successfully added!";
			}				
				
						
				//Form to submit category information
					$output .= '<form action="addpostcategory.php" method="post">
					<label for="catName">New Category Name:</label>
					<input type="text" id="catName" name="catName" />
					
					<input type="submit" name="submit" value="Enter" />
					</form>';
					
				//Check if submit button has been pressed
					if (isset($_POST['submit'])) 
					{
							//Set variables needed to create new posting
							$catName = $_POST['catName'];
							
							//Create object and search for post match the user ID
							require("../../Model/admin.model.php");
							
							$manPost = new Admin();
			
							$manPostList = $manPost->createCategory($catName);
							
							header("Location:" . 'addpostcategory.php?success=true');
							
				
					}		
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
		}
			else 
			{
				//Error message	
				$output = "Oh snap! We messed up =[";
			}
	
	include ('../template.php');