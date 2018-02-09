<?php
class Config{
	
	private $server = "localhost";
	private $user = "root";
	private $password = "";
	private $dbname = "cbsradio"; 
	private $mysqli;
	
	public function Connection(){
		
		try
		{
			
			$this->mysqli = new mysqli($this->server, $this->user, $this->password, $this->dbname);
		
		}
		catch(Exception $e)
		{
			
			throw new Exception($e->getMessage());
			
		}
		
		return $this->mysqli;
	}
}