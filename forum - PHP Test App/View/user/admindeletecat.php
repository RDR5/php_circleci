<?php

	require("../../config.php");
	$catId = $_GET['catId'];

	$output = 'Are you sure you want to delete this category? <br />
	
	<form action="admindeletecat.php?catId=' . $catId . ' " method="post">
	<input type="submit" name="delete" value="Delete" /> | <input type="submit" name="cancel" value="Cancel" />
	</form>';
	
	if (isset($_POST['delete'])) 
	{
		require("../../Model/admin.model.php");
		
		$delete  = new Admin();
		
		$deleteCat = $delete->deleteCat($catId);
		
		header("Location:" . 'managepostcategory.php?deletesuccess=true');
		
		
	}
	elseif (isset($_POST['cancel'])) 
	{
		header("Location:" . 'managepostcategory.php');
	}
		
		
	include (VIEW_PATH . 'template.php');	