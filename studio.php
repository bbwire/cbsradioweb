<?php 
require_once 'inc/essentials.php';

$class = 'Controller';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
        
$page_title = 'News Highlights (Emitwe)';
$table = 'newshighlight';
$primary_key = 'highlightId';
$url = 'highlights';
        ?>
                

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Studio
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Studio</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content" style="background: url(img/studios.jpg);">
                    
                    <div class="bootstrap snippets">
                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-sm-8 studio">
                                <div class="">
        
                                    <ul class="nav nav-tabs tab-header material-tab" role="tablist">
        
                            
                                        <li class="active">
                                            <a href="#comments" role="tab" data-toggle="tab"><i class="fa fa-fw fa-comments-o"></i> Comments <small class="badge pull-right bg-green">2</small></a></li>
                                        <li><a href="#listeners" role="tab" data-toggle="tab"><i class="fa fa-fw fa-user"></i> Listeners <small class="badge pull-right bg-green">8</small></a></li>
        
                                        <li><a href="#videos" role="tab" data-toggle="tab"><i class="fa fa-fw fa-bars"></i> Followers <small class="badge pull-right bg-green">100</small></a></li>
                                    </ul>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content white-bg-tabs">
                                    <div class="tab-pane active" id="comments">
                                    <div class="divider"></div>
                                        <div class="panel rounded shadow">
                                            <form action="...">
                                                <textarea class="form-control input-lg no-border" rows="2" placeholder="What is your topic today?..."></textarea>
                                            </form>
                                            <div class="panel-footer">
                                                <button class="btn btn-success pull-right mt-5">PUBLISH</button>
                                                <ul class="nav nav-pills">
                                                    <li><a href="#"><i class="fa fa-user"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-map-marker"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-camera"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-smile-o"></i></a></li>
                                                </ul><!-- /.nav nav-pills -->
                                            </div><!-- /.panel-footer -->
                                        </div><!-- /.panel -->
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                <div class="panel panel-success rounded shadow">
                                                    <div class="panel-heading no-border">
                                                        <div class="pull-left half">
                                                            <div class="media">
                                                                <div class="media-object pull-left">
                                                                    <img src="http://bootdey.com/img/Content/avatar/avatar6.png" alt="..." class="img-circle img-post">
                                                                </div>
                                                                <div class="media-body">
                                                                    <a href="#" class="media-heading block mb-0 h4 text-white">Meddie Nsereko</a>
                                                                    <span class="text-white h6">on 3rd Febuary, 2018, 30 mins ago</span>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.pull-left -->
                                                        <div class="pull-right">
                                                            <a href="#" class="text-white h4"><i class="fa fa-heart"></i> 15.5K</a>
                                                        </div><!-- /.pull-right -->
                                                        <div class="clearfix"></div>
                                                    </div><!-- /.panel-heading -->
                                                    <div class="panel-body no-padding">
                                                        <div class="inner-all block">
                                                            <h4>This is the topic</h4>
                                                            <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita, iste omnis fugiat porro consequuntur ratione iure error reprehenderit cum est ab similique magnam molestias aperiam voluptatibus quia aliquid! Sed, minima.
                                                            </p>
                                                            <div style="max-height:200px; overflow:hidden;">
                                                            <img data-no-retina="" src="img/radio1.png" alt="..." class="img-responsive">
                                                            </div>
                                                        </div><!-- /.inner-all -->
                                                        <div class="inner-all bg-success">
                                                            view all <a href="#">3 comments</a>
                                                        </div>
                                                    </div><!-- /.panel-body -->
                                                    <div class="panel-footer no-padding no-border">
                                                        <div class="media inner-all no-margin">
                                                            <div class="pull-left">
                                                                <img src="http://bootdey.com/img/Content/avatar/avatar3.png" alt="..." class="img-post2">
                                                            </div><!-- /.pull-left -->
                                                            <div class="media-body">
                                                                <a href="#" class="h4">Sheilah</a>
                                                                <small class="block text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </small>
                                                                <em class="text-xs text-muted">Posted on <span class="text-danger">Feb 03, 2013, 20 mins ago</span></em>
                                                            </div><!-- /.media-body -->
                                                        </div><!-- /.media -->

                                                        <div class="line no-margin"></div><!-- /.line -->

                                                        <div class="media inner-all no-margin">
                                                            <div class="pull-left">
                                                                <img src="http://bootdey.com/img/Content/avatar/avatar5.png" alt="..." class="img-post2">
                                                            </div><!-- /.pull-left -->
                                                            <div class="media-body">
                                                                <a href="#" class="h4">Mike</a>
                                                                <small class="block text-muted">Quaerat, impedit minus non commodi facere doloribus nemo ea voluptate nesciunt deleniti.</small>
                                                                <em class="text-xs text-muted">Posted on <span class="text-danger">Feb 03, 2018, 15 mins ago</span></em>
                                                            </div><!-- /.media-body -->
                                                        </div><!-- /.media -->

                                                        <div class="media inner-all no-margin">
                                                            <div class="pull-left">
                                                                <img src="http://bootdey.com/img/Content/avatar/avatar4.png" alt="..." class="img-post2">
                                                            </div><!-- /.pull-left -->
                                                            <div class="media-body">
                                                                <a href="#" class="h4">Kato</a>
                                                                <small class="block text-muted">

                                                                <audio controls="controls" id="audio_player">
                                                                <source src="img/radio.ogg" type="audio/ogg" />
                                                                <source src="img/radio.mp3" type="audio/mpeg" />
                                                                Your browser does not support the audio element.
                                                                </audio>

                                                                </small>
                                                                <em class="text-xs text-muted">Posted on <span class="text-danger">Feb 03, 2018, 10 mins ago</span></em>
                                                            </div><!-- /.media-body -->
                                                        </div><!-- /.media -->
                                                        <div class="line no-margin"></div><!-- /.line -->
                                                        <form action="#" class="form-horizontal inner-all">
                                                            <div class="form-group has-feedback no-margin">
                                                                <input class="form-control" type="text" placeholder="Your comment here...">
                                                                <button type="submit" class="btn btn-theme fa fa-search form-control-feedback"></button>
                                                            </div>
                                                        </form><!-- /.form-horizontal -->
                                                    </div><!-- /.panel-footer -->
                                                </div><!-- /.panel -->
                                            </div>
                                        </div>
                                    </div> <!-- Comments tab ends here!-->
                                    
                                    <div class="tab-pane" id="listeners">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>User pic</th>
                                                    <th>Name</th>
                                                    <th>Location</th>
                                                    <th>Device</th>
                                                    <th>Status</th>
                                                    <!--<th class="no-print">Action</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="width:7%;">1</td>
                                                    <td style="width:7%;"><img src="img/avatar5.png" class="img-circle"></td>
                                                    <td>Samuel Mutyaba</td>
                                                    <td >Kampala, Uganda</td>
                                                    <td ><i class="fa fa-laptop fa-3x"></i></td>
                                                    <td ><i class="fa fa-circle text-success"></i> Online</td>
                                                    <!--<td class="no-print"><a data-toggle="modal" data-target="#modal-<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure to delete <?php echo $pname;?>');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>-->
                                                </tr>
                                                
                                                <tr>
                                                    <td style="width:7%;">2</td>
                                                    <td style="width:7%;"><img src="img/avatar2.png" class="img-circle"></td>
                                                    <td>David Olunga</td>
                                                    <td >Kisumu, Kenya</td>
                                                    <td ><i class="fa fa-mobile-phone fa-3x"></i></td>
                                                    <td ><i class="fa fa-circle text-success"></i> Online</td>
                                                    <!--<td class="no-print"><a data-toggle="modal" data-target="#modal-<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure to delete <?php echo $pname;?>');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>-->
                                                </tr>
                                                
                                                <tr>
                                                    <td style="width:7%;">3</td>
                                                    <td style="width:7%;"><img src="img/avatar04.png" class="img-circle"></td>
                                                    <td>Daniel Okello</td>
                                                    <td >Kamyokya, Uganda</td>
                                                    <td ><i class="fa fa-mobile-phone fa-3x"></i></td>
                                                    <td ><i class="fa fa-circle text-default"></i> Offline</td>
                                                    <!--<td class="no-print"><a data-toggle="modal" data-target="#modal-<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure to delete <?php echo $pname;?>');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>-->
                                                </tr>
                                                
                                                <tr>
                                                    <td style="width:7%;">4</td>
                                                    <td style="width:7%;"><img src="img/avatar3.png" class="img-circle"></td>
                                                    <td>Apollo Uwineza</td>
                                                    <td >Kigali, Rwanda</td>
                                                    <td ><i class="fa fa-mobile-phone fa-3x"></i></td>
                                                    <td ><i class="fa fa-circle text-success"></i> Online</td>
                                                    <!--<td class="no-print"><a data-toggle="modal" data-target="#modal-<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure to delete <?php echo $pname;?>');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>-->
                                                </tr>
                                                
                                                <?php
                                                //}
                                                ?>
                                            </tbody>
                                            
                                        </table>
                                    </div><!-- Listeners stop here -->
                                    
                                    <div class="tab-pane" id="videos">
                                        Followers 
                                    </div>
                                </div>
                                
                            <!--<div class="profile-cover">
                                <div class="cover rounded shadow no-overflow">
                                    
                                    <ul class="list-unstyled no-padding hidden-sm hidden-xs cover-menu">
                                        <li class="active"><a href="#"><i class="fa fa-fw fa-comments-o"></i> <span>Comments</span></a></li>
                                        <li><a href="#"><i class="fa fa-fw fa-user"></i> <span>Listeners</span></a></li>
                                        <li><a href="#"><i class="fa fa-fw fa-photo"></i> <span>Photos</span> <small>(98)</small></a></li>
                                        <li><a href="#"><i class="fa fa-fw fa-users"></i><span> Friends </span><small>(23)</small></a></li>
                                        
                                    </ul>
                                    <div class="clearfix"></div>
                                </div><!-- /.cover -
                            </div><!-- /.profile-cover -->
                            
                            </div><!-- col-lg-9 -->
                            <div class="col-lg-3 col-md-3 col-sm-4">
                                <div class="panel rounded shadow">
                                    <div class="panel-body">
                                        <div class="inner-all">
                                            <ul class="list-unstyled">
                                                <li class="text-center">
                                                    <img data-no-retina="" class="img-circle img-responsive img-bordered-primary" src="img/radio2.png" alt="John Doe">
                                                </li>
                                                <li class="text-center">
                                                    <h4 class="text-capitalize">MEDDIE NSEREKO <br> OF <br> KIRIZA OBA GAANA</h4>
                                                    <p class="text-muted text-capitalize">Radio Programme</p>
                                                </li>
                                                
                                                <li><br></li>
                                                <li>
                                                    <div class="btn-group-vertical btn-block">
                                                        <a href="" class="btn btn-default"><i class="fa fa-cog pull-right"></i>Edit Account</a>
                                                        <!--<a href="" class="btn btn-default"><i class="fa fa-sign-out pull-right"></i>Logout</a>-->
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- /.panel -->

                                <div class="panel panel-theme rounded shadow">
                                    <div class="panel-heading">
                                        <div class="pull-left">
                                            <!--<h3 class="panel-title">KRIZA OBA GAANA - 89.2 FM</h3>-->
                                        </div>
                                        <!--<div class="pull-right">
                                            <a href="#" class="btn btn-sm btn-success"><i class="fa fa-facebook"></i></a>
                                            <a href="#" class="btn btn-sm btn-success"><i class="fa fa-twitter"></i></a>
                                            <a href="#" class="btn btn-sm btn-success"><i class="fa fa-google-plus"></i></a>
                                        </div>-->
                                        <div class="clearfix"></div>
                                    </div><!-- /.panel-heading -->
                                    <!--<div class="panel-body no-padding rounded">
                                        <ul class="list-group no-margin">
                                            <li class="list-group-item"><i class="fa fa-envelope mr-5"></i> support@bootdey.com</li>
                                            <li class="list-group-item"><i class="fa fa-globe mr-5"></i> www.bootdey.com</li>
                                            <li class="list-group-item"><i class="fa fa-phone mr-5"></i> +6281 903 xxx xxx</li>
                                        </ul>
                                    </div><!-- /.panel-body -->
                                </div><!-- /.panel -->

                            </div>
                            </div>
                        </div>
                    
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
                  
        <?php require_once('inc/footer.php');?>