<?php 
require_once 'inc/essentials.php';

$class = 'Controller';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
        
        $table = "bids";
        $placedtable = "placed_bids";
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
                        Bids
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Bids</li>
                   
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
                    }
                    else{
					
						
						
						if(isset($_GET['delete'])){
							
							$del = $_GET['delete'];
							
							$controller->delete($table, $pk, $del, $url);
							
						}
					?>
                    <div class="studio">
                        <ul class="nav nav-tabs tab-header material-tab">
                            <li class="active"><a href="#bids" data-toggle="tab">Create Bids <small class="badge pull-right bg-green">0</small></a></li>
                            <li><a href="#placedbids" data-toggle="tab">Placed Bids <small class="badge pull-right bg-green">0</small></a></li>
                            <!--<li><a href="#tab_2" data-toggle="tab">Rejected Bids <small class="badge pull-right bg-green">0</small></a></li>-->
                            
                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="bids">
                                <br>
                                <div class="row">
                                    <div class="col-xs-12"><a class="btn btn-primary pull-right btn-flat no-print"data-toggle="modal" data-target="#new_sub_category"><i class="fa fa-plus"></i> Create bid</a></div>
                                </div>
                                <hr>
                                <table id="example1" class="table table-bordered table-striped items-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Minimum amount</th>
                                            <th>Bid expiry date</th>
                                            <th>Status</th>
                                            <th class="no-print">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
                                        $bid_datas = $controller->getdata($table, $pk, "asc");
                                        foreach($bid_datas as $data){
                                            $count++;
                                            
                                            
                                            $id = $data->id;
                                            $minamt = $data->min_amount;
                                            $status = $data->status;
                                            $expiry = $data->bid_expiry;
                                            $itemid = $data->item_id;

                                            $itemnam = '';
                                            $get_items = $controller->getindividual("items", "id", $itemid);
                                            foreach($get_items as $item){
                                                $itemnam = $item->name;
                                            }
                                            
                                        ?>
                                        <tr>
                                            <td ><?php echo $count;?></td>
                                            <td ><?php echo $itemnam;?></td>
                                            <td ><?php echo $minamt;?></td>
                                            <td ><?php echo $expiry;?></td>
                                            <td ><?php echo $status;?></td>
                                            <td class="no-print"><a href="?entry&update=<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure you want to delete this record?');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>
                                        </tr>
                                        
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                        
                                </table>

                                <div class="modal fade" id="new_sub_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <b><i class="fa fa-plus"> </i> New Bid</b>
                                                <a class="pull-right" style="cursor:pointer;" data-dismiss="modal"><i class="fa fa-times"> </i></a>
                                            </div>
                                            <form action="#" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <?php
                                                            $get_itemms = $controller->getdata("items", "id", "asc");
                                                            ?>
                                                            <span class="input-group-addon">Item Item</span>
                                                            <select name="station" required class="form-control">
                                                                <option value="">Select Option</option>
                                                                <?php
                                                                foreach($get_itemms as $itemm){
                                                                    ?>
                                                                    <option value="<?php echo $itemm->id;?>" <?php //if($cat->id == $station) echo "selected";?>><?php echo $itemm->name;?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Minimum amount</span>
                                                            <input type="text" name="amt" class="form-control" required placeholder="Minimum amount">
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Expiry date</span>
                                                            <input type="text" name="expiry" id="date" class="form-control" required placeholder="Expiry date">
                                                            
                                                        </div>
                                                    </div>

                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-times"> </i> Cancel</button>
                                                    <button type="submit" name="postnew" class="btn btn-success btn-ok btn-flat"><i class="fa fa-check"> </i> Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="placedbids">
                                <br>
                                <table id="example2" class="table table-bordered table-striped items-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Bidder</th>
                                            <th>Bid id</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th class="no-print">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
                                        $bid_datas = $controller->getdata($placedtable, $pk, "asc");
                                        foreach($bid_datas as $data){
                                            $count++;
                                            
                                            
                                            $id = $data->id;
                                            $amount = $data->amount;
                                            $status = $data->status;
                                            $bidid = $data->bid_id;
                                            $userid = $data->user_id;

                                            $usernam = '';
                                            $get_users = $controller->getindividual("users", "id", $userid);
                                            foreach($get_users as $user){
                                                $usernam = $user->fname.' '.$user->lname;
                                            }
                                            
                                        ?>
                                        <tr>
                                            <td ><?php echo $count;?></td>
                                            <td ><?php echo $usernam;?></td>
                                            <td ><?php echo $bidid;?></td>
                                            <td ><?php echo $amount;?></td>
                                            <td ><?php echo $status;?></td>
                                            <td class="no-print"><a href="?entry&update=<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure you want to delete this record?');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>
                                        </tr>
                                        
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                        
                                </table>
                                
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                            <br><b>No Bids Yet</b>
                            
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