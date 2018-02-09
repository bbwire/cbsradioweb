<?php 
require_once 'inc/essentials.php';

$class = 'Controller';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
    
        $table = "sponsors";
        $pk = "id";
        $url = "sponsors";

        if(isset($_GET['entry'])){
            $action_btn_name = "postnew";
            $action_btn_txt = "Save";

            $sponsorname = '';
            $desc = '';
            $phone = '';
            $email = '';
            $website = '';

            if(isset($_GET['update'])){
                $updateid = $_GET['update'];

                $get_data = $controller->getindividual($table, $pk, $updateid);

                foreach($get_data as $data)
                {
                    $sponsorname = $data->sponsor_name;
                    $desc = $data->description;
                    $phone = $data->phone;
                    $email = $data->email;
                    $website = $data->website;
                }

                $action_btn_name = "update";
                $action_btn_txt = "Save changes";
            }
        }
        ?>
                

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Sponsors
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Sponsors</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                	<?php
                    if(isset($_GET['entry']))
                    {
                        $path_post = "http://ulvcloud.com/cbsradioweb/";
                        
                        if(isset($_POST['postnew'])){
                            $name = $_POST['name'];
                            $desc = $_POST['desc'];
                            $phone = $_POST['phone'];
                            $email = $_POST['email'];
                            $website = $_POST['website'];
                            
                            $pathban = null;
                            $pathlogo = null;
                            
                            if(!empty($_FILES['ban']['name']) ){
                                $pic = $_FILES['ban'];
                                $pic_name = $pic['name'];
                                $pic_name = mysqli_real_escape_string($controller->model->mysqli, $pic_name);
                                $pic_tmp = $pic['tmp_name'];
                                $pathban = "uploads/".$pic_name;
                                
                                move_uploaded_file($pic_tmp,$pathban);
                            }else{
                                $pathban = '';
                            }
                            
                            if(!empty($_FILES['logo']['name']) ){
                                $pic = $_FILES['logo'];
                                $pic_name = $pic['name'];
                                $pic_name = mysqli_real_escape_string($controller->model->mysqli, $pic_name);
                                $pic_tmp = $pic['tmp_name'];
                                $pathlogo = "uploads/".$pic_name;
                                
                                move_uploaded_file($pic_tmp,$pathlogo);
                            }else{
                                $pathlogo = '';
                            }

                            $banpath = $path_post.$pathban;
                            $logopath = $path_post.$pathlogo;
                            
                            $columns = "sponsor_name, phone, email, description, website, banner_url, logo_url";
                            $values = "'$name', '$phone', '$email', '$desc', '$website', '$banpath', '$logopath'";
                            
                            $controller->insert($table, $columns, $values, $url);
                                
                            
                        }
                        
                        if(isset($_POST['update'])){
                            $name = $_POST['name'];
                            $desc = $_POST['desc'];
                            $phone = $_POST['phone'];
                            $email = $_POST['email'];
                            $website = $_POST['website'];
                            $updateid = $_POST['id'];
                            
                            if(!empty($_FILES['ban']['name']) ){
                                $pic = $_FILES['ban'];
                                $pic_name = $pic['name'];
                                $pic_name = mysqli_real_escape_string($controller->model->mysqli, $pic_name);
                                $pic_tmp = $pic['tmp_name'];
                                $pathdb = "profile images/".$pic_name;
                                move_uploaded_file($pic_tmp,$pathdb);
                                
                                $column_val = "banner_url = '$pathdb'";
                                $updtlg = $controller->model->UpdateImg($table, $column_value, $pk, $updateid);
                            }
                            
                            if(!empty($_FILES['logo']['name']) ){
                                $pic = $_FILES['logo'];
                                $pic_name = $pic['name'];
                                $pic_name = mysqli_real_escape_string($controller->model->mysqli, $pic_name);
                                $pic_tmp = $pic['tmp_name'];
                                $pathdb = "profile images/".$pic_name;
                                move_uploaded_file($pic_tmp,$pathdb);
                                
                                $column_val = "logo_url = '$pathdb'";
                                $updtlg = $controller->model->UpdateImg($table, $column_value, $pk, $updateid);
                            }
                            
                            
                            $columns = "sponsor_name = '$name', description = '$desc', phone = '$phone', email = '$email', website = '$website'";
                            
                            
                            $controller->update($table, $columns, $pk, $updateid, $url);
                            
                            
                        }

                        ?>
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Sponsor Name</span>
                                        <input type="text" name="name" class="form-control" required value="<?php echo $sponsorname;?>" placeholder="Sponsor name">
                                        
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                        <textarea name="desc" class="form-control" placeholder="Description"><?php echo $desc;?></textarea>
                                    
                                </div>
                                
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Phone</span>
                                        <input type="text" name="phone" required class="form-control" value="<?php echo $phone;?>" placeholder="Phone number ">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Email</span>
                                        <input type="text" name="email" required class="form-control" value="<?php echo $email;?>" placeholder="Email ">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Website</span>
                                        <input type="text" name="website" required class="form-control" value="<?php echo $website;?>" placeholder="Website e.g. http://www.google.com">
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <div class="btn btn-success btn-file">
                                        <i class="fa fa-paperclip"></i> Choose banner
                                        <input type="file" name="ban">
                                    </div>
                                    
                                </div>
                                    
                                <div class="form-group">
                                    <div class="btn btn-success btn-file">
                                        <i class="fa fa-paperclip"></i> Choose logo
                                        <input type="file" name="logo">
                                    </div>
                                    
                                </div>

    
                            </div>
                            <div class="modal-footer clearfix">
    
                                <a href="<?php echo $url;?>" class="btn btn-danger" ><i class="fa fa-times"></i> Cancel</a>
    
                                <button type="submit" name="<?php echo $action_btn_name;?>" class="btn btn-primary pull-left"><i class="fa fa-edit"></i> <?php echo $action_btn_txt;?></button>
                            </div>
                        </form>
                        <?php

                    }
                    else{
						
						if(isset($_GET['delete'])){							
							
							$del = $_GET['delete'];
							
							$controller->delete($table, $pk, $del, $url);
							
						}
					?>
                	<div class="row">
                        <div class="col-xs-3"><a class="btn btn-block btn-primary no-print" href="?entry"><i class="fa fa-pencil"></i> Add a new sponsor</a>
                        </div>
                        
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All sponsors</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th>Sponsor</th>
                                                <th>Phone number</th>
                                                <th>Email</th>
                                                <th>Desc</th>
                                                <th>Website</th>
                                                <th class="no-print">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
											$count = 0;
											$user_datas = $controller->getdata($table);
											foreach($user_datas as $data){
												$count++;
												
												
												$id = $data->id;
												$pname = $data->sponsor_name;
												$desc = $data->description;
												$phone = $data->phone;
												$email = $data->email;
												$website = $data->website;
										?>
                                            <tr>
                                            	<td ><?php echo $count;?></td>
                                                <td ><?php echo $pname;?></td>
                                                <td ><?php echo $phone;?></td>
                                                <td ><?php echo $email;?></td>
                                                <td ><?php echo $desc;?></td>
                                                <td ><?php echo $website;?></td>
                                                <td class="no-print"><a data-toggle="modal" data-target="#modal-<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure you want to delete this record?');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>
                                            </tr>
                                            <!--Modal is a dialog in bootstrap-->
                                            <!--This is the edit dialog code(Modal)-->
                                            <div class="modal fade in" id="modal-<?php echo $id;?>" tabindex="-1" role="dialog" aria-hidden="false" style="display:none;" >
                                            <!--Tabindex helps in popup of the dialog from the parent page-->
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title"><i class="fa fa-edit"></i> Update info</h4>
                                                        </div>
                                                        <form action="#" method="post" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">Sponsor Name</span>
                                                                        <input type="text" name="name" class="form-control" required value="<?php echo $pname;?>" placeholder="Enter sponsor name">
                                                                        <input type="hidden" name="id" value="<?php echo $id;?>">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">Description</span>
                                                                        <textarea name="desc" class="form-control" placeholder="Enter description"><?php echo $desc;?></textarea>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">Phone</span>
                                                                        <input type="text" name="phone" required class="form-control" value="<?php echo $phone;?>" placeholder="Enter phone number ">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">Email</span>
                                                                        <input type="text" name="email" required class="form-control" value="<?php echo $email;?>" placeholder="Enter email ">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">Website</span>
                                                                        <input type="text" name="website" required class="form-control" value="<?php echo $website;?>" placeholder="Enter website e.g. http://www.google.com">
                                                                    </div>
                                                                </div>
                                                                 
                                                                <div class="form-group">
                                                                    <div class="btn btn-success btn-file">
                                                                        <i class="fa fa-paperclip"></i> Choose banner
                                                                        <input type="file" name="ban">
                                                                    </div>
                                                                    
                                                                </div>
                                                                 
                                                                <div class="form-group">
                                                                    <div class="btn btn-success btn-file">
                                                                        <i class="fa fa-paperclip"></i> Choose logo
                                                                        <input type="file" name="logo">
                                                                    </div>
                                                                    
                                                                </div>

                                    
                                                            </div>
                                                            <div class="modal-footer clearfix">
                                    
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                                    
                                                                <button type="submit" name="update" class="btn btn-primary pull-left"><i class="fa fa-edit"></i> Update</button>
                                                            </div>
                                                        </form>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div>
                                            <!--Dialog ends here-->
                                            <?php
											}
											?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            	<th>#</th>
                                                <th>Sponsor</th>
                                                <th>Phone number</th>
                                                <th>Email</th>
                                                <th>Desc</th>
                                                <th>Website</th>
                                                <th class="no-print">Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <br><br>
                                    <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
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
        
        <!--This is the add dialog-->
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Add a new sponsor</h4>
                    </div>
                    <form action="#" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Sponsor Name</span>
                                    <input type="text" name="name" class="form-control" required placeholder="Enter sponsor name">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Description</span>
                                    <textarea name="desc" class="form-control" placeholder="Enter description"></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Phone</span>
                                    <input type="text" name="phone" required class="form-control" placeholder="Enter phone number ">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Email</span>
                                    <input type="text" name="email" required class="form-control" placeholder="Enter email ">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Website</span>
                                    <input type="text" name="website" required class="form-control" placeholder="Enter website e.g. http://www.google.com">
                                </div>
                            </div>
                             
                            <div class="form-group">
                                <div class="btn btn-success btn-file">
                                    <i class="fa fa-paperclip"></i> Choose banner
                                    <input type="file" name="ban">
                                </div>
                                
                            </div>
                             
                            <div class="form-group">
                                <div class="btn btn-success btn-file">
                                    <i class="fa fa-paperclip"></i> Choose logo
                                    <input type="file" name="logo">
                                </div>
                                
                            </div>
                        </div>
                        <div class="modal-footer clearfix">

                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

                            <button type="submit" name="post" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Add sponsor</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>   
        <!--Dialog stops here-->            
        <?php require_once('inc/footer.php');?>