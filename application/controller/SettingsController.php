<?php
require_once "application/controller/Controller.php"; 

class SettingsController extends Controller
{
	
	
	/*
		post usertype
	*/
	public function posttask($redirect, $table)
	{
		
		$title = mysqli_real_escape_string($this->model->mysqli, $_POST['title']);
		$deadline = mysqli_real_escape_string($this->model->mysqli, $_POST['deadline']);
							
		$date = date("Y-m-d");
		
		$columns = "title, deadline";
		
		$values = "'$title', '$deadline'";
		
		$data = $this->model->save($table, $columns, $values, $redirect);
		
		return $data;
	}
	
	
	
	/*
		post usertype
	*/
	public function updatetask($id, $redirect, $pk, $table)
	{
		
		$title = mysqli_real_escape_string($this->model->mysqli, $_POST['title']);
		$deadline = mysqli_real_escape_string($this->model->mysqli, $_POST['deadline']);
							
		$date = date("Y-m-d");
		
		$columns = "title = '$title', deadline = '$deadline'";
		
		$data = $this->model->update($table, $columns, $pk, $id, $redirect);
		
		return $data;
	}
	
	/*
		post usertype
	*/
	public function posttype($redirect, $table)
	{
		
		$type = mysqli_real_escape_string($this->model->mysqli, $_POST['type']);
							
		$date = date("Y-m-d");
		
		$columns = "typeName";
		
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
		
		$columns = "typeName = '$type'";
		
		$data = $this->model->update($table, $columns, $pk, $id, $redirect);
		
		return $data;
	}
	
	/*
		post usertype
	*/
	public function postnewstype($redirect, $table)
	{
		
		$type = mysqli_real_escape_string($this->model->mysqli, $_POST['type']);
							
		$date = date("Y-m-d");
		
		$columns = "newsTypeName";
		
		$values = "'$type'";
		
		$data = $this->model->save($table, $columns, $values, $redirect);
		
		return $data;
	}
	
	
	
	/*
		post usertype
	*/
	public function updatenewstype($id, $redirect, $pk, $table)
	{
		
		$type = mysqli_real_escape_string($this->model->mysqli, $_POST['type']);
							
		$date = date("Y-m-d");
		
		$columns = "newsTypeName = '$type'";
		
		$data = $this->model->update($table, $columns, $pk, $id, $redirect);
		
		return $data;
	}
	
	/*
		post usertype
	*/
	public function poststation($redirect, $table)
	{
		
		$station = mysqli_real_escape_string($this->model->mysqli, $_POST['station']);
							
		$date = date("Y-m-d");
		
		$columns = "stationName";
		
		$values = "'$station'";
		
		$data = $this->model->save($table, $columns, $values, $redirect);
		
		return $data;
	}
	
	
	
	/*
		post usertype
	*/
	public function updatestation($id, $redirect, $pk, $table)
	{
		
		$station = mysqli_real_escape_string($this->model->mysqli, $_POST['station']);
							
		$date = date("Y-m-d");
		
		$columns = "stationName = '$station'";
		
		$data = $this->model->update($table, $columns, $pk, $id, $redirect);
		
		return $data;
	}
	/*
		post usertype
	*/
	public function postprivilage($redirect, $table)
	{
		
		$type = mysqli_real_escape_string($this->model->mysqli, $_POST['type']);
		$privs = implode(',', $_POST['privs']);
							
		$date = date("Y-m-d");
		
		$check_user = $this->getindividual("privilages", "utype", $type);
		
		if(count($check_user) > 0)
		{
			$data = $this->model->Alert("alert-danger", "Sorry! User type has already been assigned privilages");
		}
		else
		{
			$columns = "utype, privilageString";
			
			$values = "'$type', '$privs'";
			
			$data = $this->model->save($table, $columns, $values, $redirect);
			
		}
		
		return $data;
	}
	
	
	
