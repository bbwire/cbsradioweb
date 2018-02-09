<?php 
require_once 'inc/essentials.php';

$class = 'Controller';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
    
        $table = "topic";
        $pk = "id";
        $url = "topic";

        if(isset($_GET['entry'])){
            $action_btn_name = "postnew";
            $action_btn_txt = "Save";

            $prog = '';
            $title = '';
            $desc = '';

            if(isset($_GET['update'])){
                $updateid = $_GET['update'];

                $get_data = $controller->getindividual($table, $pk, $updateid);

                foreach($get_data as $data)
                {
                    $prog = $data->progid;
                    $title = $data->title;
                    $desc = $data->description;
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
                        Topic
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Topic</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                	<?php
                    if(isset($_GET['entry']))
                    {
                        
                        if(isset($_POST['postnew'])){
                            $prog = $_POST['prog'];
                            $title = $_POST['title'];
                            $desc = $_POST['desc'];
                            $date = date("Y-m-d");
                            
                            $columns = "progid, title, description, date";
                            $values = "'$prog', '$title', '$desc', '$date'";
                            
                            $controller->insert($table, $columns, $values, $url);
                                
                            
                        }
                        
                        if(isset($_POST['update'])){
                            $prog = $_POST['prog'];
                            $title = $_POST['title'];
                            $desc = $_POST['desc'];
                            
                            
                            
                            $columns = "progid = '$prog', description = '$desc', title = '$title'";
                            
                            
                            $controller->update($table, $columns, $pk, $updateid, $url);
                            
                            
                        }

                        ?>
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                
                                <div class="form-group">
                                    <div class="input-group">
                                        <?php
                                        $get_programs = $controller->getdata("programme");
                                        ?>
                                        <span class="input-group-addon">Programme</span>
                                        <select name="prog" required class="form-control">
                                            <option value="">Select programme</option>
                                            <?php
                                            foreach($get_programs as $prg){
                                                ?>
                                                <option value="<?php echo $prg->id;?>" <?php if($prg->id == $prog) echo "selected";?>><?php echo $prg->name;?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Title</span>
                                        <input type="text" name="title" class="form-control" required value="<?php echo $title;?>" placeholder="Title">
                                        
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                        <textarea name="desc" class="form-control" placeholder="Description"><?php echo $desc;?></textarea>
                                    
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
                        <div class="col-xs-3"><a class="btn btn-block btn-primary no-print" href="?entry"><i class="fa fa-pencil"></i> Add a new topic</a>
                        </div>
                        
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All topics</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th>Programme</th>
                                                <th>Title</th>
                                                <th>Desc</th>
                                                <th>Date</th>
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
												$prog = $data->progid;
												$desc = $data->description;
												$title = $data->title;
												$date = $data->date;
												
												$pname = '';
												
												$get_program = $controller->getindividual("programme", "id", $prog);
												foreach($get_program as $progg){
													$pname = $progg->name;
												}
										?>
                                            <tr>
                                            	<td ><?php echo $count;?></td>
                                                <td ><?php echo $pname;?></td>
                                                <td ><?php echo $title;?></td>
                                                <td ><?php echo $desc;?></td>
                                                <td ><?php echo $date;?></td>
                                                <td class="no-print"><a href="?entry&update=<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure you want to delete this record?');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>
                                            </tr>
                                            
                                            <?php
											}
											?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            	<th>#</th>
                                                <th>Programme</th>
                                                <th>Title</th>
                                                <th>Desc</th>
                                                <th>Date</th>
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
        
            
        <?php require_once('inc/footer.php');?>