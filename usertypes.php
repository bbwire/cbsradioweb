<?php 
require_once 'inc/essentials.php';

$class = 'SettingsController';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
    
$page_title = 'Add user type';
$action_btn_name = 'postnew';
$action_btn_txt = 'Save';
$table = 'usertype';
$primary_key = 'id';
$url = 'usertypes';

$type = '';

if(isset($_GET['update']))
{
	$updateid = $_GET['update'];
	
	$updatedatas = $controller->getindividual($table, $primary_key, $updateid);
	
	foreach($updatedatas as $data)
	{
		$type = $data->typeName;
	}
	
	$page_title = 'Update user type';
	$action_btn_name = 'update';
	$action_btn_txt = 'Save changes';
}
        
        ?>
                

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        User types
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">User types</li>
                   
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
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo $page_title;?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <?php
                                    if(isset($_POST['postnew']))
                                    {
                                        $controller->posttype($url, $table);
                                    }
                                    
                                    if(isset($_POST['update']))
                                    {
                                        $controller->updatetype($updateid, $url, $primary_key, $table);
                                    }
                                    ?>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="type">User type</label>
                                            <input type="text" name="type" id="type" placeholder="User type" class="form-control" value="<?php echo $type;?>">
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <button type="submit" name="<?php echo $action_btn_name;?>" class="btn btn-success btn-flat" id="save"><i class="fa fa-check"></i> <?php echo $action_btn_txt;?></button>
                                            
                                            <?php
                                            if(isset($_GET['update'])){
                                                ?>
                                                <a href="<?php echo $url;?>" class="btn btn-danger btn-flat pull-right"><i class="fa fa-times"></i> Cancel</a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </form>
                                    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                        <div class="col-xs-8">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">User types</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <?php
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
                                    <!--<div class="col-xs-12 pull-right">
                                        <a href="?entry" class="btn btn-primary btn-flat pull-right"><i class="fa fa-plus"></i> Add user</a>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>-->
                                    <div class="info"></div>
                                    <form action="" method="post" name="form1" onSubmit="return delete_confirm();">
                                    <table id="example1" class="table table-bordered table-striped bulk_action">
                                        <thead>
                                        <tr>
                                            <th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>
                                            <th>#</th>
                                            <th>Type title</th>
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
                                            $count++;
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" class="table_records flat" name="ids[]" value="<?php echo $id;?>" title="<?php echo $data->typeName;?>"></td>
                                            <td><?php echo $count;?></td>
                                            <td><?php echo $data->typeName;?></td>
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
                                            <th>Type title</th>
                                            <th>Manage</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <div class="clearfix"></div>
                                            <hr>
                                            
                                            <button type="submit" class="btn btn-danger btn-flat" name="deletemulti" id="delete_multiple"><i class="fa fa-trash"></i> Delete multiple Records</button>
                                            
                                    </form>
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