	/*
		post usertype
	*/
	public function updateprivilage($id, $redirect, $pk, $table)
	{
		
		$type = mysqli_real_escape_string($this->model->mysqli, $_POST['type']);
		$privs = implode(',', $_POST['privs']);
							
		$date = date("Y-m-d");
		
		$columns = "utype = '$type', privilageString = '$privs'";
		
		$data = $this->model->update($table, $columns, $pk, $id, $redirect);
		
		return $data;
	}
	/*
		post to air
	*/
	public function posttoair($redirect, $table, $id)
	{
		$time = mysqli_real_escape_string($this->model->mysqli, $_POST['time']);
		$date = date("Y-m-d");
		
		$check_news_time = $this->getcustomdata("select * from ". $table ." where timeId = '$time' and date = '$date'");
		
		if(count($check_news_time) > 0)
		{
			foreach($check_news_time as $ntime)
			{
				$nstring = $ntime->newsString;
				$tbid = $ntime->airId;
			}
			
			$nstring_array = explode(",", $nstring);
			
			if(in_array($id, $nstring_array))
			{
				$data = $this->model->Alert("alert-danger", "Sorry! Already addaed");
			}
			else
			{
				$newstring = $nstring.','.$id;
				
				$columns = "newsString = '$newstring'";
		
				$data = $this->model->update($table, $columns, "airId", $tbid, $redirect);
				
				$news_columns = "status = 'selected'";
				
				$this->model->update("posts", $news_columns, "id", $id, $redirect);
			}
		}
		else
		{
			$columns = "timeId, newsString, date";
			
			$values = "'$time', '$id', '$date'";
			
			$data = $this->model->save($table, $columns, $values, $redirect);
			
			$news_columns = "status = 'selected'";
				
			$this->model->update("posts", $news_columns, "id", $id, $redirect);
			
		}
		
		return $data;
	}
	/*
		post usertype
	*/
	public function postair($redirect, $table)
	{
		
		$time = mysqli_real_escape_string($this->model->mysqli, $_POST['time']);
		$news = implode(',', $_POST['news']);
							
		$date = date("Y-m-d");
		
		$check_user = $this->getcustomdata("select * from ". $table ." where timeId = '$time' and date = '$date'");
		
		if(count($check_user) > 0)
		{
			$data = $this->model->Alert("alert-danger", "Sorry! Time has already been assigned news");
		}
		else
		{
			$columns = "timeId, newsString, date";
			
			$values = "'$time', '$news', '$date'";
			
			$data = $this->model->save($table, $columns, $values, $redirect);
			
		}
		
		return $data;
	}
	
	
	
	/*
		post usertype
	*/
	public function updateair($id, $redirect, $pk, $table)
	{
		
		$time = mysqli_real_escape_string($this->model->mysqli, $_POST['time']);
		$news = implode(',', $_POST['news']);
							
		$date = date("Y-m-d");
		
		$columns = "timeId = '$time', newsString = '$news'";
		
		$data = $this->model->update($table, $columns, $pk, $id, $redirect);
		
		return $data;
	}
	
	/*
		post usertype
	*/
	public function posttime($redirect, $table)
	{
		
		$timelabel = mysqli_real_escape_string($this->model->mysqli, $_POST['timelabel']);
							
		$date = date("Y-m-d");
		
		$check_departs = $this->getindividual($table, "timeLabel", $timelabel);
		
		if(count($check_departs) > 0)
		{
			$this->model->Alert("alert-danger", "Sorry! Time ($timelabel) is already registered");
		}
		else
		{
			$columns = "timeLabel";
			
			$values = "'$timelabel'";
			
			$data = $this->model->save($table, $columns, $values, $redirect);
			
			return $data;
		}
	}
	
	/*
		update department
	*/
	public function updatetime($id, $redirect, $pk, $table)
	{
		
		$timelabel = mysqli_real_escape_string($this->model->mysqli, $_POST['timelabel']);
		
		$columns = "timeLabel = '$timelabel'";
		
		$data = $this->model->update($table, $columns, $pk, $id, $redirect);
		
		return $data;
	}
	
