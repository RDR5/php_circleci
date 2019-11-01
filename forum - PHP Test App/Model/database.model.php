<?php
    
    class Database
    {
		//Set variables for connection	
		private $host = 'local';
		private $database = 'unit01';
		private $user = 'root1';
		private $pwd = '';
		public $conn;
		
		public function __construct() {
			$this->db_connect();
		} 
		
		public function __destruct() {
			$this->conn = null;
		} 
		
		public function __get($name) {
			return $this->$name;
		} 
		
		public function __set($name, $value) {
			$this->$name=$value;	
		}
		
		//Start connection
		private function db_connect() {
			
			try {			
				$conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->user, $this->pwd);
				
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$conn->exec('SET NAMES "utf8"');
			}
			
			catch (PDOException $e) {
				echo 'Unable to connect to the database server: ' . $e->getMessage();
				exit();
			}
			
			$this->conn = $conn;	
		}
		
    }
    
?>