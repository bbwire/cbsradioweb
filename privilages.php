<?php 
require_once 'inc/essentials.php';

$class = 'SettingsController';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
    
        $page_title = 'Add privilages';
        $action_btn_name = 'postnew';
        $action_btn_txt = 'Save';
        $table = 'privilages';
        $primary_key = 'id';
        $url = 'privilages';
        
        $usert = '';
        $privils = '';
        $privil_array = array();
        
        if(isset($_GET['update']))
        {
            $updateid = $_GET['update'];
            
            $updatedatas = $controller->getindividual($table, $primary_key, $updateid);
            
            foreach($updatedatas as $data)
            {
                $usert = $data->utype;
                $privils = $data->privilageString;
                
                $privil_array = explode(',', $privils);
            }
            
            $page_title = 'Update privilages';
            $action_btn_name = 'update';
            $action_btn_txt = 'Save changes';
        }
        
        ?>
           <style>
               label{
                   cursor:pointer;
               }
           </style>     

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Privilages
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Privilages</li>
                   
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
                            
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <?php
                                if(isset($_POST['postnew']))
                                {
                                    $controller->postprivilage($url, $table);
                                }
                                
                                if(isset($_POST['update']))
                                {
                                    $controller->updateprivilage($updateid, $url, $primary_key, $table);
                                }
                                ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="item form-group">
                                    <?php
                                        $types = $controller->getdata("usertype", "id", "asc");
                                        ?>
                                        <label class="control-label" for="type">User Type <span class="required">*</span>
                                        </label>
                                        <select name="type" class="select2 form-control" required id="type">
                                            <option value="">Select Option</option>
                                            <?php
                                            foreach($types as $type)
                                            {
                                                ?>
                                                <option value="<?php echo $type->id;?>" <?php if($type->id == $usert) echo "selected";?>><?php echo $type->typeName;?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        
                                    </div>
                                <hr>
                                <div class="item form-group">
                                    <div class="privils">
                                        <h4>Modules</h4>
                                        <hr>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label>All modules (only for super admin)</label>
                                        </div>
                                        <?php
                                        $prvs = array('All modules');									
                                        
                                        foreach($prvs as $prv)
                                        {
                                            if(in_array($prv, $privil_array))
                                            {
                                                ?>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label><input type="checkbox" class="flat" name="privs[]" value="<?php echo $prv;?>" checked> <?php echo $prv;?></label>
                                                </div>
                                                <?php
                                            }else
                                            {
                                                ?>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label><input type="checkbox" class="flat table_records" name="privs[]" value="<?php echo $prv;?>"> <?php echo $prv;?></label>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <div class="clearfix"></div>
                                        <hr>
                                        <h4>Settings</h4>
                                        <hr>
                                        
                                        <?php
                                        $setts = array('Tasks', 'Assign tasks', 'News types', 'Stations', 'User types', 'Privilages', 'Configurations', 'News times', 'Backup database');
                                        
                                        foreach($setts as $set)
                                        {
                                            if(in_array($set, $privil_array))
                                            {
                                                ?>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label><input type="checkbox" class="flat" name="privs[]" value="<?php echo $set;?>" checked> <?php echo $set;?></label>
                                                </div>
                                                <?php
                                            }else
                                            {
                                                ?>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label><input type="checkbox" class="flat table_records" name="privs[]" value="<?php echo $set;?>"> <?php echo $set;?></label>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <div class="clearfix"></div>
                                        <hr>
                                        
                                        <h4>Radio</h4>
                                        <hr>
                                        
                                        <?php
                                        $empps = array('Comments', 'Listeners', 'Programmes', 'Lineup', 'Presenters', 'Sponsors', 'Topic');
                                        
                                        foreach($empps as $empp)
                                        {
                                            if(in_array($empp, $privil_array))
                                            {
                                                ?>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label><input type="checkbox" class="flat" name="privs[]" value="<?php echo $empp;?>" checked> <?php echo $empp;?></label>
                                                </div>
                                                <?php
                                            }else
                                            {
                                                ?>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label><input type="checkbox" class="flat table_records" name="privs[]" value="<?php echo $empp;?>"> <?php echo $empp;?></label>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <div class="clearfix"></div>
                                        <hr>
                                        
                                        <h4>Newsroom</h4>
                                        <hr>
                                        
                                        <?php
                                        $empps = array('Incoming news', 'News highlights', 'To be aired', 'Reorder news', 'Trashed news', 'Assign time', 'News archive', 'Capture news', 'Video editor', 'Media');
                                        
                                        foreach($empps as $empp)
                                        {
                                            if(in_array($empp, $privil_array))
                                            {
                                                ?>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label><input type="checkbox" class="flat" name="privs[]" value="<?php echo $empp;?>" checked> <?php echo $empp;?></label>
                                                </div>
                                                <?php
                                            }else
                                            {
                                                ?>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label><input type="checkbox" class="flat table_records" name="privs[]" value="<?php echo $empp;?>"> <?php echo $empp;?></label>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <div class="clearfix"></div>
                                        <hr>
                                        
                                        <h4>Manage Buttons</h4>
                                        <hr>
                                        
                                        <?php
                                        $repots = array('can edit', 'can delete');
                                        
                                        foreach($repots as $repot)
                                        {
                                            if(in_array($repot, $privil_array))
                                            {
                                                ?>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label><input type="checkbox" class="flat" name="privs[]" value="<?php echo $repot;?>" checked> <?php echo $repot;?></label>
                                                </div>
                                                <?php
                                            }else
                                            {
                                                ?>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label><input type="checkbox" class="flat table_records" name="privs[]" value="<?php echo $repot;?>"> <?php echo $repot;?></label>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <div class="clearfix"></div>
                                        
                                    </div>
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
                            </div><div class="clearfix"></div>
                            <!-- /.box-body -->
                        </div><div class="clearfix"></div>
                        <!-- /.box -->
                        </div>
                        <div class="col-xs-8">
                            
                        <div class="box">
                            <div class="box-header">
                            <h3 class="box-title">Privilages</h3>
                            </div>
                            <!-- /.box-header -->
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
                                    <th>User Type</th>
                                    <th>Privilages</th>
                                    <th>Manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $datas = $controller->getdata($table, $primary_key, "asc");
                                
                                $count = 0;
                                foreach($datas as $data)
                                {
                                    $count++;
                                    $id = $data->id;
                                    $tid = $data->utype;
                                    $pstring = $data->privilageString;
                                    
                                    $pstring_array = explode(',', $pstring);
                                    
                                    $get_types = $controller->getindividual("usertype", "id", $tid);
                                    foreach($get_types as $tp)
                                    {
                                        $usertype = $tp->typeName;
                                    }
                                    
                                    $buttons = '';
                                    foreach($pstring_array as $one)
                                    {
                                        $buttons .= ' <button type="button" class="btn btn-success btn-xs btn-flat"> '. $one .'</button>';
                                    }
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="<?php echo $id;?>" class="table_records flat "></td>
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $usertype;?></td>
                                    <td><?php echo $buttons;?></td>
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
                                    <th>User Type</th>
                                    <th>Privilages</th>
                                    <th>Manage</th>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="clearfix"></div>
                                    <hr>
                                    
                                    <button type="submit" class="btn btn-danger btn-flat" name="deletemulti" id="delete_multiple"><i class="fa fa-trash"></i> Delete multiple Records</button>
                                    
                            </form>
                            </div><div class="clearfix"></div>
                            <!-- /.box-body -->
                        </div><div class="clearfix"></div>
                        <!-- /.box -->
                        </div>
                    </div>
                    <?php
					}
					?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
            
        <?php require_once('inc/footer.php');?>