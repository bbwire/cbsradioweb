<?php 
require_once 'inc/essentials.php';

$class = 'Controller';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>preview page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        500
                                    </h3>
                                    <p>
                                        All Listeners
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-bars"></i>
                                </div>
                                <a href="listeners" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->

                        <div class="col-sm-3 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        80
                                    </h3>
                                    <p>
                                        International
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-bars"></i>
                                </div>
                                <a href="listeners" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->

                        

                        <div class="col-sm-3 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        300
                                    </h3>
                                    <p>
                                        Local
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-bars"></i>
                                </div>
                                <a href="listeners" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->

                        <div class="col-sm-3 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>
                                        70/50
                                    </h3>
                                    <p>
                                        On the Web/On Mobile
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-bars"></i>
                                </div>
                                <a href="listeners" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="clearfix"></div>

                        <?php 
                        $get_topics = $controller->getdata("topic");

                        foreach($get_topics as $topicss){
                        ?>
                        <div class="col-sm-4 col-xs-12">
                        
                        <div class="box box-solid bg-teal-gradient">
                                <div class="box-header">
                                    <i class="fa fa-bars"></i>
                                    <h3 class="box-title"><?php echo $topicss->title;?></h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <!--<button class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>-->
                                    </div>
                                </div>
                                <div class="box-body border-radius-none">
                                <?php
                                    $get_comments = $controller->getindividual("comments", "topicid", $topicss->id);
                                    ?>
                                    <h3 class="box-title">Comments (<?php echo count($get_comments);?>)</h3>

                                    <h3 class="box-title">Polls Y(4) N(3)</h3>                                 
                                </div><!-- /.box-body -->
                                
                            </div><!-- /.box -->
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <br>
                    <!--<div class="row">
                        <div class="col-xs-6">
                        	<div class="dash-tile"><a href="manage home/slideshow.php"><i class="fa fa-bars"></i> Slideshow</a></div>
                        </div>
                        
                        <div class="col-xs-6">
                        	<div class="dash-tile"><a href="settings.php"><i class="fa fa-bars"></i> Settings</a></div>
                        </div>
                    </div>-->
                        
                    
						
					
                    <br>
                    <!--<div class="row">
                        <div class="col-xs-6">
                        	<div class="dash-tile"><a href="analysis.php">Reports</a></div>
                        </div>
                        
                        <div class="col-xs-6">
                        	<div class="dash-tile"><a href="presenter.php">Profile</a></div>
                        </div>
                    </div>-->
                     
                </section><!-- /.content -->

            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <?php require_once('inc/footer.php'); ?>