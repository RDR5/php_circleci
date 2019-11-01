<?php

	include("../../config.php");
	require("../../Model/admin.model.php");
	
		if (isset($_POST['submit'])) 
		{
	
				//Sets all variables needed	
				$catId = $_SESSION['catId'];
				$catName = $_POST['newtitle'];
						
				$update = new Admin();
						
				$auth = $update->adminUpdateCat($catId, $catName);
						
				$output = "Your post has been successfully updated! Thank you!";
						
				unset($_SESSION['catId']);
		
		}
		else
		{
				//Error message if update fails	
				$output .= "Welp, that didnt work =/";
		}		
					
				
					
	
	include ('../template.php');	