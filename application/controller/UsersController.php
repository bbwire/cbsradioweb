<?php
require_once "application/controller/Controller.php"; 

class UsersController extends Controller
{
	
	/*
		add new user
	*/
	public function postsupplier($redirect, $table)
	{
		$name = mysqli_real_escape_string($this->model->mysqli, $_POST['supname']);
		$phone = mysqli_real_escape_string($this->model->mysqli, $_POST['supnum']);
		$address = mysqli_real_escape_string($this->model->mysqli, $_POST['supaddress']);
		$date = date("Y-m-d");
		
		$columns = "supplierName, telephoneNum, physicalAddress";
		
		$values = "'$name', '$phone', '$address'";
		
		$data = $this->model->save($table, $columns, $values, $redirect);
		
		return $data;
	}
	
	/*
		update users
	*/
	public function updatesupplier($id, $redirect, $pk, $table)
	{
		$name = mysqli_real_escape_string($this->model->mysqli, $_POST['supname']);
		$phone = mysqli_real_escape_string($this->model->mysqli, $_POST['supnum']);
		$address = mysqli_real_escape_string($this->model->mysqli, $_POST['supaddress']);
							
		
		$column_value = "supplierName = '$name', telephoneNum = '$phone', physicalAddress = '$address'";
		
		
		$data = $this->model->update($table, $column_value, $pk, $id, $redirect);
		
		return $data;
	}
	/*
		add new user
	*/
	public function postnews($redirect, $table)
	{
		$title = mysqli_real_escape_string($this->model->mysqli, $_POST['title']);
		$desc = mysqli_real_escape_string($this->model->mysqli, $_POST['desc']);
		$uid = mysqli_real_escape_string($this->model->mysqli, $_POST['uid']);
		$date = date("Y-m-d");
		
		$columns = "title, description, user, dateReported";
		
		$values = "'$title', '$desc', '$uid', '$date'";
		
		$data = $this->model->save($table, $columns, $values, $redirect);
		
		return $data;
	}
	
	/*
		update users
	*/
	public function updatenews($id, $redirect, $pk, $table)
	{
		$title = mysqli_real_escape_string($this->model->mysqli, $_POST['title']);
		$desc = mysqli_real_escape_string($this->model->mysqli, $_POST['desc']);
							
		
		$column_value = "title = '$title', description = '$desc'";
		
		
		$data = $this->model->update($table, $column_value, $pk, $id, $redirect);
		
		return $data;
	}
	
	/*
		update users
	*/
	public function updateprofile($eid, $id, $redirect, $pk, $table)
	{
		$fname = mysqli_real_escape_string($this->model->mysqli, $_POST['fname']);
		$lname = mysqli_real_escape_string($this->model->mysqli, $_POST['lname']);
		$address = mysqli_real_escape_string($this->model->mysqli, $_POST['address']);
		$phone = mysqli_real_escape_string($this->model->mysqli, $_POST['phone']);
		$email = mysqli_real_escape_string($this->model->mysqli, $_POST['email']);
		$gender = mysqli_real_escape_string($this->model->mysqli, $_POST['gender']);
		$username = mysqli_real_escape_string($this->model->mysqli, $_POST['username']);
							
		
		$column_value = "fname = '$fname', lname = '$lname', phone = '$phone', email = '$email', gender = '$gender', address = '$address'";
		
		$column_value_user = "username = '$username'";
		
		$data = $this->model->update($table, $column_value, $pk, $eid, $redirect);
		
				$this->model->markasread("users", $column_value_user, "userid", $id, $redirect);
				
		return $data;
	}
	
	/*
		update users
	*/
	public function updatepassword($id, $redirect)
	{
		$table = "users";
		$pass = mysqli_real_escape_string($this->model->mysqli, $_POST['pass']);
		$cpass = mysqli_real_escape_string($this->model->mysqli, $_POST['cpass']);
				
		if($pass != $cpass)
		{
			$data = $this->model->Alert("alert-danger", "Sorry your new passwords did not match");
						
			$this->model->Redirect("2", $redirect);
		}
		else
		{
		
			$column_value = "password = '". md5($pass) ."', passwordshow = '". $pass ."'";
			
			$data = $this->model->update($table, $column_value, "userid", $id, "logout.php");
		}
		return $data;
	}
	
