<?php

	include("config.php");
	require("Model/posting.model.php");
	
	if (isset ($_SESSION['userId']))
	{
		$output = "Welcome to the forum " . $_SESSION['firstName'] . "!";
	}
	else
	{
		$output = "Welcome to the forum!";
	}
	
	
	//New posting
	$output .= "<fieldset>
		<legend>New Postings</legend>
		<table>
		<tr>
		<th>Title:</th>
		<th>Category:</th>
		<th>Posted By:</th>
		<th>Posted on:</th>
		<th>Last Modified on:</th>
		</tr>";
		
			$newPost = new Posting();
			
			$newPostList = $newPost->newPost();
			
			while($item = $newPostList->fetch(PDO::FETCH_OBJ)) 
			{
					$output .= "<tr>
					<td><a href='View/post.php?postId=" . $item->postId . "'>" . $item->postTitle . "</td>
					<td>" . $item->catName . "</td>
					<td>" . $item->username . "</td>
					<td>" . $item->postTime . "</td>
					<td>" . $item->editTime . "</td>
							
					</tr>";	
					
			}	
		
		
	$output .= "</table>
	</fieldset>";
	
	
	
	//Old Posting
	$output .= "<fieldset>
		<legend>Other Postings</legend>
		<table>
		<tr>
		<th>Title:</th>
		<th>Category:</th>
		<th>Posted By:</th>
		<th>Posted on:</th>
		<th>Last Modified on:</th>
		</tr>";
		
	$otherPost = new Posting();
	
	$otherPostList = $otherPost->allPost();
	
		while($item2 = $otherPostList->fetch(PDO::FETCH_OBJ)) 
		{
			$output .= "<tr>
			<td><a href='View/post.php?postId=" . $item2->postId . "'>" . $item2->postTitle . "</td>
			<td>" . $item2->catName . "</td>
			<td>" . $item2->username . "</td>
			<td>" . $item2->postTime . "</td>
			<td>" . $item2->editTime . "</td>
			</tr>";
		}
		
	$output .= "</table>
	</fieldset>";

	include ('View/template.php');
