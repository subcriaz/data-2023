<?php
class Database{
	
	private $host  = 'systems92.com';
    private $user  = 'systemsc';
    private $password   = "od*m*w6256F";
    private $database  = "systemsc_dp"; 
    
    public function getConnection(){		
		$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		if($conn->connect_error){
			die("Error failed to connect to MySQL: " . $conn->connect_error);
		} else {
			return $conn;
		}
    }
}
?>