	/*
		post employee details
	*/
	public function postuser($redirect, $table)
	{
		
		$fname = mysqli_real_escape_string($this->model->mysqli, $_POST['fname']);
		$lname = mysqli_real_escape_string($this->model->mysqli, $_POST['lname']);
		$phone = mysqli_real_escape_string($this->model->mysqli, $_POST['phone']);
		$email = mysqli_real_escape_string($this->model->mysqli, $_POST['email']);
		$dob = mysqli_real_escape_string($this->model->mysqli, $_POST['dob']);
		$gender = mysqli_real_escape_string($this->model->mysqli, $_POST['gender']);
		$jdate = mysqli_real_escape_string($this->model->mysqli, $_POST['jdate']);
		$role = mysqli_real_escape_string($this->model->mysqli, $_POST['role']);
		$station = mysqli_real_escape_string($this->model->mysqli, $_POST['station']);
		$username = mysqli_real_escape_string($this->model->mysqli, $_POST['username']);
		$password = mysqli_real_escape_string($this->model->mysqli, $_POST['password']);
		
		if(!empty($_FILES['pic']['name']) ){
			$pic = $_FILES['pic'];
			$pic_name = $pic['name'];
			$pic_name = mysqli_real_escape_string($this->model->mysqli,$pic_name);
			$pic_name = str_replace(' ','-',$pic_name);
			$pic_tmp = $pic['tmp_name'];
			$path = "uploads/".$pic_name;
			move_uploaded_file($pic_tmp,$path);
		}else{
			$path = '';
		}
							
							
		$date = date("Y-m-d");
		
		$columns = "fname, lname, phone, email,  dob, gender, joindate, photo, position, username, password, station";
		
		$values = "'$fname', '$lname', '$phone', '$email', '$dob', '$gender', '$jdate', '$path', '$role', '$username', '". md5($password) ."', '$station'";
		
		$data = $this->model->save($table, $columns, $values, $redirect);
		
		return $data;
	}
	
	/*
		post employee details
	*/
	public function updateuser($id, $redirect, $pk, $table)
	{
		
		$fname = mysqli_real_escape_string($this->model->mysqli, $_POST['fname']);
		$lname = mysqli_real_escape_string($this->model->mysqli, $_POST['lname']);
		$phone = mysqli_real_escape_string($this->model->mysqli, $_POST['phone']);
		$email = mysqli_real_escape_string($this->model->mysqli, $_POST['email']);
		$dob = mysqli_real_escape_string($this->model->mysqli, $_POST['dob']);
		$gender = mysqli_real_escape_string($this->model->mysqli, $_POST['gender']);
		$jdate = mysqli_real_escape_string($this->model->mysqli, $_POST['jdate']);
		$role = mysqli_real_escape_string($this->model->mysqli, $_POST['role']);
		$station = mysqli_real_escape_string($this->model->mysqli, $_POST['station']);
		$username = mysqli_real_escape_string($this->model->mysqli, $_POST['username']);
		
		if(!empty($_FILES['pic']['name']) ){
			$pic = $_FILES['pic'];
			$pic_name = $pic['name'];
			$pic_name = mysqli_real_escape_string($this->model->mysqli,$pic_name);
			$pic_name = str_replace(' ','-',$pic_name);
			$pic_tmp = $pic['tmp_name'];
			$path = "uploads/".$pic_name;
			move_uploaded_file($pic_tmp,$path);
			
			$clm_val = "photo = '$path'";
			
			$this->model->updateimg($table, $clm_val, "userid", $id);
		}
							
							
		$date = date("Y-m-d");
		
		$columns = "fname = '$fname', lname = '$lname', dob = '$dob', gender = '$gender', joindate = '$jdate', phone = '$phone', email = '$email', position = '$role', username = '$username', station = '$station'";
		
		$data = $this->model->update($table, $columns, $pk, $id, $redirect);
		
		return $data;
	}
	
	
	