	/*
		post usertype
	*/
	public function assigntime($redirect, $table)
	{
		
		$station = mysqli_real_escape_string($this->model->mysqli, $_POST['station']);
		$user = mysqli_real_escape_string($this->model->mysqli, $_POST['user']);
		$time = mysqli_real_escape_string($this->model->mysqli, $_POST['time']);
							
		$date = date("Y-m-d");
		
		$check_departs = $this->getcustomdata("select * from ".$table." where station = '$station' and user = '$user' and timeid = '$time'");
		
		if(count($check_departs) > 0)
		{
			$get_user = $this->getindividual("users", "userid", $user);
			foreach($get_user as $us)
			{
				$usnam = $us->fname.' '.$us->lname;
			}
			
			$get_station = $this->getindividual("stations", "stationId", $station);
			foreach($get_station as $stat)
			{
				$statnam = $stat->stationName;
			}
			
			$get_time = $this->getindividual("newstime", "timeId", $time);
			foreach($get_time as $tym)
			{
				$tymnam = $tym->timeLabel;
			}
			
			$this->model->Alert("alert-danger", "Sorry! News anchor <$usnam> of $statnam has already been assigned $tymnam ");
		}
		else
		{
			$columns = "station, user, timeid";
			
			$values = "'$station', '$user', '$time'";
			
			$data = $this->model->save($table, $columns, $values, $redirect);
			
			return $data;
		}
	}
	
	/*
		update department
	*/
	public function updateassignedtime($id, $redirect, $pk, $table)
	{
		
		$station = mysqli_real_escape_string($this->model->mysqli, $_POST['station']);
		$user = mysqli_real_escape_string($this->model->mysqli, $_POST['user']);
		$time = mysqli_real_escape_string($this->model->mysqli, $_POST['time']);
		
		$columns = "station = '$station', user = '$user', timeid = '$time'";
		
		$data = $this->model->update($table, $columns, $pk, $id, $redirect);
		
		return $data;
	}
	
	/*
		post usertype
	*/
	public function assigntask($redirect, $table)
	{
		
		$user = mysqli_real_escape_string($this->model->mysqli, $_POST['user']);
		$task = mysqli_real_escape_string($this->model->mysqli, $_POST['task']);
		$from = mysqli_real_escape_string($this->model->mysqli, $_POST['from']);
		$to = mysqli_real_escape_string($this->model->mysqli, $_POST['to']);
							
		$date = date("Y-m-d");
		
		$check_departs = $this->getcustomdata("select * from ".$table." where user = '$user' and task = '$task'");
		
		if(count($check_departs) > 0)
		{
			$get_user = $this->getindividual("users", "userid", $user);
			foreach($get_user as $us)
			{
				$usnam = $us->fname.' '.$us->lname;
			}
			
			$get_tasks = $this->getindividual("tasks", "taskId", $task);
			foreach($get_tasks as $tas)
			{
				$tasnam = $tas->title;
			}
			
			$this->model->Alert("alert-danger", "Sorry! News <$usnam> has already been assigned $tasnam ");
		}
		else
		{
			$columns = "user, task, taskfrom, taskto";
			
			$values = "'$user', '$task', '$from', '$to'";
			
			$data = $this->model->save($table, $columns, $values, $redirect);
			
			return $data;
		}
	}
	
	/*
		update department
	*/
	public function updateassignedtask($id, $redirect, $pk, $table)
	{
		
		$user = mysqli_real_escape_string($this->model->mysqli, $_POST['user']);
		$task = mysqli_real_escape_string($this->model->mysqli, $_POST['task']);
		$from = mysqli_real_escape_string($this->model->mysqli, $_POST['from']);
		$to = mysqli_real_escape_string($this->model->mysqli, $_POST['to']);
		
		$columns = "user = '$user', task = '$task', taskfrom = '$from', taskto = '$to'";
		
		$data = $this->model->update($table, $columns, $pk, $id, $redirect);
		
		return $data;
	}
	
