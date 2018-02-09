<?php 
require_once 'inc/essentials.php';

$class = 'Controller';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
?>
                

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Radio Listeners
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Radio Listeners</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                	<?php
					if(isset($_GET['user'])){
					}else{
					
						if(isset($_POST['post'])){
							$name = $_POST['name'];
							$dob = $_POST['dob'];
							$phone = $_POST['phone'];
							$email = $_POST['email'];
							
							$path = null;
							
							if(!empty($_FILES['pic']['name']) ){
								$pic = $_FILES['pic'];
								$pic_name = $pic['name'];
								$pic_name = mysqli_real_escape_string($controller->model->mysqli, $pic_name);
								$pic_tmp = $pic['tmp_name'];
								$path = "profile images/".$pic_name;
								
								move_uploaded_file($pic_tmp,$path);
							}else{
								$path = '';
							}
							
							$table = 'presenters';
							$columns = "presenter_name, phone, email, dob, photo";
							$values = "'$name', '$phone', '$email', '$dob', '$path'";
							$url = basename($_SERVER['PHP_SELF']);
							
							$controller->insert($table, $columns, $values, $url);
								
							
						}
						
						if(isset($_POST['update'])){
							$name = $_POST['name'];
							$dob = $_POST['dob'];
							$phone = $_POST['phone'];
							$email = $_POST['email'];
							$updateid = $_POST['id'];
							
							$table = 'presenters';
							$pk = "presenter_id";
							
							if(!empty($_FILES['pic']['name']) ){
								$pic = $_FILES['pic'];
								$pic_name = $pic['name'];
								$pic_name = mysqli_real_escape_string($controller->model->mysqli, $pic_name);
								$pic_tmp = $pic['tmp_name'];
								$pathdb = "profile images/".$pic_name;
								move_uploaded_file($pic_tmp,$pathdb);
								
								$column_val = "photo = '$pathdb'";
								$updtlg = $controller->model->UpdateImg($table, $column_value, $pk, $updateid);
							}
							
							
							$columns = "presenter_name = '$name', dob = '$dob', phone = '$phone', email = '$email'";
							
							$url = basename($_SERVER['PHP_SELF']);
							
							$controller->update($table, $columns, $pk, $updateid, $url);
							
							
						}
						
						if(isset($_GET['delete'])){
							
							$table = 'presenters';
							$pk = 'presenter_id';
							$del = base64_decode($_GET['delete']);
							$url = basename($_SERVER['PHP_SELF']);
							
							$controller->delete($table, $pk, $del, $url);
							
						}
					?>
                	<div class="row">
                        
                        
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All listeners</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th>User pic</th>
                                                <th>Name</th>
                                                <th>Location</th>
                                                <th>Device</th>
                                                <th>Status</th>
                                                <!--<th class="no-print">Action</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
											/*$count = 0;
											$user_datas = $controller->getdata("presenters");
											foreach($user_datas as $data){
												$count++;
												
												
												$id = $data->presenter_id;
												$pname = $data->presenter_name;
												$dob = $data->dob;
												$phone = $data->phone;
												$email = $data->email;*/
												
										?>
                                            <tr>
                                            	<td style="width:7%;">1</td>
                                                <td style="width:7%;"><img src="img/avatar5.png" class="img-circle"></td>
                                                <td>Samuel Mutyaba</td>
                                                <td >Kampala, Uganda</td>
                                                <td ><i class="fa fa-laptop fa-3x"></i></td>
                                                <td ><i class="fa fa-circle text-success"></i> Online</td>
                                                <!--<td class="no-print"><a data-toggle="modal" data-target="#modal-<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure to delete <?php echo $pname;?>');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>-->
                                            </tr>
                                            
                                            <tr>
                                            	<td style="width:7%;">2</td>
                                                <td style="width:7%;"><img src="img/avatar2.png" class="img-circle"></td>
                                                <td>David Olunga</td>
                                                <td >Kisumu, Kenya</td>
                                                <td ><i class="fa fa-mobile-phone fa-3x"></i></td>
                                                <td ><i class="fa fa-circle text-success"></i> Online</td>
                                                <!--<td class="no-print"><a data-toggle="modal" data-target="#modal-<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure to delete <?php echo $pname;?>');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>-->
                                            </tr>
                                            
                                            <tr>
                                            	<td style="width:7%;">3</td>
                                                <td style="width:7%;"><img src="img/avatar04.png" class="img-circle"></td>
                                                <td>Daniel Okello</td>
                                                <td >Kamyokya, Uganda</td>
                                                <td ><i class="fa fa-mobile-phone fa-3x"></i></td>
                                                <td ><i class="fa fa-circle text-default"></i> Offline</td>
                                                <!--<td class="no-print"><a data-toggle="modal" data-target="#modal-<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure to delete <?php echo $pname;?>');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>-->
                                            </tr>
                                            
                                            <tr>
                                            	<td style="width:7%;">4</td>
                                                <td style="width:7%;"><img src="img/avatar3.png" class="img-circle"></td>
                                                <td>Apollo Uwineza</td>
                                                <td >Kigali, Rwanda</td>
                                                <td ><i class="fa fa-mobile-phone fa-3x"></i></td>
                                                <td ><i class="fa fa-circle text-success"></i> Online</td>
                                                <!--<td class="no-print"><a data-toggle="modal" data-target="#modal-<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure to delete <?php echo $pname;?>');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>-->
                                            </tr>
                                            
                                            <?php
											//}
											?>
                                        </tbody>
                                        
                                    </table>
                                    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    <?php
					}
					?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
               
        <?php require_once('inc/footer.php');?>