	/*
		Upload from excel sheet
	*/
	public function importemployees($redirect, $table)
	{
		
		if(isset($_FILES['file']['name']))
		{
			$filename = $_FILES["file"]["tmp_name"];
	 
	 
			 if($_FILES["file"]["size"] > 0)
			 {
	 
				$file = fopen($filename, "r");
				
				$row = 0;
				
				 while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
				 {
					 $row++;
					 
					 if($row == 1){}
	 				  else
					  {
						  
						  $fname = $emapData[2];
						  $lname = $emapData[3];
						  $dob = $emapData[5];
						  $deptitles = $emapData[6];
						  $gender = $emapData[7];
						  
						  $check_datas = $this->getcustomdata("select * from employees order by employeeId desc limit 1");
						  $empcode = '';
						  foreach($check_datas as $data)
						  {
							  $empcode = $data->employeeCode;
						  }
						  
						  $empcode_array = preg_split('/(?<=[A-Z])(?=[0-9]+)/i', $empcode);
						  
						  $empcode_num = $empcode_array[1];
						  
						  $new_num = $empcode_num+1;
						  
						  if($new_num > 9)
						  	$codeprefix = "EMP0";
						  else if($new_num > 99)
						  	$codeprefix = "BSHCL";
						  else if($new_num < 10)
						  	$codeprefix = "EMP00";
							
						
						  $check_departs = $this->getindividual("departments", "name", $deptitles);
						  
						  foreach($check_departs as $depart)
						  {
							  $depid = $depart->departmentId;
						  }
						  
						  $code = $codeprefix.$new_num;
						  
						  $columns = "employeeCode, department, fname, lname, dob, gender";
		
						  $values = "'$code', '$depid', '$fname', '$lname', '$dob', '$gender'";
									  
						  $data = $this->model->saveexcel($table, $columns, $values, $redirect);	
					  }
		
				 }
				 
				 fclose($file);
				 
				 $this->model->Alert("alert-success", "Data has been uploaded successfully!");
				 
			 }
		}
		
		return $data;
	}
	
	/*
		post usertype
	*/
	public function posttype($redirect, $table)
	{
		
		$type = mysqli_real_escape_string($this->model->mysqli, $_POST['type']);
							
		$date = date("Y-m-d");
		
		$columns = "roleName";
		
		$values = "'$type'";
		
		$data = $this->model->save($table, $columns, $values, $redirect);
		
		return $data;
	}
	
	
	
	/*
		post usertype
	*/
	public function updatetype($id, $redirect, $pk, $table)
	{
		
		$type = mysqli_real_escape_string($this->model->mysqli, $_POST['type']);
							
		$date = date("Y-m-d");
		
		$columns = "roleName = '$type'";
		
		$data = $this->model->update($table, $columns, $pk, $id, $redirect);
		
		return $data;
	}
	
	/*
		post usertype
	*/
	public function postdepartment($redirect, $table)
	{
		
		$name = mysqli_real_escape_string($this->model->mysqli, $_POST['name']);
		$code = mysqli_real_escape_string($this->model->mysqli, $_POST['code']);
		$units = mysqli_real_escape_string($this->model->mysqli, $_POST['units']);
		$cost = mysqli_real_escape_string($this->model->mysqli, $_POST['cost']);
							
		$date = date("Y-m-d");
		
		$check_departs = $this->getindividual("departments", "name", $name);
		
		if(count($check_departs) > 0)
		{
			$this->model->Alert("alert-danger", "Sorry! Department ($name) is already registered");
		}
		else
		{
			$columns = "name, code, units, cost";
			
			$values = "'$name', '$code', '$units', '$cost'";
			
			$data = $this->model->save($table, $columns, $values, $redirect);
			
			return $data;
		}
	}
	
	
	
	/*
		update department
	*/
	public function updatedepartment($id, $redirect, $pk, $table)
	{
		
		$name = mysqli_real_escape_string($this->model->mysqli, $_POST['name']);
		$code = mysqli_real_escape_string($this->model->mysqli, $_POST['code']);
		$units = mysqli_real_escape_string($this->model->mysqli, $_POST['units']);
		$cost = mysqli_real_escape_string($this->model->mysqli, $_POST['cost']);
							
		$date = date("Y-m-d");
		
		$columns = "name = '$name', code = '$code', units = '$units', cost = '$cost'";
		
		$data = $this->model->update($table, $columns, $pk, $id, $redirect);
		
		return $data;
	}
	
	
	
	/*
		post job title
	*/
	public function postjobtitle($redirect, $table)
	{
		
		$title = mysqli_real_escape_string($this->model->mysqli, $_POST['title']);
							
		$date = date("Y-m-d");
		
		$columns = "title";
		
		$values = "'$title'";
		
		$data = $this->model->save($table, $columns, $values, $redirect);
		
		return $data;
	}
	
	
	
	/*
		post job title
	*/
	public function updatejobtitle($id, $redirect, $pk, $table)
	{
		
		$title = mysqli_real_escape_string($this->model->mysqli, $_POST['title']);
							
		$date = date("Y-m-d");
		
		$columns = "title = '$title'";
		
		$data = $this->model->update($table, $columns, $pk, $id, $redirect);
		
		return $data;
	}
	
	
	
