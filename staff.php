<?php require_once('inc/head.php'); ?>
    
    	<?php require_once('inc/top.php'); ?>
        
        <?php require_once('inc/sidebar.php'); 
        
        $table = "staff";
        $pk = "id";
        $url = "staff";

        if(isset($_GET['entry'])){
            $action_btn_name = "postnew";
            $action_btn_txt = "Save";

            $fname = '';
            $lname = '';
            $email = '';
            $station = '';

            if(isset($_GET['update'])){
                $updateid = $_GET['update'];

                $get_user = $controller->getindividual($table, $pk, $updateid);

                foreach($get_user as $data)
                {
                    $fname = $data->fname;
                    $lname = $data->sname;
                    $email = $data->email;
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
                        Staff
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Staff</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                	<?php
                    if(isset($_GET['entry']))
                    {
                        if(isset($_POST['postnew'])){
							$fname = $_POST['fname'];
							$sname = $_POST['lname'];
							$station = $_POST['station'];
							$email = $_POST['email'];
							
							$columns = "fname, sname, station, email";
							$values = "'$fname', '$sname', '$station', '$email'";
							
							$controller->insert($table, $columns, $values, $url);
								
							
						}
						
						if(isset($_POST['update'])){
							$fname = $_POST['fname'];
							$lname = $_POST['lname'];
							$station = $_POST['station'];
							$email = $_POST['email'];
							
							
							$columns = "fname = '$fname', sname = '$lname', station = '$station', email = '$email'";
							
							$controller->update($table, $columns, $pk, $updateid, $url);
							
							
						}

                        ?>
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">First Name</span>
                                        <input type="text" name="fname" class="form-control" required value="<?php echo $fname;?>" placeholder="Enter staff's first name">
                                        
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Last Names</span>
                                        <input type="text" name="lname" required class="form-control" value="<?php echo $lname;?>" placeholder="Enter staff's last name">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Email</span>
                                        <input type="text" name="email" required class="form-control" value="<?php echo $email;?>" placeholder="Enter user's email ">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="input-group">
                                        <?php
                                        $get_stations = $controller->getdata("stations");
                                        ?>
                                        <span class="input-group-addon">Station</span>
                                        <select name="station" required class="form-control">
                                            <option value="">Select Station</option>
                                            <?php
                                            foreach($get_stations as $stat){
                                                ?>
                                                <option value="<?php echo $stat->stationId;?>" <?php if($stat->stationId == $station) echo "selected";?>><?php echo $stat->stationName;?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
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
                        <div class="col-xs-3"><a class="btn btn-block btn-primary no-print" href="?entry"><i class="fa fa-pencil"></i> Add a new staff</a>
                        </div>
                        
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All users</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th>First name</th>
                                                <th>Last name</th>
                                                <th>Email</th>
                                                <th>Station</th>
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
												$fname = $data->fname;
												$lname = $data->sname;
												$station = $data->station;
												$email = $data->email;
												
												$stationam = '';
                                                $get_station = $controller->getindividual("stations", "stationId", $station);
                                                foreach($get_station as $stat){
                                                    $stationam = $stat->stationName;
                                                }
												
										?>
                                            <tr>
                                            	<td ><?php echo $count;?></td>
                                                <td ><?php echo $fname;?></td>
                                                <td ><?php echo $lname;?></td>
                                                <td ><?php echo $email;?></td>
                                                <td ><?php echo $stationam;?></td>
                                                <td class="no-print"><a href="?entry&update=<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure you want to delete this record?');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>
                                            </tr>
                                            
                                            <?php
											}
											?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            	<th>#</th>
                                                <th>First name</th>
                                                <th>Last name</th>
                                                <th>Email</th>
                                                <th>Station</th>
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