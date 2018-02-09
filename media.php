<?php 
require_once 'inc/essentials.php';

$class = 'Controller';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 

        ?>
                
                <link href="assets/css/styles.css" rel="stylesheet"/>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        News
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">News</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                	
                    <div class="row">
                        <div class="col-xs-12">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">News</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <div class="filemanager">

                                        <div class="search">
                                            <input type="search" placeholder="Find a file.." />
                                        </div>

                                        <div class="breadcrumbs"></div>

                                        <ul class="data"></ul>

                                        <div class="nothingfound">
                                            <div class="nofiles"></div>
                                            <span>No files here.</span>
                                        </div>

                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="assets/js/script.js"></script>
                  
        <?php require_once('inc/footer.php');?>