	/*
		remove post
	*/
	public function removepost($table, $url, $pk, $id, $time, $postid)
	{
		$date = date("Y-m-d");
		
		$check_news_time = $this->getcustomdata("select * from ". $table ." where timeId = '" . $time ."' and date = '". $date ."'");
		
		if(count($check_news_time) > 0)
		{
			foreach($check_news_time as $ntime)
			{
				$nstring = $ntime->newsString;
			}
			
			$nstring_array = explode(",", $nstring);
			
			//echo $nstring;
			
			if(in_array($postid, $nstring_array))
			{
				if(count($nstring_array) > 1)
				{
					$tochange = "$postid,";
					//echo $tochange;
					$newstring = str_replace("$postid,", "", $nstring);
					
					$columns = "newsString = '$newstring'";
					
					$data = $this->model->update($table, $columns, $pk, $id, $url);
					
					$news_columns = "status = 'pending'";
				
					$this->model->update("posts", $news_columns, "id", $postid, $url);
				}
				else
				{
					$data = $this->delete($table, $pk, $id, $url);
					
					$news_columns = "status = 'pending'";
				
					$this->model->update("posts", $news_columns, "id", $postid, $url);
					
					
				}
			}
		}else
		{
			$data = "Date seemed to be ";
		}
		
		return $data;
	}
	
	/*
		post usertype
	*/
	public function postnews($redirect, $table)
	{
		
		$title = $_POST['title'];
		
		//echo count($title);

		for($i=0; $i<count($title); $i++)
		{
			$title = mysqli_real_escape_string($this->model->mysqli, $_POST["title"][$i]);
			$desc = mysqli_real_escape_string($this->model->mysqli, $_POST["desc"][$i]);
			$uid = mysqli_real_escape_string($this->model->mysqli, $_POST['uid']);
			$newstype = mysqli_real_escape_string($this->model->mysqli, $_POST["newstype"][$i]);
			$tobeaired = mysqli_real_escape_string($this->model->mysqli, $_POST["time"][$i]);

			$url = "http://ulvcloud.com/cbsradioweb/";
			
			
			$imgpath = '';
			if(!empty($_FILES["pic"][$i]['name']) ){
				$pic = $_FILES["pic"][$i];
				$pic_name = $pic["name"];
				$pic_name = mysqli_real_escape_string($this->model->mysqli, $pic_name);
				$pic_name = str_replace(' ','-', $pic_name);
				$pic_name = time().'_'.$pic_name;
				$pic_tmp = $pic['tmp_name'];
				$imgpath = "uploads/".$pic_name;
				move_uploaded_file($pic_tmp, $imgpath);
			}

			$audiopath = '';
			if(!empty($_FILES["audio"][$i]['name']) ){
				$pic = $_FILES["audio"][$i];
				$pic_name = $pic['name'];
				$pic_name = mysqli_real_escape_string($this->model->mysqli, $pic_name);
				$pic_name = str_replace(' ','-', $pic_name);
				$pic_name = time().'_'.$pic_name;
				$pic_tmp = $pic['tmp_name'];
				$audiopath = "uploads/".$pic_name;
				move_uploaded_file($pic_tmp, $audiopath);
			}

			$videopath = '';
			if(!empty($_FILES["video"][$i]['name']) ){
				$pic = $_FILES["video"][$i];
				$pic_name = $pic['name'];
				$pic_name = mysqli_real_escape_string($this->model->mysqli, $pic_name);
				$pic_name = str_replace(' ','-', $pic_name);
				$pic_name = time().'_'.$pic_name;
				$pic_tmp = $pic['tmp_name'];
				$videopath = "uploads/".$pic_name;
				move_uploaded_file($pic_tmp, $videopath);
			}
				
			
								
			$date = date("Y-m-d");
			
			$check_news = $this->getindividual($table, "title", $title);
			
			if(count($check_news) > 0)
			{
				$this->model->Alert("alert-danger", "Sorry! News with title ($title) is already posted");
			}
			else
			{
				$columns = "title, description, user, status, dateReported";
				
				$values = "'$title', '$desc', '$uid', 'selected', '$date'";
				
				$data = $this->model->saveexcel($table, $columns, $values, $redirect);

				$postid = $this->model->mysqli->insert_id;

				$columns_updt = "postId, title, description, newsTypeId, tobeaired";

				$values_updt = "'$postid', '$title', '$desc', '$newstype', '$tobeaired'";

				$this->model->saveexcel("postupdate", $columns_updt, $values_updt, "");

				if($imgpath != ''){
					$imgpathurl = $url.$imgpath;
					$img_columns = "post, file_path, type, description";

					$img_values = "'$postid', '$imgpathurl', 'Photo', 'This is a photo'";

					$this->model->saveexcel("uploads", $img_columns, $img_values, "");
				}

				if($audiopath != ''){
					$audiopathurl = $url.$audiopath;
					$audio_columns = "post, file_path, type, description";

					$audio_values = "'$postid', '$audiopathurl', 'Audio', 'This is a audio'";

					$this->model->saveexcel("uploads", $audio_columns, $audio_values, "");
				}

				if($videopath != ''){
					$videopathurl = $url.$videopath;
					$video_columns = "post, file_path, type, description";

					$video_values = "'$postid', '$videopathurl', 'Video', 'This is a video'";

					$this->model->saveexcel("uploads", $video_columns, $video_values, "");
				}
			}
		}
		
		$this->model->Alert("alert-success", "News was posted successfully!");
			
		return $data;
	}
	
