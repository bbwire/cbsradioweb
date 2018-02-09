<?php



class Controller
{
	public $model = null;
	
	public function __construct($base_url)
	{
		require_once $base_url."/model/Model.php";
		$this->model = new Model($base_url);
	}
	
	/*
		all data
	*/
	public function getdata($table)
	{
		
		$data = $this->model->SelectAll($table);
		
		return $data;
	}	
	
	/*
		do login user
	*/
	public function dologin()
	{
		$username = mysqli_real_escape_string($this->model->mysqli, $_POST['username']);
		$password = mysqli_real_escape_string($this->model->mysqli, $_POST['password']);
		$password = md5($password);
		$redirect = "./";
		$fredirect_url = "login";
		
		$data = $this->model->DoLogin($username, $password, $fredirect_url, $redirect);
		
		return $data;
	}
	
	/*
		the function deletes all the data
	*/
	public function delete($table, $primary_key, $key_value, $redirect_url)
	{
		
		$data = $this->model->delete($table, $primary_key, $key_value, $redirect_url);
		
		return $data;
	}
	
	/*
		the function deletes multiple data
	*/
	public function deletemultiple($table, $primary_key, $key_value, $redirect_url)
	{
		
		$data = $this->model->deleteMultiple($table, $primary_key, $key_value, $redirect_url);
		
		return $data;
	}	
	
	/*
		Get the session id
	*/
	public function userid(){
		
		$data = $this->model->getSessionId();
		
		return $data;
	}
		
	
	/*
		the function gets custom data
	*/
	public function getcustomdata($query)
	{
		
		$data = $this->model->SelectCustom($query);
		
		return $data;
	}
	
	/*
		the function gets individual table data
	*/
	public function getindividual($table, $key, $value)
	{
		
		$data = $this->model->SelectIndividual($table, $key, $value);
		
		return $data;
	}	
	
	/*
		the function that selects from multiple tables
	*/
	public function getmultiple($table1, $table2, $key)
	{
		
		$data = $this->model->SelectMultiple($table1, $table2, $key);
		
		return $data;
	}			
	
	/*
		Get user details
	*/
	public function getuser(){
		
		$data = $this->model->getUserDetails($this->userid());
		
		return $data;
	}
	
	/****
		Data insert
	****/
	public function insert($tabel, $columns, $rows, $url)
	{
		$data = $this->model->save($tabel, $columns, $rows, $url);
		
		return $data;
	}
	
	/****
		Data update
	****/
	public function update($tabel, $columns, $pk, $value, $url)
	{
		$data = $this->model->update($tabel, $columns, $pk, $value, $url);
		
		return $data;
	}

	
	
	/*
		update users
	*/
	public function updatesettings($id)
	{
		$table = "settings";
		$title = mysqli_real_escape_string($this->model->mysqli, $_POST['title']);
		$phone = mysqli_real_escape_string($this->model->mysqli, $_POST['phone']);
		$email = mysqli_real_escape_string($this->model->mysqli, $_POST['email']);
		$version = mysqli_real_escape_string($this->model->mysqli, $_POST['version']);
		$footer = mysqli_real_escape_string($this->model->mysqli, $_POST['footer']);
		
		if(!empty($_FILES['scbanner']['name']) ){
			$pic = $_FILES['scbanner'];
			$pic_name = $pic['name'];
			$pic_name = mysqli_real_escape_string($this->model->mysqli,$pic_name);
			$pic_name = str_replace(' ','-',$pic_name);
			$pic_tmp = $pic['tmp_name'];
			$path = "uploads/".$pic_name;
			move_uploaded_file($pic_tmp,$path);
			
			$clm_val = "siteLogo = '$path'";
			
			$this->model->updateimg($table, $clm_val, "id", $id);
			
		}
							
		$redirect = "settings.php";
		
		$column_value = "siteTitle = '$title', systemEmail = '$email', systemPhone = '$phone', latestVersion = '$version', footerText = '$footer'";
		
		$data = $this->model->update($table, $column_value, "id", $id, $redirect);
		
		return $data;
	}
	
	/*
	public function backupdatabase
	*/
	
