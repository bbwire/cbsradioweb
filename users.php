<?php 
require_once 'inc/essentials.php';

$class = 'UsersController';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
        
$page_title = 'Users';
$table = 'users';
$primary_key = 'id';
$url = 'users';
	
if(isset($_GET['entry']))
{
	$page_title = 'Add new user';
	$action_btn_name = 'postnew';
	$action_btn_txt = 'Save';
	$fname = '';
	$lname = '';
	$gender = '';
	$phone = '';
	$email = '';
	$dob = '';
	$joindate = '';
	$username = '';
	$position = '';
	$station = '';
	$usertype = '';
	
	if(isset($_GET['update']))
	{
		$updateid = $_GET['update'];
		
		$updatedatas = $controller->getindividual($table, $primary_key, $updateid);
		
		foreach($updatedatas as $data)
		{
			$fname = $data->fname;
			$lname = $data->lname;
			$phone = $data->phone;
			$gender = $data->gender;
			$email = $data->email;
			$dob = $data->dob;
			$joindate = $data->joindate;
			$username = $data->username;
			$position = $data->position;
            $station = $data->station;
            $usertype = $data->usertype;
		}
		
		$page_title = 'Update user';
		$action_btn_name = 'update';
		$action_btn_txt = 'Save changes';
		
	}
}
        ?>
                

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Users
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Users</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                	
                    <div class="row">
                        <div class="col-xs-12">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All users</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <?php
                                if(isset($_GET['entry']))
                                {
                                    
                                    if(isset($_POST['postnew']))
                                    {
                                        $controller->postuser($url, $table);
                                    }
                                    
                                    if(isset($_POST['update']))
                                    {
                                        $controller->updateuser($updateid, $url, $primary_key, $table);
                                    }
                                
                                    ?>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="fname">First name</label>
                                            <input type="text" class="form-control" id="fname" value="<?php echo $fname;?>" placeholder="First name" name="fname">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="lname">Last name</label>
                                            <input type="text" class="form-control" id="lname" value="<?php echo $lname;?>" placeholder="Last name" name="lname">
                                        </div>
                                        <div class="item form-group">
                                          <?php
                                            $genders = array("Male", "Female");
                                            ?>
                                            <label class="control-label" for="gender">Sex <span class="required">*</span>
                                            </label>
                                          <select name="gender" class="select2 form-control" required id="gender" style="width: 100%;">
                                            <option value="">Select Option</option>
                                            <?php
                                            foreach($genders as $sex)
                                            {
                                                ?>
                                                <option <?php if($gender == $sex) echo "selected";?>><?php echo $sex;?></option>
                                                <?php
                                            }
                                            ?>
                                          </select>
                                        
                                      </div>
                                        
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" id="phone" value="<?php echo $phone;?>" placeholder="Phone" name="phone">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" value="<?php echo $email;?>" placeholder="Email" name="email">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="dob">Date of birth</label>
                                            <input type="text" class="form-control" id="dob" value="<?php echo $dob;?>" placeholder="Date of birth" name="dob">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="jdate">Join date</label>
                                            <input type="text" class="form-control" id="jdate" value="<?php echo $joindate;?>" placeholder="Join date" name="jdate">
                                        </div>
                                        <div class="item form-group">
                                          <?php
                                            $types = $controller->getdata("usertype", "id", "asc");
                                            ?>
                                            <label class="control-label" for="role">Position <span class="required">*</span>
                                            </label>
                                          <select name="role" class="select2 form-control" required id="role" style="width: 100%;">
                                            <option value="">Select Option</option>
                                            <?php
                                            foreach($types as $type)
                                            {
                                                ?>
                                                <option value="<?php echo $type->id;?>" <?php if($type->id == $position) echo "selected";?>><?php echo $type->typeName;?></option>
                                                <?php
                                            }
                                            ?>
                                          </select>
                                        
                                      </div>
                                        <div class="item form-group">
                                          <?php
                                            $stations = $controller->getdata("stations", "id", "asc");
                                            ?>
                                            <label class="control-label" for="station">Station <span class="required">*</span>
                                            </label>
                                          <select name="station" class="select2 form-control" required id="station" style="width: 100%;">
                                            <option value="">Select Station</option>
                                            <?php
                                            foreach($stations as $stat)
                                            {
                                                ?>
                                                <option value="<?php echo $stat->id;?>" <?php if($station == $stat->id) echo "selected";?>><?php echo $stat->stationName;?></option>
                                                <?php
                                            }
                                            ?>
                                          </select>
                                        
                                      </div>
                                        
                                        <div class="form-group">
                                            <label for="username">User photo</label>
                                            <input type="file" class="form-control" name="pic">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" placeholder="Username" value="<?php echo $username;?>" name="username">
                                        </div>
                                        <?php
                                        if(!isset($_GET['update'])){
                                        ?>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <hr>
                                        <div class="form-group">
                                            
                                            <button type="submit" class="btn btn-primary btn-flat" id="fname" placeholder="First name" name="<?php echo $action_btn_name;?>"><i class="fa fa-check"></i> <?php echo $action_btn_txt;?></button>
                                            <a href="<?php echo $url;?>" class="btn btn-danger btn-flat pull-right"><i class="fa fa-times"></i> Cancel</a>
                                        </div>
                                    </form>
                                    <?php
                                }
                                else
                                {
                                if(isset($_POST['deletemulti'])){
                                    
                                    if(isset($_POST['ids']))
                                    {
                                        $count = count($_POST['ids']);
                                        
                                        for($i=0; $i<$count; $i++)
                                        {
                                            $value = $_POST['ids'][$i];
                                            $controller->deletemultiple($table, $primary_key, $value, $url);
                                        }
                                        
                                        $controller->model->Alert("alert-success", "$count Records have been deleted");
                                        
                                    }else
                                    {
                                        $controller->model->Alert("alert-danger", "Please select record(s) to delete");
                                    }
                                }
                                
                                if(isset($_GET['delete'])){
                                        
                                    $key_value = $_GET['delete'];
                                    
                                    $controller->delete($table, $primary_key, $key_value, $url);
                                }
                                ?>
                                <hr>
                                <div class="col-xs-12 pull-right">
                                    <a href="?entry" class="btn btn-primary btn-flat pull-right"><i class="fa fa-plus"></i> Add user</a>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                <form action="" method="post" name="form1" onSubmit="return delete_confirm();">
                              <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>Phone</th>
                                  <th>Email</th>
                                  <th>DOB</th>
                                  <th>Position</th>
                                  <th>Station</th>
                                  <th>User type</th>
                                  <th>Status</th>
                                  <th>Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $datas = $controller->getdata($table, $primary_key, "asc");
                                
                                $count = 0;
                                foreach($datas as $data)
                                {
                                    $id = $data->id;
                                    $position = $data->position;
                                    $statn = $data->station;
                                    $count++;
                                    
                                    $typee = '';
                                    $get_utype = $controller->getindividual("usertype", "id", $position);
                                    
                                    foreach($get_utype as $utype)
                                    {
                                        $typee = $utype->typeName;
                                    }
                                    
                                    $stnnam = '';
                                    $get_stnn = $controller->getindividual("stations", "id", $position);
                                    
                                    foreach($get_stnn as $stnnn)
                                    {
                                        $stnnam = $stnnn->stationName;
                                    }
                                ?>
                                <tr>
                                    <td><input type="checkbox" class="table_records flat-red" name="ids[]" value="<?php echo $id;?>" title="<?php echo $data->fname.' '.$data->lname;?>"></td>
                                  <td><?php echo $count;?></td>
                                  <td><?php echo $data->fname.' '.$data->lname;?></td>
                                  <td><?php echo $data->phone;?></td>
                                  <td> <?php echo $data->email;?></td>
                                  <td> <?php echo $data->dob;?></td>
                                  <td><?php echo $typee;?></td>
                                  <td><?php echo $stnnam;?> FM</td>
                                  <td><?php echo $data->usertype;?> </td>
                                  <td><?php echo $data->status;?></td>
                                  <td><a href="?entry&update=<?php echo $id;?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a> <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#confirm-delete<?php echo $id;?>"><i class="fa fa-trash"></i></button></td>
                                </tr>
                                
                                <div class="modal fade" id="confirm-delete<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <b><i class="fa fa-info-circle"> </i> Confirm Delete</b>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this record?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"> </i> Cancel</button>
                                                    <a href="?delete=<?php echo $id;?>" class="btn btn-success btn-ok"><i class="fa fa-check"> </i> OK</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>Phone</th>
                                  <th>Email</th>
                                  <th>DOB</th>
                                  <th>Position</th>
                                  <th>Station</th>
                                  <th>User type</th>
                                  <th>Status</th>
                                  <th>Manage</th>
                                </tr>
                                </tfoot>
                              </table>
                              <div class="clearfix"></div>
                              <hr />
                              <button type="submit" class="btn btn-danger btn-flat" name="deletemulti" id="delete_multiple"><i class="fa fa-trash"></i> Delete multiple Records</button>
                                    
                               </form>
                              <div class="clearfix"></div>
                              <?php
                                }
                              ?>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
                  
        <?php require_once('inc/footer.php');?>