	/*
		update department
	*/
	public function updatenews($id, $redirect, $pk, $table)
	{
		$i = 0;
		$title = mysqli_real_escape_string($this->model->mysqli, $_POST["title"][$i]);
		$desc = mysqli_real_escape_string($this->model->mysqli, $_POST["desc"][$i]);
		$postid = mysqli_real_escape_string($this->model->mysqli, $_POST['postid']);
		$newstype = mysqli_real_escape_string($this->model->mysqli, $_POST["newstype"][$i]);
		$tobeaired = mysqli_real_escape_string($this->model->mysqli, $_POST["time"][$i]);

		$imgpath = '';
			if(!empty($_FILES["pic"][$i]['name']) ){
				$pic = $_FILES["pic"][$i];
				$pic_name = $pic["name"];
				$pic_name = mysqli_real_escape_string($this->model->mysqli, $pic_name);
				$pic_name = str_replace(' ','-', $pic_name);
				$pic_name = time().'_'.$pic_name;
				$pic_tmp = $pic['tmp_name'];
				$imgpath = "uploads/".$pic_name;
				move_uploaded_file($pic_tmp, $imgpath);
				$imgpathurl = $url.$imgpath;
				$columns_img = "file_path = '$imgpathurl'";
				$this->model->updateimg("uploads", $columns_img, "post", $postid);
			}

			$audiopath = '';
			if(!empty($_FILES["audio"][$i]['name']) ){
				$pic = $_FILES["audio"][$i];
				$pic_name = $pic['name'];
				$pic_name = mysqli_real_escape_string($this->model->mysqli, $pic_name);
				$pic_name = str_replace(' ','-', $pic_name);
				$pic_name = time().'_'.$pic_name;
				$pic_tmp = $pic['tmp_name'];
				$audiopath = "uploads/".$pic_name;
				move_uploaded_file($pic_tmp, $audiopath);
				$audiopathurl = $url.$audiopath;
				$columns_audio = "file_path = '$audiopathurl'";
				$this->model->updateimg("uploads", $columns_audio, "post", $postid);
			}

			$videopath = '';
			if(!empty($_FILES["video"][$i]['name']) ){
				$pic = $_FILES["video"][$i];
				$pic_name = $pic['name'];
				$pic_name = mysqli_real_escape_string($this->model->mysqli, $pic_name);
				$pic_name = str_replace(' ','-', $pic_name);
				$pic_name = time().'_'.$pic_name;
				$pic_tmp = $pic['tmp_name'];
				$videopath = "uploads/".$pic_name;
				move_uploaded_file($pic_tmp, $videopath);
				$videopathurl = $url.$videopath;
				$columns_video = "file_path = '$videopathurl'";
				$this->model->updateimg("uploads", $columns_video, "post", $postid);
			}
		
		$columns = "title = '$title', description = '$desc', newsTypeId = '$newstype', tobeaired = '$tobeaired'";
		
		$data = $this->model->update($table, $columns, $pk, $id, $redirect);
		
		return $data;
	}
	
}
?>