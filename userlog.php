<?php 
require_once 'inc/essentials.php';

$class = 'Controller';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
        
$page_title = 'Userlog';
$table = 'userlog';
$primary_key = 'id';
$url = 'userlog';
        ?>
                

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        User log
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">User log</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                	
                	
                    <div class="row">
                        <div class="col-xs-12">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">User logs</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <hr>
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
                                    
                                    <form action="" method="post" name="form1" onSubmit="return delete_confirm();">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Event</th>
                                    <th>Datetime</th>
                                    <th>Time elapsed</th>
                                    <th>Manage</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $datas = $controller->getdata($table, $primary_key, "desc");
                                    
                                    $count = 0;
                                    foreach($datas as $data)
                                    {
                                        $id = $data->id;
                                        $user = $data->user;
                                        $event = $data->eventdetails;
                                        $datetime = $data->datetime;
                                        $time_elapsed = $controller->time_elapsed_string($datetime, false);
                                        $count++;
                                        
                                        $usernam = '';					
                                        $get_user = $controller->getindividual("users", "id", $user);
                                        foreach($get_user as $use)
                                        {
                                            $usernam = $use->fname.' '.$use->lname;
                                        }
                                        
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" class="table_records flat" name="ids[]" value="<?php echo $id;?>"></td>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $usernam;?></td>
                                    <td><?php echo $event;?></td>
                                    <td><?php echo $datetime;?></td>
                                    <td> <?php echo $time_elapsed;?></td>
                                    <td><button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#confirm-delete<?php echo $id;?>"><i class="fa fa-trash"></i></button></td>
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
                                    <th>User</th>
                                    <th>Event</th>
                                    <th>Datetime</th>
                                    <th>Time elapsed</th>
                                    <th>Manage</th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <div class="clearfix"></div>
                                <hr />
                                <button type="submit" class="btn btn-danger btn-flat" name="deletemulti" id="delete_multiple"><i class="fa fa-trash"></i> Delete multiple Records</button>
                                        
                                </form>
                                <div class="clearfix"></div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
                  
        <?php require_once('inc/footer.php');?>