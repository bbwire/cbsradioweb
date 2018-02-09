<?php
ob_start();

date_default_timezone_set("Africa/Kampala");
class Config{
	private $mysqli;
	private $host = "localhost";
	private $user = "umbrtech_bdf";
	private $pass = "Bdfbugisu.123";
	private $db = "umbrtech_bdf";
	
	public function connect(){
		$this->mysqli = new mysqli($this->host,$this->user,$this->pass,$this->db);
		
		return $this->mysqli;
	}
	
	
}