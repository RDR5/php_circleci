<?php

	//Connect to the database
	require_once ('database.model.php');

	class User 
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
		
		//User login
		public function login ($username = '', $password = '')
		{
			try 
			{
				$password = md5($password . '5&gre9*');
				$sql = "SELECT userId, username, password, userType, firstName, lastName FROM user WHERE username = '" . $username . "' and password = '" . $password . "' LIMIT 1";
				
				$result = $this->conn->query($sql);
				
				return $result;
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
		//User registration
		public function register ($username, $password, $firstName, $lastName)
		{
			try 
			{
				$password = md5($password . '5&gre9*');
				$sql = "INSERT INTO user(username, password, firstName, lastName) VALUES (:username, :password, :firstName, :lastName)";
			
			// Prepare and bind values to SQL statement above
			$s = $this->conn->prepare($sql);
			$s->bindValue(':username', $username);
			$s->bindValue(':password', $password);
			$s->bindValue(':firstName', $firstName);
			$s->bindValue(':lastName', $lastName);
			
			// Execute the SQL statement
			$s->execute();
			}
			
			catch (PDOException $e) 
			{
				echo 'Error registering user: ' . $e->getMessage();
				
				exit();
			}
		}
		
	}
	