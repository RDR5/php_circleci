<?php

	//Connect to the database
	require_once ('database.model.php');

	class Posting 
	{
		
		public function __construct() 
		{	
		$db = new Database();
		$this->conn = $db->conn;
		}
		
		public function __destruct() 
		{
			$this->conn = null;
		}
			
		public function __get($name) 
		{
			return $this->$name;
		}
			
		public function __set($name, $value) 
		{
			$this->$name=$value;	
		}
		
		//Newest post listing on front page
		public function newPost()
		{
			try 
			{
				$sql = "SELECT post.postId, post.postTitle, post.postCat, post.userId, post.postTime, post.editTime, post.postType, 
				postcategory.catId, postcategory.catName, user.userId, user.username
				FROM post 
				JOIN postcategory
				ON post.postCat=postcategory.catId
				JOIN user
				ON post.userId=user.userId	
				ORDER BY postTime DESC
				LIMIT 4";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
				//Newest post listing on front page
		public function newPostUser($userId = '')
		{
			try 
			{
				$sql = "SELECT *
				FROM hideitem
				WHERE userId='" . $userId . "'";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//Top 5-35 post to display on front page
		public function allPost()
		{
			try 
			{
				$sql = "SELECT post.postId, post.postTitle, post.postCat, post.userId, post.postTime, post.editTime, post.postType, postcategory.catId, postcategory.catName, user.userId, user.username 
				FROM post 
				INNER JOIN postcategory
				INNER JOIN user
				ON post.postCat=postcategory.catId AND post.userId=user.userId
				ORDER BY postTime DESC LIMIT 30 OFFSET 4";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//Single post display
		public function singlePost($postId = '')
		{
			try 
			{
				$sql = "SELECT post.postId, post.postTitle, post.postInfo, post.postCat, post.userId, post.postTime, post.editTime, postcategory.catId, postcategory.catName, user.userId, user.username 
				FROM post 
				INNER JOIN postcategory
				INNER JOIN user
				ON post.postCat=postcategory.catId AND post.userId=user.userId 
				WHERE postId = '" . $postId . "' LIMIT 1";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//Display all user post on one page
		public function allUserPost()
		{
			try 
			{
				$sql = "SELECT post.postId, post.postTitle, post.postCat, post.userId, post.postTime, post.editTime, post.postType, postcategory.catId, postcategory.catName, user.userId, user.username 
				FROM post 
				INNER JOIN postcategory
				INNER JOIN user
				ON post.postCat=postcategory.catId AND post.userId=user.userId
				WHERE post.userId = '" . $_SESSION['userId'] . "'
				ORDER BY postTime DESC";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//The user can view the post they are about to edit
		public function userEditPost($postId = '', $userId = '')
		{
			try 
			{
				$sql = "SELECT post.postId, post.postTitle, post.postInfo, post.postCat, post.userId, post.postTime, post.editTime, postcategory.catId, postcategory.catName, user.userId, user.username 
				FROM post 
				INNER JOIN postcategory
				INNER JOIN user
				ON post.postCat=postcategory.catId AND post.userId=user.userId 
				WHERE postId = '" . $postId . "' AND post.userId = '" . $userId . "'
				LIMIT 1";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//The user updates their post
		public function userUpdatePost($postId = '', $postTitle = '', $postInfo = '', $postCat = '', $userId = '')
		{
			try 
			{
				$sql = "UPDATE post 
				SET postTitle='" . $postTitle . "', postInfo='" . $postInfo . "', postCat='" . $postCat . "', userId='" . $userId . "', editTime=CURRENT_TIMESTAMP() 
				WHERE postId = '" . $postId . "' LIMIT 1";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//The user creates a new post
		public function createPost($postTitle = '', $postInfo = '', $userId = '', $postCat = '')
		{
			try 
			{
				$sql = "INSERT INTO post
				SET postTitle='" . $postTitle . "', postInfo='" . $postInfo . "', userId='" . $userId . "', postCat='" . $postCat . "', postTime=CURRENT_TIMESTAMP(), editTime=CURRENT_TIMESTAMP()";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//Pull the category names
		public function createPostCatList()
		{
			try 
			{
				$sql = "SELECT *
				FROM postcategory";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//Delete a post
		public function deletePost($postId = '')
		{
			try 
			{
				$sql = "DELETE
				FROM post
				WHERE postId = '" . $postId . "'";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//The user creates a new post
		public function createComment($postComment = '', $postId = '', $userId = '')
		{
			try 
			{
				$sql = "INSERT INTO comment
				SET commentInfo='" . $postComment . "', postId='" . $postId . "', userId='" . $userId . "', commentTime=CURRENT_TIMESTAMP()";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//Display comments on a post
		public function allPostComments($postId = '')
		{
			try 
			{
				$sql = "SELECT comment.commentId, comment.commentInfo, comment.postId, comment.userId, comment.commentTime, comment.commentType, user.userId, user.username 
				FROM comment 
				INNER JOIN user
				ON comment.userId=user.userId 
				WHERE postId = '" . $_SESSION['postId'] . "'
				ORDER BY commentTime DESC";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//The user can mark comment for revision
		public function reviseComment($commentId = '', $userId)
		{
			try 
			{
				$sql = "INSERT INTO commentrevise
				SET commentID = '" . $commentId . "', userId = '" . $userId . "'";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//The user can mark a post for review
		public function revisePost($postId = '')
		{
			try 
			{
				$sql = "UPDATE post
				SET postType='2'
				WHERE postId='" . $postId . "'";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
	}
	