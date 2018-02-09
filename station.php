<?php 
require_once 'inc/essentials.php';

$class = 'SettingsController';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
    
        $table = "stations";
        $pk = "id";
        $url = "station";
        
		$action_btn_name = "postnew";
		$action_btn_txt = "Save";
		$page_title = "Add new station";

		$name = '';

		if(isset($_GET['update'])){
			$updateid = $_GET['update'];

			$get_data = $controller->getindividual($table, $pk, $updateid);

			foreach($get_data as $data)
			{
				$name = $data->stationName;
			}

			$action_btn_name = "update";
			$action_btn_txt = "Save changes";
			$page_title = "Update station";
		}
        
        ?>
                

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Stations
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Stations</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                	<?php
                    if(isset($_GET['entries']))
                    {
                         

                    }
                    else{
						
						if(isset($_GET['delete'])){							
							
							$del = $_GET['delete'];
							
							$controller->delete($table, $pk, $del, $url);
							
						}
					?>
                	
                    <div class="row">
                    	<div class="col-xs-4">
                            <?php
							if(isset($_POST['post'])){
								$name = $_POST['name'];
								
								$columns = "stationName";
								$values = "'$name'";
								
								$controller->insert($table, $columns, $values, $url);
									
								
							}
							
							if(isset($_POST['update'])){
								$name = $_POST['name'];
								
								$columns = "stationName = '$name'";
								
								
								$controller->update($table, $columns, $pk, $updateid, $url);
								
								
							}
							?>
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo $page_title;?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <form action="#" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                    
                                                    <input type="text" name="name" class="form-control" required value="<?php echo $name;?>" placeholder="Station name">
                                                    
                                            </div>
            
                
                                        </div>
                                        <div class="modal-footer clearfix">
                
                							<?php
											if(isset($_GET['update'])){
											?>
                                            <a href="<?php echo $url;?>" class="btn btn-danger" ><i class="fa fa-times"></i> Cancel</a>
                                            <?php
											}
											?>
                
                                            <button type="submit" name="<?php echo $action_btn_name;?>" class="btn btn-primary pull-left"><i class="fa fa-edit"></i> <?php echo $action_btn_txt;?></button>
                                        </div>
                                    </form>
                                    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                        <div class="col-xs-8">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Stations</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th>Station name</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
											$count = 0;
											$user_datas = $controller->getdata($table);
											foreach($user_datas as $data){
												$count++;
												
												
												$id = $data->id;
												$name = $data->stationName;

												
										?>
                                            <tr>
                                            	<td ><?php echo $count;?></td>
                                                <td ><?php echo $name;?></td>
                                                <td class="no-print"><a href="?entry&update=<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a> <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#confirm-delete<?php echo $id;?>"><i class="fa fa-trash"></i></button></td>
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
                                            	<th>#</th>
                                                <th>Station Name</th>
                                                <th>Manage</th>
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
        
            
        <?php require_once('inc/footer.php');?>