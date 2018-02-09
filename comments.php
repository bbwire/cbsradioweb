<?php 
require_once 'inc/essentials.php';

$class = 'Controller';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php';  
        
        $table = "comments";
        $pk = "id";
        $url = "comments";

       
        ?>
                

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Comments
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Comments</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                	<?php
                    if(isset($_GET['entry']))
                    {
                        
                    }
                    else{
					
						
						
						if(isset($_GET['delete'])){
							
							$del = $_GET['delete'];
							
							$controller->delete($table, $pk, $del, $url);
							
						}
					?>
                	
                    <div class="row">
                        <div class="col-xs-12">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All comments</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    
                                <?php
                                            /*$mdate = '';
                                            $mprogramme = '';
                                            if(isset($_GET['date']) and isset($_GET['programme']))
                                              {
                                              $mdate = $_GET['date'];
                                              $mprogramme = $_GET['programme'];
                                              
                                              /*else if($mmonth != '')
                                              {
                                                    $sql = "SELECT * FROM individualcontribution WHERE department = '$department' and type = '$type' and year = '$myear' and month = '$mmonth'";
                                              }
                                              
                                              }*/
                                             ?>
                                            <div class="info"></div>
                                            <!--<div class="col-lg-12 col-sm-12 no-print">
                                                <p class="text-muted font-13 m-b-30">
                                                    <div class="row">
                                                        <form action="" class="form-horizontal form-label-left" id="demo-form2" data-parsley-validate>
                                                            
                                                            <div class="col-lg-4">
                                                                
                                                                <label class="control-label" for="start_date">Date <span class="required">*</span>
                                                                </label>
                                                                 <input class="form-control" name="date" placeholder="Date" id="start_date" type="text" value="<?php echo $mdate;?>" required>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                
                                                                <?php
                                                                $get_programs = $controller->getdata("programme");
                                                                ?>
                                                                <label class="control-label" for="start_date"> Programme<span class="required">*</span></label>
                                                                <select name="programme" required class="select2 form-control">
                                                                    <option value="">Select programme</option>
                                                                    <?php
                                                                    foreach($get_programs as $prg){
                                                                        ?>
                                                                        <option value="<?php echo $prg->id;?>" <?php if($prg->id == $mprogramme) echo "selected";?>><?php echo $prg->name;?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="col-lg-4">
                                                                <div class="btn-group">
                                                                    <label class="control-label"> <span class="required">*</span></label>
                                                                    <div class="clearfix"></div>
                                                                    <input type="submit" name="action" value="Filter" class="btn btn-primary">
                                                                    <?php
                                                                    if(isset($_GET['date'])){
                                                                    ?>
                                                                    <a href="<?php echo basename($_SERVER['PHP_SELF']);?>" class="btn btn-danger"><span class="fa fa-times"></span> Cancel</a>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </p>
                                                <hr>
                                            </div>
                                            <div class="clearfix"></div>-->
                                        <?php
                                        
                                            
                                            $topic_datas = $controller->getcustomdata("SELECT t.id tid, t.title, t.date, p.name FROM topic t 
                                            INNER JOIN programme p ON p.id = t.progid ORDER BY t.id");
                                            
                                            
                                                foreach($topic_datas as $tdata){

                                                    $tid = $tdata->tid;
                                                    $title = $tdata->title;
                                                    $tdate = $tdata->date;
                                                    $pname = $tdata->name;

                                                    ?>
                                                    <h3 class="box-title">Programme: <?php echo $pname;?> </h3>
                                                    <h3 class="box-title">Topic: <?php echo $title;?> (<?php echo $tdate;?>)</h3>
                                                    <?php                                                

                                                    $user_datas = $controller->getindividual($table, "topicid", $tid);
                                                        $count = 0;
                                                    if(count($user_datas) > 0){
                                                        foreach($user_datas as $data){
                                                            $count++;
                                                            
                                                            
                                                            $id = $data->id;
                                                            $userid = $data->userid;
                                                            $message = $data->message;
                                                            $timedate = $data->timeDate;
                                                            $topicid = $data->topicid;

                                                            $exp_time = explode(" ", $timedate);

                                                            $time = $exp_time[1];
                                                            
                                                            ?>
                                                            <div class="col-xs-12">
                                                                <p><?php echo $message;?> (<?php echo $time;?>)</p>
                                                                <span class="pull-right"><a href="?delete=<?php echo $id;?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this comment?')"><i class="fa fa-times"></i></a></span>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <?php
                                                    
                                                        }
                                                    }else{
                                                        ?>
                                                        <h3 class="box-title">No messages for this topic</h3>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="clearfix"></div>
                                                    <hr>
                                                    <?php
                                                }
                                           
                                        
											?>
                                        <div class="clearfix"></div>
                                    <br><br>
                                    
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