	/*
		post job title
	*/
	public function postworkshift($redirect, $table)
	{
		
		$shift = mysqli_real_escape_string($this->model->mysqli, $_POST['shift']);
							
		$date = date("Y-m-d");
		
		$columns = "shiftName";
		
		$values = "'$shift'";
		
		$data = $this->model->save($table, $columns, $values, $redirect);
		
		return $data;
	}
	
	
	
	/*
		post job title
	*/
	public function updateworkshift($id, $redirect, $pk, $table)
	{
		
		$shift = mysqli_real_escape_string($this->model->mysqli, $_POST['shift']);
							
		$date = date("Y-m-d");
		
		$columns = "shiftName = '$shift'";
		
		$data = $this->model->update($table, $columns, $pk, $id, $redirect);
		
		return $data;
	}
	
	
	
	/*
		post job title
	*/
	public function postemployeestatus($redirect, $table)
	{
		
		$status = mysqli_real_escape_string($this->model->mysqli, $_POST['status']);
							
		$date = date("Y-m-d");
		
		$columns = "statusName";
		
		$values = "'$status'";
		
		$data = $this->model->save($table, $columns, $values, $redirect);
		
		return $data;
	}
	
	
	
	/*
		post job title
	*/
	public function updateemployeestatus($id, $redirect, $pk, $table)
	{
		
		$status = mysqli_real_escape_string($this->model->mysqli, $_POST['status']);
							
		$date = date("Y-m-d");
		
		$columns = "statusName = '$status'";
		
		$data = $this->model->update($table, $columns, $pk, $id, $redirect);
		
		return $data;
	}
	
	
	/*
		post job title
	*/
	public function posttheme($redirect, $table)
	{
		
		$theme = mysqli_real_escape_string($this->model->mysqli, $_POST['theme']);
		$themefile = mysqli_real_escape_string($this->model->mysqli, $_POST['themefile']);
							
		$date = date("Y-m-d");
		
		$columns = "themeName, themeFile";
		
		$values = "'$theme', '$themefile'";
		
		$data = $this->model->save($table, $columns, $values, $redirect);
		
		return $data;
	}
	
	
	
	/*
		post job title
	*/
	public function updatetheme($id, $redirect, $pk, $table)
	{
		
		$theme = mysqli_real_escape_string($this->model->mysqli, $_POST['theme']);
		$themefile = mysqli_real_escape_string($this->model->mysqli, $_POST['themefile']);
							
		$date = date("Y-m-d");
		
		$columns = "themeName = '$theme', themeFile = '$themefile'";
		
		$data = $this->model->update($table, $columns, $pk, $id, $redirect);
		
		return $data;
	}
	
	/*
		post job title
	*/
	public function postconfig($redirect, $table)
	{
		
		$theme = mysqli_real_escape_string($this->model->mysqli, $_POST['theme']);
		$font = mysqli_real_escape_string($this->model->mysqli, $_POST['font']);
		$path = '';					
		
		if(!empty($_FILES['logo']['name']) ){
			$pic = $_FILES['logo'];
			$pic_name = $pic['name'];
			$pic_name = mysqli_real_escape_string($this->model->mysqli,$pic_name);
			$pic_name = str_replace(' ','-',$pic_name);
			$pic_tmp = $pic['tmp_name'];
			$path = "uploads/".$pic_name;
			move_uploaded_file($pic_tmp,$path);
			
		}
		
		$columns = "theme, logo, fontSize";
		
		$values = "'$theme', '$path', '$font'";
		
		$data = $this->model->save($table, $columns, $values, $redirect);
		
		return $data;
	}
	
	
	
	/*
		post job title
	*/
	public function updateconfig($id, $redirect, $pk, $table)
	{
		
		$theme = mysqli_real_escape_string($this->model->mysqli, $_POST['theme']);
		$font = mysqli_real_escape_string($this->model->mysqli, $_POST['font']);
		
		if(!empty($_FILES['logo']['name']) ){
			$pic = $_FILES['logo'];
			$pic_name = $pic['name'];
			$pic_name = mysqli_real_escape_string($this->model->mysqli,$pic_name);
			$pic_name = str_replace(' ','-',$pic_name);
			$pic_tmp = $pic['tmp_name'];
			$path = "uploads/".$pic_name;
			move_uploaded_file($pic_tmp,$path);
			
			$clm_val = "logo = '$path'";
			
			$this->model->updateimg($table, $clm_val, "configId", $id);
		}
		
		$columns = "theme = '$theme', fontSize = '$font'";
		
		$data = $this->model->update($table, $columns, $pk, $id, $redirect);
		
		return $data;
	}
}
?>