<?php 
require_once 'inc/essentials.php';

$class = 'Controller';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
    
        $table = "lineup";
        $pk = "id";
        $url = "lineup";

        if(isset($_GET['entry'])){
            $action_btn_name = "postnew";
            $action_btn_txt = "Save";

            $prog = '';
            $pday = '';
            $stime = '';
			$etime = '';
            $ptype = '';
            $pday_array = array();

            if(isset($_GET['update'])){
                $updateid = $_GET['update'];

                $get_data = $controller->getindividual($table, "programid", $updateid);

                
                foreach($get_data as $data)
                {
                    $prog = $data->programid;
                    $pday = $data->progDay;
                    $stime = $data->startTime;
					$etime = $data->endTime;
                    $ptype = $data->progType;
                    
                    array_push($pday_array, $pday);
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
                        Lineup
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Lineup</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                	<?php
                    if(isset($_GET['entry']))
                    {
                        
                        if(isset($_POST['postnew'])){
                            $prog = $_POST['prog'];
                            $pday = $_POST['pday'];
                            $stime = $_POST['stime'];
                            $etime = $_POST['etime'];
							$ptype = $_POST['ptype'];
                            
                            foreach($pday as $day){
                                $columns = "programid, progDay, startTime, endTime, progType";
                                $values = "'$prog', '$day', '$stime', '$etime', '$ptype'";
                                
                                $controller->model->saveexcel($table, $columns, $values, $url);
                            }

                            $controller->model->Alert("alert-success", "Saved successfully");
                                
                            
                        }
                        
                        if(isset($_POST['update'])){
                            $prog = $_POST['prog'];
                            $pday = $_POST['pday'];
                            $stime = $_POST['stime'];
                            $etime = $_POST['etime'];
							$ptype = $_POST['ptype'];
                            
                            $controller->model->deleteexcel($table, "programid", $updateid, $url);

                            foreach($pday as $day){
                                $columns = "programid, progDay, startTime, endTime, progType";
                                $values = "'$updateid', '$day', '$stime', '$etime', '$ptype'";
                                
                                $controller->model->saveexcel($table, $columns, $values, $url);
                            }
                            
                            $controller->model->Alert("alert-success", "Changes saved");
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
                                    <label>Program days</label>
                                    <div class="row">
                                        <?php
                                        $progdays = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");

                                        foreach($progdays as $day){

                                            if(in_array($day, $pday_array)){
                                                ?>
                                                <div class="col-sm-2"><label><input type="checkbox" name="pday[]" class="flat-red" checked value="<?php echo $day;?>"> <?php echo $day;?></label></div>
                                                <?php
                                            }else{
                                            ?>
                                            <div class="col-sm-2"><label><input type="checkbox" name="pday[]" class="flat-red" value="<?php echo $day;?>"> <?php echo $day;?></label></div>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="input-group" id='starttime'>
                                        <span class="input-group-addon">Start time</span>
                                        
                                        <input type="text" name="stime" class="form-control starttime" required value="<?php echo $stime;?>" placeholder="Start time">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="input-group" id='endtime'>
                                        <span class="input-group-addon">End time</span>
                                        <input type="text" name="etime" class="form-control starttime" required value="<?php echo $etime;?>" placeholder="End time">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="input-group">
                                        <?php
                                        $ptypes = array("repeat", "normal");
                                        ?>
                                        <span class="input-group-addon">Programme type</span>
                                        <select name="ptype" required class="form-control">
                                            <option value="">Select programme type</option>
                                            <?php
                                            foreach($ptypes as $typ){
                                                ?>
                                                <option <?php if($typ == $ptype) echo "selected";?>><?php echo $typ;?></option>
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
                        <div class="col-xs-3"><a class="btn btn-block btn-primary btn-flat no-print" href="?entry"><i class="fa fa-pencil"></i> Add programme line up</a>
                        </div>
                        
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Line up</h3>
                                </div><!-- /.box-header -->
                                <!-- Custom Tabs -->
                                <div class="clearfix"></div>
                                <hr>
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                    <?php 
                                    $stn_array = array();
                                    $get_stations = $controller->getdata("stations");

                                    $count = 0;
                                    foreach($get_stations as $stnnnn){
                                        $count++;
                                        $stnnid = $stnnnn->id;
                                        $stnnam = $stnnnn->stationName;
                                        ?>
                                        <li class="<?php if($count == 1) echo "active";?>"><a href="#tab_<?php echo $stnnid;?>" data-toggle="tab" aria-expanded="true"><?php echo $stnnam;?> FM</a></li>
                                        <?php
                                        array_push($stn_array, $stnnid);
                                    }
                                    ?>
                                    
                                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                                    </ul>
                                    <div class="tab-content">

                                    <?php
                                    $count = 0;
                                    foreach($stn_array as $stid){
                                        $count++;
                                    ?>
                                    <div class="tab-pane <?php if($count == 1) echo "active";?> " id="tab_<?php echo $stid;?>">
                                        <table id="example<?php echo $count;?>" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Programme</th>
                                                    <th>Programme day</th>
                                                    <th>Start time</th>
                                                    <th>End time</th>
                                                    <th>Programme type</th>
                                                    <th class="no-print">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $sql = "SELECT p.id progid, p.name FROM programme p INNER JOIN stations s ON p.station = s.id 
                                                WHERE s.id = $stid";
                                                $count = 0;
                                                $user_datas = $controller->getcustomdata($sql);
                                                foreach($user_datas as $data){
                                                    $count++;
                                                    
                                                    
                                                    $id = $data->progid;
                                                    $pname = $data->name;

                                                    $get_lineup = $controller->getindividual("lineup", "programid", $id);

                                                    $pdayss = '';
                                                    foreach($get_lineup as $line){
                                                        $pday = $line->progDay;

                                                        $pdayss .= "<span class='btn btn-primary btn-xs'>$pday</span> ";
                                                        $stime = $line->startTime;
                                                        $etime = $line->endTime;
                                                        $ptype = $line->progType; 
                                                    }
                                                    
                                            ?>
                                                <tr>
                                                    <td ><?php echo $count;?></td>
                                                    <td ><?php echo $pname;?></td>
                                                    <td ><?php echo $pdayss;?></td>
                                                    <td ><?php echo $stime;?></td>
                                                    <td ><?php echo $etime;?></td>
                                                    <td ><?php echo $ptype;?></td>
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
                                                    <th>Programme day</th>
                                                    <th>Start time</th>
                                                    <th>End time</th>
                                                    <th>Programme type</th>
                                                    <th class="no-print">Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <br><br>
                                        <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                                <!-- nav-tabs-custom -->
                               
                                <div class="clearfix"></div>
                                <div class="box-body table-responsive">
                                
                                    
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