<?php
require_once ("inc/config.php");


$mysqli = Config();
/*
	this function will be ready to get any data from any table supplied as the parameter
*/
function getAllData($table)
{	
	global $mysqli;
	
	$getall = $mysqli->query("SELECT * FROM $table");
	
	$data = array();
	
	while($datarow = $getall->fetch_object())
	{		
		$data[] = $datarow;
	}
	
	return $data;
}

function getindividualdata($user)
{	
	global $mysqli;
	
	$getall = $mysqli->query("SELECT * FROM staff WHERE autoId = '". $user ."'");
	
	$data = array();
	
	while($datarow = $getall->fetch_object())
	{		
		$data[] = $datarow;
	}
	
	return $data;
}

function getcustom($query)
{	
	global $mysqli;
	
	$getall = $mysqli->query($query);
	
	$data = array();
	
	while($datarow = $getall->fetch_object())
	{		
		$data[] = $datarow;
	}
	
	return $data;
}

function getSessionId()
{	
	$usid = null;
	
	try
	{
		
		if(isset($_SESSION['user']))
		{			
			$usid = $_SESSION['user'];			
		}
		else
		{			
			return false;
		}
		
	}
	catch(Exception $e)
	{		
		throw new Exception($e->getMessage());
	}
	
	return $usid;
}

function getIP()
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

function getSessionName(){
	
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
function newUserSession($userid,$name){
	
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
	Redirect function
*/
function Redirect($url)
{
		
	header("refresh:2; url = ". $url);
	
}

/*
	Alert function (for messages after action)
*/
function Alert($alert_type, $message)
{
		
	?>
    <div class="alert <?php echo $alert_type;?> alert-dismissable no-print">
        <i class="fa fa-check"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $message;?>
    </div>	
	<?php
	
}


	
function DoLogin($username, $password, $fredirect_url, $redirect_url){
	
	global $mysqli;
	
	try{
		
		$res = $mysqli->query("SELECT * FROM staff where userName = '". $username ."' and password='". $password ."'");
		
		if($res){
			
			if($res->num_rows > 0){
				
				$row = $res->fetch_assoc();
				
				$id = $row['autoId'];
				$name = $row['userName'];
				
				newUserSession($id, $name);
				
				Alert("alert-success", "Hi, ". $name .", you have logged in successfully! ");
				
				Redirect($redirect_url);
				
			}else{
				
				Alert("alert-danger", "Username or password is wrong... ");
				
				Redirect($fredirect_url);
			}
			
		}else{
			
			Alert("alert-danger","Sorry, we encountered an issue! ".$mysqli->error);
			
			Redirect($fredirect_url);
		}			
		
	}catch(Exception $e){
		
		throw new Exception($e->getMessage());
	}
	
	return $res;
}

/*
	General save function
*/
function insert($table, $columns, $values, $redirect)
{
	global $mysqli;
		
	$take = $mysqli->query("INSERT INTO $table ($columns) values($values)");
	
	if($take)
	{
		Alert("bg-success", "Data has been saved!");
		
		Redirect($redirect);
	}
	else
	{
		Alert("bg-danger", "Sorry! We encountered an error, ". $mysqli->error ."");
		
		Redirect($redirect);
	}
	
}

/*
	General update function
*/
function update($table, $column_value, $primary_key, $key_value, $redirect)
{
	global $mysqli;
	
	$take = $mysqli->query("UPDATE $table SET $column_value WHERE $primary_key = '". $key_value ."'");
	
	if($take)
	{
		Alert("alert-success", "Changes have been saved!");
		
		Redirect($redirect);
	}
	else
	{
		Alert("alert-danger", "Sorry! We encountered an error, ". $mysqli->error ."");
		
		Redirect($redirect);
	}
	
}
	
/*
	General delete function
*/
function delete($table, $primary_key, $key_value, $redirect_url)
{
	global $mysqli;
	try
	{
		
		$take = $mysqli->query("DELETE FROM $table where $primary_key = '". $key_value ."'");
		
		if($take)
		{
			Alert("alert-success", "Record has been deleted!");
			
			Redirect($redirect_url);
		}
		else
		{
			Alert("alert-danger", "Sorry! We encountered an error, ". $mysqli->error ."");
			
			Redirect($redirect_url);
		}
		
	}
	catch(Exception $e)
	{
		throw new Exception($e->getMessage());
	}
}

/*
	Sms functions start from here
*/
function send_json_new($url,$data){
	$content = json_encode($data);
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER,
		array("Content-type: application/json",'Authorization: Basic '. base64_encode("thinkLine256:Test1234"))
	);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //curl error SSL certificate problem, verify that the CA cert is OK
	 
	$result = curl_exec($curl);
	if(is_array($result)){
		$response = json_decode($result);
	}else{
		$response = $result;
	}
	//var_dump($response);
	curl_close($curl);
	return $response;
}

function send_new_sms($sender,$reciepient,$message)
{
	global $mysqli;
	$host = 'https://api.infobip.com/sms/1/text/single';
	$feed = send_json_new($host,array("from"=>$sender,"to"=>$reciepient,"text"=>$message));
	
	$feedb = json_decode($feed, true);
	$messageId = $feedb['messages'][0]['messageId'];
	
	$feedc = json_decode($feed, true);
	$status = $feedc['messages'][0]['status']['groupName'];
	
	/*$insert_message = "INSERT INTO messages(sender, reciepient, message, date) VALUES('$sender', '$reciepient', '$message', CURRENT_TIMESTAMP())";
	$query_insert = $mysqli->query($insert_message);*/
	
	return $feed;
}
?>