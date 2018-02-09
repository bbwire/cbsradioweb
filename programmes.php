<?php 
require_once 'inc/essentials.php';

$class = 'Controller';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
        
        $table = "programme";
        $linetable = "lineup";
        $pk = "id";
        $url = "programmes";
        $path_url = "http://ulvcloud.com/cbsradioweb/";

        if(isset($_GET['entry'])){
            $action_btn_name = "postnew";
            $action_btn_txt = "Save";

            $name = '';
            $desc = '';
            $station = '';

            if(isset($_GET['update'])){
                $updateid = $_GET['update'];

                $get_user = $controller->getindividual($table, $pk, $updateid);

                foreach($get_user as $data)
                {
                    $name = $data->name;
                    $desc = $data->description;
                    $station = $data->station;
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
                        Programmes
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Programmes</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Custom Tabs -->
                    <?php
                    if(isset($_GET['entry']))
                    {
                        if(isset($_POST['postnew'])){
							$name = $_POST['name'];
							$desc = $_POST['desc'];
							$station = $_POST['station'];
							
                            $path = null;
                            
							
							if(!empty($_FILES['pic']['name']) ){
								$pic = $_FILES['pic'];
								$pic_name = $pic['name'];
                                $pic_name = mysqli_real_escape_string($controller->model->mysqli, $pic_name);
                                $pic_name = str_replace(" ", "", $pic_name);
								$pic_tmp = $pic['tmp_name'];
								$path = "uploads/".$pic_name;
								
								move_uploaded_file($pic_tmp,$path);
							}else{
								$path = '';
                            }
                            
                            $urlpath = $path_url.$path;
							
							$columns = "name, description, profileimg, station";
							$values = "'$name', '$desc', '$urlpath', '$station'";
							
							$controller->insert($table, $columns, $values, $url);
								
							
						}
						
						if(isset($_POST['update'])){
							$name = $_POST['name'];
							$desc = $_POST['desc'];
							$station = $_POST['station'];
							
							
							if(!empty($_FILES['pic']['name']) ){
								$pic = $_FILES['pic'];
								$pic_name = $pic['name'];
                                $pic_name = mysqli_real_escape_string($controller->model->mysqli, $pic_name);
                                $pic_name = str_replace(" ", "", $pic_name);
								$pic_tmp = $pic['tmp_name'];
								$pathdb = "uploads/".$pic_name;
                                move_uploaded_file($pic_tmp,$pathdb);
                                $urlpath = $path_url.$pathdb;
								$column_val = "profileimg = '$urlpath'";
								$updtlg = $controller->model->UpdateImg($table, $column_val, $pk, $updateid);
								
							}
							
							
							$columns = "name = '$name', description = '$desc', station = '$station'";
							
							$controller->update($table, $columns, $pk, $updateid, $url);
							
							
						}

                        ?>
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Name</span>
                                        <input type="text" name="name" class="form-control" required value="<?php echo $name;?>" placeholder="Programme name">
                                        
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                        <textarea name="desc" class="form-control" placeholder="Description"><?php echo $desc;?></textarea>
                                    
                                </div>
                                
                                <div class="form-group">
                                    <div class="input-group">
                                        <?php
                                        $get_stations = $controller->getdata("stations", "id", "asc");
                                        ?>
                                        <span class="input-group-addon">Station</span>
                                        <select name="station" required class="form-control">
                                            <option value="">Select Station</option>
                                            <?php
                                            foreach($get_stations as $stat){
                                                ?>
                                                <option value="<?php echo $stat->id;?>" <?php if($stat->id == $station) echo "selected";?>><?php echo $stat->stationName;?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <div class="btn btn-success btn-file">
                                        <i class="fa fa-paperclip"></i> Choose profile pic
                                        <input type="file" name="pic">
                                    </div>
                                    <p class="help-block">Smaller images are better</p>
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
                    <div class="studio">
                        <ul class="nav nav-tabs tab-header material-tab">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Current Programme</a></li>
                            <li><a href="#lineup" data-toggle="tab">Programme line up</a></li>
                            <li><a href="#tab_2" data-toggle="tab">All Programmes</a></li>
                            
                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <br><b>Current programme will show up here soon</b>
                                
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="lineup">
                                <br><b>Line up will show up here soon</b>
                                
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <br>
                                <div class="row">
                                    <div class="col-xs-12"><a class="btn btn-primary pull-right btn-flat no-print" href="?entry"><i class="fa fa-pencil"></i> Add a new programme</a></div>
                                </div>
                                <hr>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Programme name</th>
                                            <th>Description</th>
                                            <th>Station</th>
                                            <th class="no-print">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $count = 0;
                                        $user_datas = $controller->getdata($table, $pk, "asc");
                                        foreach($user_datas as $data){
                                            $count++;
                                            
                                            
                                            $id = $data->id;
                                            $name = $data->name;
                                            $desc = $data->description;
                                            $statio = $data->station;

                                            $statnam = '';
                                            $get_station = $controller->getindividual("stations", "id", $statio);
                                            foreach($get_station as $stat){
                                                $statnam = $stat->stationName;
                                            }
                                            
                                    ?>
                                        <tr>
                                            <td ><?php echo $count;?></td>
                                            <td ><?php echo $name;?></td>
                                            <td ><?php echo $desc;?></td>
                                            <td ><?php echo $statnam;?></td>
                                            <td class="no-print"><a href="?entry&update=<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure you want to delete this record?');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>
                                        </tr>
                                        
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Programme name</th>
                                            <th>Description</th>
                                            <th>Station</th>
                                            <th class="no-print">Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            
                            </div><!-- /.tab-pane -->
                        </div><!-- /.tab-content -->
                    </div><!-- nav-tabs-custom -->
                	 <?php
					}
					?>
                   
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <?php require_once('inc/footer.php');?>