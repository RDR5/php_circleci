<?php

	include("../config.php");
	require("../Model/posting.model.php");
	$output = "";
	
	
		//Get a single post Id and display the information
		if (isset ($_GET['postId']) || isset($_GET['addsuccess']))  
		{
			$postId = $_GET['postId'];
			
			$_SESSION['postId'] = $_GET['postId'];
				
			$post = new Posting();
	
			$postList = $post->singlePost($postId);
	
			$item = $postList->fetch(PDO::FETCH_OBJ); 
			
			if (isset($_GET['addsuccess']))
			{
				$output .= "Your comment has been added!";
			}
			elseif (isset($_GET['deletesuccess']))
			{
				$output .= "Your item has been deleted!";
			}
			elseif (isset($_GET['editsuccess']))
			{
				$output .= "Your item has been edited!";
			}
			else 
			{
				$output .= "";
			}
			
				//Display the information
				$output .= "<table>
				<tr>
				<th>Title:</th>
				<th>Post:</th>
				<th>Category:</th>
				<th>Posted By:</th>
				<th>Posted on:</th>
				<th>Last Modified on:</th>	
				<tr>
				<td>" . $item->postTitle . "</td>
				<td>" . $item->postInfo . "</td>
				<td>" . $item->catName . "</td>
				<td>" . $item->username . "</td>
				<td>" . $item->postTime . "</td>
				<td>" . $item->editTime . "</td>";
				if (isset($_SESSION['userType']) && $_SESSION['userType'] == 2)  
					{
							$output .= "<td><a href='user/admineditposting.php?postId=" . $item->postId . "'>Edit</a> | 
								<a href='user/admindeletepost.php?postId=" . $item->postId . "'>Delete</a></td>";
					}
				elseif (isset($_SESSION['userId']) && $_SESSION['userType'] == 1)  
					{
						$output .= "<td><a href='../../../forum/View/elements/revisepost.php?postId=" . $postId . "'>
						Mark post as inappropriate</a></td>";
					}	
					
				$output .= "</tr>
				</table>";


				//Allow for logged in user to create a post
				if (isset($_SESSION['userId']))  
					{
						$output .= '<form action="post.php?postId=' . $postId . '" method="post">
						<label for="postComment">Add a comment</label>
						<input type="text" id="postComment" name="postComment" />
						
						<input type="submit" name="submit" value="Post" />
						</form>';
						
					}

				
				//Display comments
				$displayComment = new Posting();
	
				$displayCommentList = $displayComment->allPostComments($postId);
				
				$displayCommentCount = $displayCommentList->rowCount();
				
				if ($displayCommentCount >= 1)
				{
				
					$output .= "<table>
					<tr>
					<th>Comment:</th>
					<th>By:</th>
					<th>On:</th>
					</tr>";
					
						while($item2 = $displayCommentList->fetch(PDO::FETCH_OBJ)) 
						{
							$output .= "<tr>
							<td>" . $item2->commentInfo . "</td>
							<td>" . $item2->username . "</td>
							<td>" . $item2->commentTime . "</td>";
							
								if (isset($_SESSION['userType']) && $_SESSION['userType'] == 2)  
								{
									$output .= "<td><a href='user/admindeletecomment.php?commentId=" . $item2->commentId . "&postId=" . $postId . "'>Delete</a></td>";
								}
								elseif (isset($_SESSION['userId']) && $_SESSION['userType'] == 1)  
								{
									$output .= "<td><a href='../../../forum/View/elements/revisecomment.php?commentId=" . $item2->commentId . "&postId=" . $postId . "'>
									Mark comment as inappropriate</a></td>";
								}

							$output .= "</tr>";
						}
						
					$output .= "</table>";
				
				}
				elseif ($displayCommentCount == 0 && isset($_SESSION['userId']))
				{
					$output .= "Be the first to add a comment!";
				}

				//Check if user is submitting a comment
				if (isset($_POST['submit'])) 
					{
							//Set variables needed to create new posting
							$postTitle = $_POST['postComment'];
							$postId = $_SESSION['postId'];
							$userId = $_SESSION['userId'];
							
							$comment= new Posting();
							
							$postComment = $comment->createComment($postTitle, $postId, $userId);
							
							unset($_SESSION['postId']);
							
							header("Location:" . 'post.php?addsuccess=true&postId=' . $postId . '');
							
				
					}	
				
		}
		else 
		{
			//Error message	
			$output = "Oh snap! We messed up =[";
		}
	
	include ('template.php');