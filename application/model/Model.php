<?php


class Model{
	
	public $mysqli;
	private $connection;
	private $getall;
	
	public function __construct($base_url)
	{
		
		require_once $base_url."/model/Config.php";
		
		$this->connection = new Config();
		
		$this->mysqli = $this->connection->Connection();
	}
	
	/*
		Redirect function
	*/
	public function Redirect($time, $url)
	{
		
		try
		{
			
			header("refresh:". $time ."; url = ". $url);
			
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
	}
	
	public function startSession(){
		
		session_start();
	}
	
	public function destroySession(){
		
		session_destroy();
		
	}
	
	public function getSessionId(){
		
		$usid = null;
		
		try{
			
			if(isset($_SESSION['user'])){
				
				$usid = $_SESSION['user'];
				
				//return true;
				
			}else{
				
				return false;
			}
			
		}catch(Exception $e){
			
			throw new Exception($e->getMessage());
		}
		
		return $usid;
	}
	
	public function getIP()
	{
		
		try
		{
			
			$ip = $_SERVER['REMOTE_ADDR'];
			
		}
		catch(Exception $e)
		{
			
			throw new Exception($e->getMessage());
		}
		
		return $ip;
	}
	
	public function getSessionName()
	{
		
		$usname = null;
		
		try{
			
			if(isset($_SESSION['name'])){
				
				$usname = $_SESSION['name'];
				
				//return true;
				
			}else{
				
				return false;
			}
			
		}catch(Exception $e){
			
			throw new Exception($e->getMessage());
		}
		
		return $usname;
	}
	
	/*
		Create new user session
	*/
	public function newUserSession($userid,$name)
	{
		
		try
		{
			$_SESSION['user'] = $userid;
			$_SESSION['name'] = $name;
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
	}
	
	/*
		Alert function (for messages after action)
	*/
	public function Alert($alert_type, $message)
	{
		
		try
		{
			
			?>
            <div class="alert <?php echo $alert_type;?> alert-dismissable no-print">
                <i class="fa fa-check"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $message;?>
            </div>
            <?php
			
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
	}
	
	public function DoLogin($username, $password, $fredirect_url, $redirect_url)
	{		
		
		try
		{			
			$res = $this->mysqli->query("SELECT * FROM users where username = '". $username ."' and password='". $password ."'");
			
			if($res)
			{
				
				if($res->num_rows > 0)
				{
					
					$row = $res->fetch_assoc();
					
					$id = $row['id'];
					$name = $row['username'];
					
					$this->newUserSession($id, $name);
					
					$this->Alert("alert-success", "Hi, ". $name .", you have logged in successfully! ");
					
					$this->Redirect("1", $redirect_url);
					
				}
				else
				{
					
					$this->Alert("alert-danger", "Username or password is wrong... ");
					
					$this->Redirect("1", $fredirect_url);
				}
				
			}
			else
			{
				
				$this->Alert("alert-danger","Sorry, we encountered an issue! ".$this->mysqli->error);
				
				$this->Redirect("1", $fredirect_url);
			}			
			
		}
		catch(Exception $e)
		{
			
			throw new Exception($e->getMessage());
		}
		
		return $res;
	}
	
	/*
		General delete function
	*/
	public function delete($table, $primary_key, $key_value, $redirect_url)
	{
		try
		{
			
			$take = $this->mysqli->query("DELETE FROM $table where $primary_key = '". $key_value ."'");
			
			if($take)
			{
				$this->Alert("alert-success", "Record has been deleted!");
				
				$this->Redirect("1", $redirect_url);
			}
			else
			{
				$this->Alert("alert-danger", "Sorry! We encountered an error, ". $this->mysqli->error ."");
				
				$this->Redirect("1", $redirect_url);
			}
			
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/*
		General delete function
	*/
	public function deleteexcel($table, $primary_key, $key_value, $redirect_url)
	{
		try
		{
			
			$take = $this->mysqli->query("DELETE FROM $table where $primary_key = '". $key_value ."'");
			
			if($take)
			{
				//$this->Alert("alert-success", "Record has been deleted!");
				
				$this->Redirect("1", $redirect_url);
			}
			else
			{
				$this->Alert("alert-danger", "Sorry! We encountered an error, ". $this->mysqli->error ."");
				
				$this->Redirect("1", $redirect_url);
			}
			
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/*
		General delete multiple function
	*/
	public function deleteMultiple($table, $primary_key, $key_value, $redirect_url)
	{
		try
		{
			
			$take = $this->mysqli->query("DELETE FROM $table where $primary_key = '". $key_value ."'");
			
			if($take)
			{
				
				$this->Redirect("1", $redirect_url);
			}
			else
			{
				$this->Alert("alert-danger", "Sorry! We encountered an error, ". $this->mysqli->error ."");
				
				$this->Redirect("1", $redirect_url);
			}
			
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/*
		General approve multiple function
	*/
	public function approveMultiple($table, $primary_key, $key_value, $redirect_url)
	{
		try
		{
			
			$take = $this->mysqli->query("UPDATE $table SET status = 'selected' where $primary_key = '". $key_value ."'");
			
			if($take)
			{
				
				$this->Redirect("1", $redirect_url);
			}
			else
			{
				$this->Alert("alert-danger", "Sorry! We encountered an error, ". $this->mysqli->error ."");
				
				$this->Redirect("1", $redirect_url);
			}
			
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/*
		General approve multiple function
	*/
	public function trashMultiple($table, $primary_key, $key_value, $redirect_url)
	{
		try
		{
			
			$take = $this->mysqli->query("UPDATE $table SET isTrashed = '1' where $primary_key = '". $key_value ."'");
			
			if($take)
			{
				
				$this->Redirect("1", $redirect_url);
			}
			else
			{
				$this->Alert("alert-danger", "Sorry! We encountered an error, ". $this->mysqli->error ."");
				
				$this->Redirect("1", $redirect_url);
			}
			
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/*
		General approve multiple function
	*/
	public function untrashMultiple($table, $primary_key, $key_value, $redirect_url)
	{
		try
		{
			
			$take = $this->mysqli->query("UPDATE $table SET isTrashed = '0' where $primary_key = '". $key_value ."'");
			
			if($take)
			{
				
				$this->Redirect("1", $redirect_url);
			}
			else
			{
				$this->Alert("alert-danger", "Sorry! We encountered an error, ". $this->mysqli->error ."");
				
				$this->Redirect("1", $redirect_url);
			}
			
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/*
		Select all function
	*/
	public function SelectAll($table)
	{
		$data = array();
		
		try
		{			
			
			$this->getall = $this->mysqli->query("SELECT * FROM ". $table);
			
			while($object = $this->getall->fetch_object())
			{
				$data[] = $object;
			}
						
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
		return $data;
		
	}
	
	/*
		Select all function with a custom query
	*/
	public function SelectCustom($query)
	{
		$data = array();
		
		try
		{			
			
			$this->getall = $this->mysqli->query($query);
			
			while($object = $this->getall->fetch_object())
			{
				$data[] = $object;
			}
						
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
		return $data;
		
	}
	
	/*
		Select all function
	*/
	public function SelectIndividual($table, $key, $value)
	{
		$data = array();
		
		try
		{			
			
			$getind = $this->mysqli->query("SELECT * FROM ". $table ." WHERE ". $key ." = '". $value ."'");
			
			while($object = $getind->fetch_object())
			{
				$data[] = $object;
			}
						
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
		return $data;
		
	}
	
	/*
		Select user details
	*/
	public function getUserDetails($user)
	{
		$data = array();
		
		try
		{			
			
			$this->getall = $this->mysqli->query("SELECT * FROM users where id = '". $user ."'");
			
			while($object = $this->getall->fetch_object())
			{
				$data[] = $object;
			}
						
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
		return $data;
		
	}
	
	/*
		Select all function
	*/
	public function SelectMultiple($table1, $table2, $keyfield)
	{
		$data = array();
		
		try
		{			
			
			$this->getall = $this->mysqli->query("SELECT * FROM ". $table1 ." a, ". $table2 ." b where a.". $keyfield ." = b.". $keyfield);
			
			while($object = $this->getall->fetch_object())
			{
				$data[] = $object;
			}
						
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
		return $data;
		
	}
	
	/*
		General save function
	*/
	public function save($table, $columns, $values, $redirect)
	{
		try
		{
			
			$take = $this->mysqli->query("INSERT INTO $table ($columns) values($values)");
			
			if($take)
			{
				$this->Alert("alert-success", "Data has been saved!");
				
				$this->Redirect("2", $redirect);
			}
			else
			{
				$this->Alert("alert-danger", "Sorry! We encountered an error, ". $this->mysqli->error ."");
				
				$this->Redirect("2", $redirect);
			}
			
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/*
		General update function
	*/
	public function update($table, $column_value, $primary_key, $key_value, $redirect)
	{
		try
		{
			
			$take = $this->mysqli->query("UPDATE $table SET $column_value WHERE $primary_key = '". $key_value ."'");
			
			if($take)
			{
				$this->Alert("alert-success", "Changes have been saved!");
				
				$this->Redirect("2", $redirect);
			}
			else
			{
				$this->Alert("alert-danger", "Sorry! We encountered an error, ". $this->mysqli->error ."");
				
				$this->Redirect("2", $redirect);
			}
			
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	public function UpdateImg($table, $column_value, $primary_key, $key_value)
	{
		try
		{
			
			$take = $this->mysqli->query("UPDATE $table SET $column_value WHERE $primary_key = '". $key_value ."'");
			
			if($take)
			{
				
				//$this->Redirect("2", $redirect);
			}
			else
			{
				$this->Alert("alert-danger", "Sorry! We encountered an error, ". $this->mysqli->error ."");
				
				
			}
			
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	/*
		General excel save function
	*/
	public function saveexcel($table, $columns, $values, $redirect)
	{
		try
		{
			$insertid = '';
			$take = $this->mysqli->query("INSERT INTO $table ($columns) values($values)");
			
			if($take)
			{
				$insertid = $this->mysqli->insert_id;
				$this->Redirect("2", $redirect);
			}
			else
			{
				
				$this->Redirect("2", $redirect);
			}
			
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
		
		if($table == 'projects')
		{
			return $insertid;
		}
	}
	
	
	
	/*
		General update function
	*/
	public function updateexcel($table, $column_value, $where, $redirect)
	{
		try
		{
			
			$take = $this->mysqli->query("UPDATE $table SET $column_value WHERE ". $where ."");
			
			if($take)
			{
				
				//$this->Redirect("2", $redirect);
			}
			else
			{
				
				//$this->Redirect("2", $redirect);
			}
			
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	
}

?>