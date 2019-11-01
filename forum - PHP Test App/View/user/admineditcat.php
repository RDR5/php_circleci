<?php

	include("../../config.php");
	require("../../Model/admin.model.php");
	
		//Get a single post Id and display the information
		if (isset ($_GET['catId']))  
		{	
			$catId = $_GET['catId'];
			
			$_SESSION['catId'] = $_GET['catId'];
			
			$cat = new Admin();
	
			$catList = $cat->adminEditCat($catId);
			
			$item = $catList->fetch(PDO::FETCH_OBJ); 
			
				//Display the information
				$output = "<table>
				<tr>
				<th>Category Name:</th>
				</tr>
				<tr>
				<td>" . $item->catName . "</td>
				</tr>
				</table>";
		
			
			$output .=
				'<form action="admineditcat.php" method="post">
				<label for="newtitle">Title</label>
				<input type="text" id="newtitle" name="newtitle" value="' . $item->catName . '"/>
				
				<input type="submit" name="submit" value="Enter" />
				</form>';

		}
		elseif (isset($_POST['submit'])) 
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
			//Error message	
			$output = "Oh snap! We messed up =[";
		}					
					
	
	include ('../template.php');