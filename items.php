<?php 
require_once 'inc/essentials.php';

$class = 'Controller';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
        
        $table = "items";
        $cattable = "item_categories";
        $subcattable = "item_sub_category";
        $pk = "id";
        $url = "items";
        $path_url = '';//"http://ulvcloud.com/cbsradioweb/";

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
                        Items
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Items</li>
                   
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
								//$column_val = "profileimg = '$urlpath'";
								//$updtlg = $controller->model->UpdateImg($table, $column_val, $pk, $updateid);
								
							}
							
							
							$columns = "name = '$name', description = '$desc', station = '$station'";
							
							$controller->update($table, $columns, $pk, $updateid, $url);
							
							
						}
                    }
                    else{
					
						if(isset($_POST['postcat'])){
                            $name = mysqli_real_escape_string($controller->model->mysqli, $_POST['name']);
                            if(!empty($_FILES['pic']['name']) ){
								$pic = $_FILES['pic'];
								$pic_name = $pic['name'];
                                $pic_name = mysqli_real_escape_string($controller->model->mysqli, $pic_name);
                                $pic_name = str_replace(" ", "-", $pic_name);
								$pic_tmp = $pic['tmp_name'];
								$pathdb = "uploads/".$pic_name;
                                move_uploaded_file($pic_tmp,$pathdb);
                                $urlpath = $path_url.$pathdb;
								//$column_val = "profileimg = '$urlpath'";
								//$updtlg = $controller->model->UpdateImg($table, $column_val, $pk, $updateid);
								
                            }
                            
                            $columns = "name, photo_path";
                            $values = "'$name', '$urlpath'";

                            $controller->insert($cattable, $columns, $values, $url);
                        }

                        if(isset($_POST['updatecat'])){
                            $name = mysqli_real_escape_string($controller->model->mysqli, $_POST['name']);
                            $updateid = mysqli_real_escape_string($controller->model->mysqli, $_POST['updateid']);
                            if(!empty($_FILES['pic']['name']) ){
								$pic = $_FILES['pic'];
								$pic_name = $pic['name'];
                                $pic_name = mysqli_real_escape_string($controller->model->mysqli, $pic_name);
                                $pic_name = str_replace(" ", "-", $pic_name);
								$pic_tmp = $pic['tmp_name'];
								$pathdb = "uploads/".$pic_name;
                                move_uploaded_file($pic_tmp,$pathdb);
                                $urlpath = $path_url.$pathdb;
								$column_val = "photo_path = '$urlpath'";
								$updtlg = $controller->model->UpdateImg($cattable, $column_val, $pk, $updateid);
								
                            }
                            
                            $columns = "name = '$name'";

                            $controller->update($cattable, $columns, $pk, $updateid, $url);
                        }

                        if(isset($_POST['postsubcat'])){
                            $name = mysqli_real_escape_string($controller->model->mysqli, $_POST['name']);
                            $category = mysqli_real_escape_string($controller->model->mysqli, $_POST['category']);
                                                        
                            $columns = "name, category_id";
                            $values = "'$name', '$category'";

                            $controller->insert($subcattable, $columns, $values, $url);
                        }

                        if(isset($_POST['updatesubcat'])){
                            $name = mysqli_real_escape_string($controller->model->mysqli, $_POST['name']);
                            $category = mysqli_real_escape_string($controller->model->mysqli, $_POST['category']);
                            $updateid = mysqli_real_escape_string($controller->model->mysqli, $_POST['updateid']);
                                                        
                            $columns = "name = '$name', category_id = '$category'";

                            $controller->update($subcattable, $columns, $pk, $updateid, $url);
                        }
						
						if(isset($_GET['delete'])){
							
							$del = $_GET['delete'];
							
							$controller->delete($table, $pk, $del, $url);
							
                        }
                        
                        $item_datas = $controller->getdata($table, $pk, "asc");
					?>
					<!--<form >
						<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
							  <select class="selectpicker form-control" data-show-subtext="true" data-live-search="true" name="type">
								<option value="" selected data-hidden="true">Print documents for selected items</option>
								<option >Tom Foolery</option>
								<option>Bill Gordon</option>
								<option>Elizabeth Warren</option>
								<option>Mario Flores</option>
								<option>Don Young</option>
								<option>Marvin Martinez</option>
							  </select>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="form-group">
							  <button type="submit" name="reports" class="btn btn-primary">Go</button>
							</div>
						</div>
						</div>
					</form>
					<div class="clearfix"></div>
					<hr>-->
                    <div class="studio">
                        <ul class="nav nav-tabs tab-header material-tab" style="text-transform:uppercase;">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Customer Items <small class="badge pull-right bg-green"><?php echo count($item_datas);?></small></a></li>
                            <li><a href="#categories" data-toggle="tab">Item Categories</a></li>
                            <li><a href="#subcategories" data-toggle="tab">Item sub categories <!--<small class="badge pull-right bg-green">4</small>--></a></li>
                            
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
                                                <th>Price</th>
                                                <!--<th>Quantity</th>-->
                                                <th>Shop</th>
                                                <th>Category</th>
                                                <th>Sub-category</th>
                                                <th>Status</th>
                                                <th class="no-print">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 0;
                                            
                                            foreach($item_datas as $data){
                                                $count++;
                                                
                                                
                                                $id = $data->id;
                                                $name = $data->name;
                                                $price = $data->price;
                                                $quantity = $data->quantity;
                                                $category = $data->category_id;
                                                $subcategory = $data->sub_category_id;
                                                $shopid = $data->shop_id;
                                                $status = $data->status;

                                                $itemcat = '';
                                                $get_categories = $controller->getindividual($cattable, "id", $category);
                                                foreach($get_categories as $cat){
                                                    $itemcat = $cat->name;
                                                }

                                                $itemsubcat = '';
                                                $get_sub_categories = $controller->getindividual($subcattable, "id", $subcategory);
                                                foreach($get_sub_categories as $subcat){
                                                    $itemsubcat = $subcat->name;
                                                }

                                                $shopnam = '';
                                                $get_shop = $controller->getindividual("shops", "id", $shopid);
                                                foreach($get_shop as $shop){
                                                    $shopnam = $shop->name;
                                                }
                                                
                                            ?>
                                            <tr>
                                                <td ><?php echo $count;?></td>
                                                <td ><span data-toggle="tooltip" data-html="true" data-placement="right" title="<img src='http://placehold.it/250/250'>"><?php echo $name;?></span></td>
                                                <td ><?php echo $price;?></td>
                                                <!--<td ><?php echo $quantity;?></td>-->
                                                <td ><?php echo $shopnam;?></td>
                                                <td ><?php echo $itemcat;?></td>
                                                <td ><?php echo $itemsubcat;?></td>
                                                <td ><?php echo $status;?></td>
                                                <td class="no-print"><a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure you want to trash this record?');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Trash</a></td>
                                            </tr>
                                            
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                        
                                    </table>
                                
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="categories">
                                <br>
                                <div class="row">
                                    <div class="col-xs-12"><a class="btn btn-primary pull-right btn-flat no-print" data-toggle="modal" data-target="#new_category"><i class="fa fa-plus"></i> Add a new category</a></div>
                                </div>
                                <hr>
                                <table id="example2" class="table table-bordered table-striped items-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="width:7%;">Category picture</th>
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
                                            $photo = $data->photo_path;

                                            $img = '';
                                            if($photo != '')
                                                $img = '<img src="'.$photo.'" class="img-responsive">';
                                            
                                        ?>
                                        <tr>
                                            <td ><?php echo $count;?></td>
                                            <td ><span data-toggle="tooltip" data-html="true" data-placement="right" title="http://placehold.it/250/250"><?php echo $img;?></span></td>
                                            <td ><?php echo $name;?></td>
                                            <td ><?php echo $status;?></td>
                                            <td class="no-print"><a  data-toggle="modal" data-target="#update_category<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure you want to delete this record?');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>
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
                                                                    <input type="text" name="name" value="<?php echo $name;?>" class="form-control" required placeholder="Category">
                                                                    <input type="hidden" name="updateid" value="<?php echo $id;?>">
                                                                    
                                                                </div>
                                                            </div>
                                                                
                                                            <div class="form-group">
                                                                <div class="btn btn-success btn-file btn-flat">
                                                                    <i class="fa fa-paperclip"></i> Choose category pic
                                                                    <input type="file" name="pic">
                                                                </div>
                                                                <p class="help-block">Smaller images are better</p>
                                                            </div>

                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="updatecat" class="btn btn-success btn-ok btn-flat"><i class="fa fa-check"> </i> Save Changes</button>
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
                                                        
                                                    <div class="form-group">
                                                        <div class="btn btn-success btn-file btn-flat">
                                                            <i class="fa fa-paperclip"></i> Choose category pic
                                                            <input type="file" name="pic">
                                                        </div>
                                                        <p class="help-block">Smaller images are better</p>
                                                    </div>

                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-times"> </i> Cancel</button>
                                                    <button type="submit" name="postcat" class="btn btn-success btn-ok btn-flat"><i class="fa fa-check"> </i> OK</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="subcategories">
                                <br>
                                <div class="row">
                                    <div class="col-xs-12"><a class="btn btn-primary pull-right btn-flat no-print"data-toggle="modal" data-target="#new_sub_category"><i class="fa fa-plus"></i> Add a new category</a></div>
                                </div>
                                <hr>
                                <table id="example3" class="table table-bordered table-striped items-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th class="no-print">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 0;
                                    $cat_datas = $controller->getdata($subcattable, $pk, "asc");
                                    foreach($cat_datas as $data){
                                        $count++;
                                        
                                        
                                        $id = $data->id;
                                        $name = $data->name;
                                        $status = $data->status;
                                        $category = $data->category_id;

                                        $itemcat = '';
                                        $get_categories = $controller->getindividual("item_categories", "id", $category);
                                        foreach($get_categories as $cat){
                                            $itemcat = $cat->name;
                                        }
                                        
                                    ?>
                                    <tr>
                                        <td ><?php echo $count;?></td>
                                        <td ><?php echo $name;?></td>
                                        <td ><?php echo $itemcat;?></td>
                                        <td ><?php echo $status;?></td>
                                        <td class="no-print"><a href="?entry&update=<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure you want to delete this record?');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>
                                    </tr>
                                    
                                    <div class="modal fade" id="new_sub_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <b><i class="fa fa-plus"> </i> New Sub-Category</b>
                                                    <a class="pull-right" style="cursor:pointer;" data-dismiss="modal"><i class="fa fa-times"> </i></a>
                                                </div>
                                                <form action="#" method="post" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">Name</span>
                                                                <input type="text" name="name" class="form-control" value="<?php echo $name;?>" required placeholder="Sub Category">
                                                                <input type="hidden" name="updateid" value="<?php echo $id;?>" >
                                                                
                                                            </div>
                                                        </div>
                                                            
                                                        
                                    
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <?php
                                                                $get_cats = $controller->getdata("item_categories", "id", "asc");
                                                                ?>
                                                                <span class="input-group-addon">Item Category</span>
                                                                <select name="category" required class="form-control">
                                                                    <option value="">Select Option</option>
                                                                    <?php
                                                                    foreach($get_cats as $cat){
                                                                        ?>
                                                                        <option value="<?php echo $cat->id;?>" <?php if($cat->id == $category) echo "selected";?>><?php echo $cat->name;?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="postsubcat" class="btn btn-success btn-ok btn-flat"><i class="fa fa-check"> </i> Save</button>
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

                                <div class="modal fade" id="new_sub_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <b><i class="fa fa-plus"> </i> New Sub-Category</b>
                                                <a class="pull-right" style="cursor:pointer;" data-dismiss="modal"><i class="fa fa-times"> </i></a>
                                            </div>
                                            <form action="#" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Name</span>
                                                            <input type="text" name="name" class="form-control" required placeholder="Sub Category">
                                                            
                                                        </div>
                                                    </div>
                                                        
                                                    
                                
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <?php
                                                            $get_cats = $controller->getdata("item_categories", "id", "asc");
                                                            ?>
                                                            <span class="input-group-addon">Item Category</span>
                                                            <select name="category" required class="form-control">
                                                                <option value="">Select Option</option>
                                                                <?php
                                                                foreach($get_cats as $cat){
                                                                    ?>
                                                                    <option value="<?php echo $cat->id;?>" <?php //if($cat->id == $station) echo "selected";?>><?php echo $cat->name;?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="postsubcat" class="btn btn-success btn-ok btn-flat"><i class="fa fa-check"> </i> Save</button>
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