	public function backupdatabase($name, $tables=false, $backup_name=false){ 
		date_default_timezone_set("Africa/Kampala");
		set_time_limit(3000); $mysqli = $this->model->mysqli; $mysqli->select_db($name); $mysqli->query("SET NAMES 'utf8'");
		$queryTables = $mysqli->query('SHOW TABLES'); while($row = $queryTables->fetch_row()) { $target_tables[] = $row[0]; }	if($tables !== false) { $target_tables = array_intersect( $target_tables, $tables); } 
		$content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `".$name."`\r\n--\r\n\r\n\r\n";
		foreach($target_tables as $table){
			if (empty($table)){ continue; } 
			$result	= $mysqli->query('SELECT * FROM `'.$table.'`');  	$fields_amount=$result->field_count;  $rows_num=$mysqli->affected_rows; 	$res = $mysqli->query('SHOW CREATE TABLE '.$table);	$TableMLine=$res->fetch_row(); 
			$content .= "\n\n".$TableMLine[1].";\n\n";   $TableMLine[1]=str_ireplace('CREATE TABLE `','CREATE TABLE IF NOT EXISTS `',$TableMLine[1]);
			for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
				while($row = $result->fetch_row())	{ //when started (and every after 100 command cycle):
					if ($st_counter%100 == 0 || $st_counter == 0 )	{$content .= "\nINSERT INTO ".$table." VALUES";}
						$content .= "\n(";    for($j=0; $j<$fields_amount; $j++){ $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); if (isset($row[$j])){$content .= '"'.$row[$j].'"' ;}  else{$content .= '""';}	   if ($j<($fields_amount-1)){$content.= ',';}   }        $content .=")";
					//every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
					if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) {$content .= ";";} else {$content .= ",";}	$st_counter=$st_counter+1;
				}
			} $content .="\n\n\n";
		}
		$content .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
		$backup_name = $backup_name ? $backup_name : $name.'___('.date('H-i-s').'_'.date('d-m-Y').').sql';
		ob_get_clean(); header('Content-Type: application/octet-stream');  header("Content-Transfer-Encoding: Binary");  header('Content-Length: '. (function_exists('mb_strlen') ? mb_strlen($content, '8bit'): strlen($content)) );    header("Content-disposition: attachment; filename=\"".$backup_name."\""); 
		echo $content; exit;
      //see import.php too
	}
	
	/*
	import database file
	*/
	
	public function importdatabase($sql_file_OR_content){
		set_time_limit(3000);
		$SQL_CONTENT = (strlen($sql_file_OR_content) > 300 ?  $sql_file_OR_content : file_get_contents($sql_file_OR_content)  );  
		$allLines = explode("\n",$SQL_CONTENT); 
		$mysqli = $this->model->mysqli; if (mysqli_connect_errno()){echo "Failed to connect to MySQL: " . mysqli_connect_error();} 
			$zzzzzz = $mysqli->query('SET foreign_key_checks = 0');	        preg_match_all("/\nCREATE TABLE(.*?)\`(.*?)\`/si", "\n". $SQL_CONTENT, $target_tables); foreach ($target_tables[2] as $table){$mysqli->query('DROP TABLE IF EXISTS '.$table);}         $zzzzzz = $mysqli->query('SET foreign_key_checks = 1');    $mysqli->query("SET NAMES 'utf8'");	
		$templine = '';	// Temporary variable, used to store current query
		foreach ($allLines as $line)	{											// Loop through each line
			if (substr($line, 0, 2) != '--' && $line != '') {$templine .= $line; 	// (if it is not a comment..) Add this line to the current segment
				if (substr(trim($line), -1, 1) == ';') {		// If it has a semicolon at the end, it's the end of the query
					if(!$mysqli->query($templine)){ print('Error performing query \'<strong>' . $templine . '\': ' . $mysqli->error . '<br /><br />');  }  $templine = ''; // set variable to empty, to start picking up the lines after ";"
				}
			}
		}
		$this->model->Alert("alert-success", "File was successfully uploaded");
		//return 'Importing finished. Now, Delete the import file.';
	}   //see also export.php 

	public function droptable($table){		
		
		// Drop table
		$sql = 'DROP TABLE '.$table;
		if ($this->model->mysqli->query($sql)) {
			
			$this->model->Alert("alert-success", "Table ". $table ." was successfully dropped");
			header("refressh:2; url=settings.php?droptable");
		} else {
			
			$this->model->Alert("alert-danger", "Error dropping table: " . $this->model->mysqli->error);
			header("refressh:2; url=settings.php?droptable");
		}

	}
	
	public function months($key)
	{
		$keymonths = array('01' => 'January', '02' => 'Febuary', '03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'Novermber', '12' => 'December');
		
		return $keymonths[$key];
	}

	public function manageButtons($user, $id)
	{
		$buttons = '';
		$td = '';
		
		$all_modules = 'All modules';
		
		$actions = array("can edit", "can delete");
		
		$get_user = $this->getindividual("tblstaff", "staffId", $user);
		
		if(count($get_user) > 0)
		{
			foreach($get_user as $thisuser)
			{
				$roleid = $thisuser->roleId;
				
				$get_privils = $this->getindividual("privilages", "utype", $roleid);
				
				$priv_string = '';
				foreach($get_privils as $prv)
				{
					$priv_string = $prv->privilageString;
				}
				
				$priv_array = explode(',', $priv_string);
				
				foreach($actions as $action)
				{
					if(in_array($action, $priv_array) or in_array($all_modules, $priv_array))
					{
						if($action == "can edit")
						{
							$tag_open = '<a ';
							$href = 'href="?entry&update='. $id .'"';
							$class = "btn btn-primary";
							$fa = "fa fa-edit";
							$click = '';
							$tag_close = "</a>";
						}
						else
						{
							$tag_open = '<button type="button" ';
							$href = "";
							$class = "btn btn-danger";
							$fa = "fa fa-trash";
							$click = 'data-toggle="modal" data-target="#confirm-delete'. $id .'"';
							$tag_close = "</button>";
						}
						
						$buttons .= $tag_open .' '. $href .' class="'. $class .' btn-xs" '. $click .'><i class="'. $fa .'"></i>'. $tag_close;
						
						$td = '<td>'. $buttons .'</td>';
					}
				}
			}
			
			
		}
		
		return $td;
	}

	public function manageHead($user)
	{
		$buttons = '';
		$th = '';
		
		$all_modules = 'All modules';
		
		$actions = array("can edit", "can delete");
		
		$get_user = $this->getindividual("tblstaff", "staffId", $user);
		
		if(count($get_user) > 0)
		{
			foreach($get_user as $thisuser)
			{
				$roleid = $thisuser->roleId;
				
				$get_privils = $this->getindividual("privilages", "utype", $roleid);
				
				$priv_string = '';
				foreach($get_privils as $prv)
				{
					$priv_string = $prv->privilageString;
				}
				
				$priv_array = explode(',', $priv_string);
				
				foreach($actions as $action)
				{
					if(in_array($action, $priv_array) or in_array($all_modules, $priv_array))
					{						
						$th = '<th>Manage</th>';
					}
				}
			}
			
		}
		
		return $th;
	}

	public function showMenu($user, $privilage)
	{
		$class = 'hidemenu';
		
		$all_modules = 'All modules';
		
		$get_user = $this->getindividual("users", "id", $user);
		
		if(count($get_user) > 0)
		{
			foreach($get_user as $thisuser)
			{
				$roleid = $thisuser->position;
				
				$get_privils = $this->getindividual("privilages", "utype", $roleid);
				
				$priv_string = '';
				foreach($get_privils as $prv)
				{
					$priv_string = $prv->privilageString;
				}
				
				$priv_array = explode(',', $priv_string);
				
				if(in_array($privilage, $priv_array) or in_array($all_modules, $priv_array))
				{						
					$class = '';
				}
				
			}
			
		}
		
		return $class;
		
	}

	public function showModule($user, $privilages)
	{
		$class = 'hidemenu';
		
		$all_modules = 'All modules';
		
		$privilages_exp = explode(',', $privilages);
		
		$get_user = $this->getindividual("users", "id", $user);
		
		if(count($get_user) > 0)
		{
			foreach($get_user as $thisuser)
			{
				$roleid = $thisuser->position;
				
				$get_privils = $this->getindividual("privilages", "utype", $roleid);
				
				$priv_string = '';
				foreach($get_privils as $prv)
				{
					$priv_string = $prv->privilageString;
				}
				
				$priv_array = explode(',', $priv_string);
				
				$count = 0;
				foreach($privilages_exp as $privilage)
				{
					if(in_array($privilage, $priv_array) || in_array($all_modules, $priv_array))
					{						
						$count++;
					}
				}
				
				if($count > 0){
					$class = '';
				}
				
			}
			
		}
		
		return $class;
		
	}

	public function checkAddPrivilage($user, $gridtype)
	{
		if($gridtype == 'addgrid')
		{
			$class = 'class="col-md-4 col-sm-4 col-xs-12 hidemenu"';
		}else
		{
			$class = 'class="col-md-12 col-sm-12 col-xs-12"';
		}
		
		$action = "can add";
		
		$get_user = $this->getindividual("tblstaff", "staffId", $user);
		
		if(count($get_user) > 0)
		{
			foreach($get_user as $thisuser)
			{
				$roleid = $thisuser->roleId;
				
				$get_privils = $this->getindividual("privilages", "utype", $roleid);
				
				$priv_string = '';
				foreach($get_privils as $prv)
				{
					$priv_string = $prv->privilageString;
				}
				
				$priv_array = explode(',', $priv_string);
				
				if(in_array($action, $priv_array))
				{		
					if($gridtype == 'addgrid')
					{				
						$class = 'class="col-md-4 col-sm-4 col-xs-12"';
					}else
					{
						$class = 'class="col-md-8 col-sm-8 col-xs-12"';
					}
				}
			}
			
		}
		
		return $class;
	}

	public function time_elapsed_string($datetime, $full = false) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
}