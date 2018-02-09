<?php 
require_once 'inc/essentials.php';

$class = 'Controller';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
        
        $table = "shops";
        $cattable = "shop_categories";
        $pk = "id";
        $url = "shop";
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
                        Shop
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Shop</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Custom Tabs -->
                    <?php
                    if(isset($_GET['entry']))
                    {
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
                    }
                    else{
					
						
						if(isset($_POST['postcat'])){
                            $name = mysqli_real_escape_string($controller->model->mysqli, $_POST['name']);
                                                        
                            $columns = "name";
                            $values = "'$name'";

                            $controller->insert($cattable, $columns, $values, $url);
                        }

                        if(isset($_POST['updatecat'])){
                            $name = mysqli_real_escape_string($controller->model->mysqli, $_POST['name']);
                            $updateid = mysqli_real_escape_string($controller->model->mysqli, $_POST['updateid']);
                                                        
                            $columns = "name = '$name'";

                            $controller->update($cattable, $columns, $pk, $updateid, $url);
                        }
						
						if(isset($_GET['delete'])){
							
							$del = $_GET['delete'];
							
							$controller->delete($table, $pk, $del, $url);
							
						}
					?>
                    <div class="studio">
                        <ul class="nav nav-tabs tab-header material-tab">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Shops <small class="badge pull-right bg-green">4</small></a></li>
                            <li><a href="#shopcategory" data-toggle="tab">Shop Categories </a></li>
                            <!--<li><a href="#tab_2" data-toggle="tab">Rejected <small class="badge pull-right bg-green">4</small></a></li>-->
                            
                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <br>
                                <table id="example1" class="table table-bordered table-striped items-table">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th>Name</th>
                                                <th>Owner</th>
                                                <th>Phone</th>
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th class="no-print">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 0;
                                            $shop_datas = $controller->getdata($table, $pk, "asc");
                                            foreach($shop_datas as $data){
                                                $count++;
                                                
                                                
                                                $id = $data->id;
                                                $name = $data->name;
                                                $phone = $data->phone;
                                                $category = $data->category_id;
                                                $userid = $data->user_id;
                                                $status = $data->status;

                                                $shopcat = '';
                                                $get_categories = $controller->getindividual("shop_categories", "id", $category);
                                                foreach($get_categories as $cat){
                                                    $shopcat = $cat->name;
                                                }

                                                $usernam = '';
                                                $get_users = $controller->getindividual("users", "id", $userid);
                                                foreach($get_users as $user){
                                                    $usernam = $user->fname.' '.$user->lname;
                                                }
                                                
                                        ?>
                                            <tr>
                                                <td ><?php echo $count;?></td>
                                                <td ><?php echo $name;?></td>
                                                <td ><?php echo $usernam;?></td>
                                                <td ><?php echo $phone;?></td>
                                                <td ><?php echo $shopcat;?></td>
                                                <td ><?php echo $status;?></td>
                                                <td class="no-print"><a href="?entry&update=<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure you want to trash this record?');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Trash</a></td>
                                            </tr>
                                            
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                        
                                    </table>
                                
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="shopcategory">
                                <br>
                                <div class="row">
                                    <div class="col-xs-12"><a class="btn btn-primary pull-right btn-flat no-print" data-toggle="modal" data-target="#new_category"><i class="fa fa-plus"></i> Add a new category</a></div>
                                </div>
                                <hr>
                                <table id="example2" class="table table-bordered table-striped items-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th class="no-print">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
                                        $cat_datas = $controller->getdata($cattable, $pk, "asc");
                                        foreach($cat_datas as $data){
                                            $count++;
                                            
                                            
                                            $id = $data->id;
                                            $name = $data->name;
                                            $status = $data->status;
                                            
                                        ?>
                                        <tr>
                                            <td ><?php echo $count;?></td>
                                            <td ><?php echo $name;?></td>
                                            <td ><?php echo $status;?></td>
                                            <td class="no-print"><a data-toggle="modal" data-target="#update_category<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure you want to delete this record?');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>
                                        </tr>
                                        
                                        <div class="modal fade" id="update_category<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <b><i class="fa fa-plus"> </i> Update Category</b>
                                                        <a class="pull-right" style="cursor:pointer;" data-dismiss="modal"><i class="fa fa-times"> </i></a>
                                                    </div>
                                                    <form action="#" method="post" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">Name</span>
                                                                    <input type="text" name="name" class="form-control" value="<?php echo $name;?>" required placeholder="Category">
                                                                    
                                                                </div>
                                                            </div>

                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="postcat" class="btn btn-success btn-ok btn-flat"><i class="fa fa-check"> </i> Save</button>
                                                            <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-times"> </i> Cancel</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    
                                </table>

                                <div class="modal fade" id="new_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <b><i class="fa fa-plus"> </i> New Category</b>
                                                <a class="pull-right" style="cursor:pointer;" data-dismiss="modal"><i class="fa fa-times"> </i></a>
                                            </div>
                                            <form action="#" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Name</span>
                                                            <input type="text" name="name" class="form-control" required placeholder="Category">
                                                            
                                                        </div>
                                                    </div>

                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="postcat" class="btn btn-success btn-ok btn-flat"><i class="fa fa-check"> </i> Save</button>
                                                    <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-times"> </i> Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
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