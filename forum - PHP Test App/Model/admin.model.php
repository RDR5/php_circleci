<?php

	//Connect to the database
	require_once ('database.model.php');

	class Admin 
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
		
		//Show all post
		public function allPost()
		{
			try 
			{
				$sql = "SELECT post.postId, post.postTitle, post.postCat, post.userId, post.postTime, post.editTime, postcategory.catId, postcategory.catName, user.userId, user.username 
				FROM post 
				INNER JOIN postcategory
				INNER JOIN user
				ON post.postCat=postcategory.catId AND post.userId=user.userId
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
		
		//Add a post category
		public function createCategory($catName = '')
		{
			try 
			{
				$sql = "INSERT INTO postcategory
				SET catName='" . $catName . "'";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//Delete a category
		public function deleteCat($catId = '')
		{
			try 
			{
				$sql = "DELETE
				FROM postcategory
				WHERE catId = '" . $catId . "'";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//Show all categories
		public function allCat()
		{
			try 
			{
				$sql = "SELECT * 
				FROM postcategory
				ORDER BY catName DESC";
				
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
		public function adminEditPost($postId = '')
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
		
		//The user updates their post
		public function adminUpdatePost($postId = '', $postTitle = '', $postInfo = '', $postCat = '')
		{
			try 
			{
				$sql = "UPDATE post 
				SET postTitle='" . $postTitle . "', postInfo='" . $postInfo . "', postCat='" . $postCat . "', editTime=CURRENT_TIMESTAMP() 
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
		
		//The user can view the post they are about to edit
		public function adminEditCat($catId = '')
		{
			try 
			{
				$sql = "SELECT catId, catName
				FROM postcategory 
				WHERE catId = '" . $catId . "' LIMIT 1";
				
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
		public function adminUpdateCat($catId = '', $catName = '')
		{
			try 
			{
				$sql = "UPDATE postcategory 
				SET catName='" . $catName . "' 
				WHERE catId = '" . $catId . "' LIMIT 1";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//Delete a user
		public function deleteUser($userId = '')
		{
			try 
			{
				$sql = "DELETE
				FROM user
				WHERE userId = '" . $userId . "'";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//Show all users
		public function allUsers($loggedInUser)
		{
			try 
			{
				$sql = "SELECT * 
				FROM user
				WHERE userType = '1' AND NOT userId = '" . $loggedInUser . "'
				ORDER BY username DESC";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//Show all users
		public function allAdmins($loggedInUser)
		{
			try 
			{
				$sql = "SELECT * 
				FROM user
				WHERE userType = '2' AND NOT userId = '" . $loggedInUser . "'
				ORDER BY username DESC";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//Remove admin access for user
		public function removeAdmin($userId = '')
		{
			try 
			{
				$sql = "UPDATE user 
				SET userType='1' 
				WHERE userId = '" . $userId . "' LIMIT 1";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//Grant a user admin access
		public function makeAdmin($userId = '')
		{
			try 
			{
				$sql = "UPDATE user 
				SET userType='2' 
				WHERE userId = '" . $userId . "' LIMIT 1";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//Delete a user
		public function deleteComment($commentId = '')
		{
			try 
			{
				$sql = "DELETE
				FROM comment
				WHERE commentId = '" . $commentId . "'";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//Show all post
		public function allCommentReports()
		{
			try 
			{
				$sql = "SELECT *
				FROM comment
				WHERE commentType='2'
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
		
		//The admin approves a comment
		public function reviseComment($commentId = '')
		{
			try 
			{
				$sql = "UPDATE comment
				SET commentType='1'
				WHERE commentId='" . $commentId . "'";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		
		
		
		
		
		
		
		
		//Show all post
		public function allPostReports()
		{
			try 
			{
				$sql = "SELECT *
				FROM post
				WHERE postType='2'
				ORDER BY editTime DESC";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//The admin approves a comment
		public function revisePost($postId = '')
		{
			try 
			{
				$sql = "UPDATE post
				SET postType='1'
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
	