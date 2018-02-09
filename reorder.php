<?php 
require_once 'inc/essentials.php';

$class = 'Controller';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
        
$table = 'posts';
$primary_key = 'id';
$url = 'reorder';
        ?>
                

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Reorder news
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Reorder news</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                	
                	
                    <div class="row">
                        <div class="col-xs-12">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Reorder news</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <div class="filter">
                                <hr />
                                    <?php
                                  $date = date("Y-m-d");
                                  $mtime = '';
                                  if(isset($_GET['time']))
                                    {
                                    $mtime = $_GET['time'];
                                    $sql = '';
                                    if($mtime != '')
                                    {
                                      $sql = "SELECT * FROM $table where dateReported = '$date'";
                                    }
                                    /*else if($mmonth != '')
                                    {
                                      $sql = "SELECT * FROM individualcontribution WHERE department = '$department' and type = '$type' and year = '$myear' and month = '$mmonth'";
                                    }*/
                                    
                                    }
                                       ?>
                                      <div class="info"></div>
                                      <div class="col-lg-12 col-sm-12 no-print">
                                          <div class="text-muted font-13 m-b-30">
                                              <div class="row">
                                                  <form action="" class="form-horizontal form-label-left" id="demo-form2" data-parsley-validate>
                                                      
                                                      <div class="col-lg-4">
                                                          
                                                        <?php
                                                        $types = $controller->getdata("newstime", "timeId", "asc");
                                                        ?>
                                                        <label class="control-label" for="time">News time <span class="required">*</span>
                                                        </label>
                                                        <select name="time" class="options form-control" required id="time">
                                                        <option value="">Select Option</option>
                                                        <?php
                                                        foreach($types as $type)
                                                        {
                                                          ?>
                                                          <option value="<?php echo $type->id;?>" <?php if($mtime == $type->id) echo "selected";?>><?php echo $type->timeLabel;?></option>
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
                                                              if(isset($_GET['time'])){
                                                              ?>
                                                              <a href="<?php echo basename($_SERVER['PHP_SELF']);?>" class="btn btn-danger"><span class="fa fa-times"></span> Cancel</a>
                                                              <?php
                                                              }
                                                              ?>
                                                          </div>
                                                      </div>
                                                  </form>
                                              </div>
                                          </div>
                                          <hr>
                                      </div>
                                      <div class="clearfix"></div>
                                </div>
                                <?php
                                if(isset($_GET['time'])){
                                ?>
                                <ul class="todo-list">
                                    <?php
                                  $get_posts = $controller->getcustomdata($sql);
                                  
                                  foreach($get_posts as $post)
                                  {
                                  ?>
                                  <li>
                                    <!-- drag handle -->
                                    <span class="handle">
                                    
                                    <!-- todo text -->
                                    <span class="text"><?php echo $post->title;?></span>
                                    <p><?php echo $post->description;?></p>
                                    <!-- Emphasis label -->
                                    <small class="label label-danger"><i class="fa fa-clock-o"></i> <?php echo $post->date;?></small>
                                    <!-- General tools such as edit or delete-->
                                    </span>
                                    <div class="tools">
                                      <i class="fa fa-edit"></i>
                                      <i class="fa fa-trash-o"></i>
                                    </div>
                                  </li>
                                  
                                  <?php
                                  }
                                  ?>
                                  
                                </ul>
                                <?php
                                }
                                ?>
                                <div class="clearfix"></div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
                  
        <?php require_once('inc/footer.php');?>