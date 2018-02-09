<?php 
require_once 'inc/essentials.php';

$class = 'Controller';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
        
$page_title = 'To be aired';
$table = 'newstime';
$primary_key = 'id';
$url = 'tobeaired';
        ?>
                

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        News Highlights
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">News Highlights</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                	
                	
                    <div class="row">
                        <div class="col-xs-12">
                            
                        <?php
                            $detail_panel_title = "Detail";
                            if(isset($_GET['detail']))
                            {
                                $tid = $_GET['detail'];
                                
                                $datas = $controller->getindividual($table, $primary_key, $tid);
                                
                                foreach($datas as $data)
                                {
                                    $title = $data->timeLabel;
                                }
                                
                                $detail_panel_title = $title.' News';
                            }
                            ?>
                        <div class="box tobeaired">
                            <div class="box-header">
                            <div class="pull-left"><h3 class="box-title"><?php echo $detail_panel_title;?></h3></div>
                            <div class="pull-right"><a class="font-button plus btn btn-success btn-flat">A+</a> <a class="font-button minus btn btn-warning btn-flat">A-</a></div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                            
                                <div class="info"></div>
                            
                                <?php
                                        
                                if(isset($_GET['remove']) and isset($_GET['post']))
                                {
                                    $tbid = $_GET['remove'];
                                    $postid = $_GET['post'];
                                    
                                    $controller->removepost("tobeaired", $url, "airId", $tbid, $postid);
                                }
                                
                                if(isset($_GET['details']))
                                {
                                    $date = date("Y-m-d");
                                    
                                    $newsstring_array = array();
                                    
                                    $get_tobeaired = $controller->getindividual("tobeaired", "timeId", $tid);
                                    
                                    if(count($get_tobeaired) > 0)
                                    {
                                        foreach($get_tobeaired as $toair)
                                        {
                                            $newsstring = $toair->newsString;
                                            $aId = $toair->airId;
                                        }
                                        
                                        $newsstring_array = explode(",", $newsstring);
                                        
                                        $num = count($newsstring_array);
                                        
                                        for($i = 0; $i < $num; $i++)
                                        {
                                            $id = $newsstring_array[$i];
                                            
                                            $getnews = $controller->getindividual("posts", "id", $id);
                                            
                                            foreach($getnews as $gnews)
                                            {
                                                $user = $gnews->user;
                                                $datetime = $gnews->date;
                                                $ntitle = $gnews->title;
                                                $desc = $gnews->description;
                                            }
                                            
                                            $time_elapsed = $controller->time_elapsed_string($datetime, false);
                                            
                                            $sender = '';
                                            $get_sender = $controller->getindividual("users", "id", $user);
                                            
                                            foreach($get_sender as $send)
                                            {
                                                $sender = $send->fname.' '.$send->lname;
                                                $photo = $send->photo;
                                            }
                                            
                                            if($photo == '')
                                                $photo = 'dist/img/user2-160x160.jpg';
                                            
                                            $imgurl = '';
                                            $get_img = $controller->getcustomdata("select * from uploads where type = 'Photo' and post = '$id'");
                                            
                                            foreach($get_img as $imgg)
                                            {
                                                $imgurl = $imgg->file_path;
                                            }
                                            
                                            $video = '';
                                            $get_vid = $controller->getcustomdata("select * from uploads where type = 'Video' and post = '$id'");
                                            
                                            foreach($get_vid as $vid)
                                            {
                                                $video = $vid->file_path;
                                            }
                                            
                                            $audio = '';
                                            $get_aud = $controller->getcustomdata("select * from uploads where type = 'Audio' and post = '$id'");
                                            
                                            foreach($get_aud as $aud)
                                            {
                                                $audio = $aud->file_path;
                                            }
                                            
                                            if($video == '')
                                            {
                                                $videotd = '<span style="color:red;">No video </span>';
                                            }else
                                            {
                                                $videotd = "<span class=\"btn btn-success btn-xs btn-flat\" data-toggle=\"modal\" data-target=\"#video-play$id\"><i class=\"fa fa-video-camera\"></i></span>";
                                            }
                                            
                                            if($audio == '')
                                            {
                                                $audiotd = '<span style="color:red;">No audio </span>';
                                            }else
                                            {
                                                $audiotd = "<span class=\"btn btn-success btn-xs btn-flat\" data-toggle=\"modal\" data-target=\"#audio-play$id\"><i class=\"fa fa-music\"></i></span>";
                                            }
                                            
                                            if($imgurl == '')
                                            {
                                                $imgtd = '<span style="color:red;">No image </span>';
                                            }else
                                            {
                                                $imgtd = "<span class=\"btn btn-success btn-xs btn-flat\" data-toggle=\"modal\" data-target=\"#img$id\"><i class=\"fa fa-image\"></i></span>";
                                            }
                                        
                                        ?>
                                        
                                        <div class="user-panel" style="border-bottom:1px solid #eaeaea; margin-bottom:20px;">
                                            <div class="pull-left image">
                                            <img src="<?php echo $photo;?>" title="<?php echo $sender;?>" class="img-circle" alt="<?php echo $sender;?>">
                                            </div>
                                            <div class="pull-left info color-black">
                                            <p><?php echo $sender;?></p>
                                            
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Title:</label> <?php echo $ntitle;?>
                                        </div>
                                        <div class="form-group">
                                            <label>Description:</label> <?php echo $desc;?>
                                            <div class="clearfix"></div>
                                            <hr>
                                            <div class="pull-left">
                                                <a href="?remove=<?php echo $aId;?>&time=<?php echo $tid;?>&post=<?php echo $id;?>" onClick="return confirm('Are you sure you want to remove this post?');" class="btn btn-danger btn-flat btn-xs"><i class="fa fa-times"></i> Remove</a>
                                            </div>
                                            <div class="pull-right">
                                                <?php echo $videotd;?>
                                                <?php echo $audiotd;?>
                                                <?php echo $imgtd;?>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                        
                                        
                                        <div class="modal fade" id="video-play<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <b><i class="fa fa-info-circle"> </i>  <?php echo $ntitle;?> - Video</b>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!--<video controls src="demo/<?php echo $video;?>" width="100%" height="200"></video>-->
                                                        <video width="100%" height="240">
                                                        <source src="../../CBS-api/<?php echo $video;?>" type="video/mp4">
                                                        <source src="../../CBS-api/<?php echo $video;?>" type="video/3gp">
                                                        Your browser does not support the video tag.
                                                        </video>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-times"> </i> Cancel</button>
                                                        <a href="../../CBS-api/<?php echo $video;?>" class="btn btn-success btn-ok btn-flat"><i class="fa fa-download"> </i> Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="modal fade" id="audio-play<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <b><i class="fa fa-info-circle"> </i> <?php echo $ntitle;?> - Audio</b>
                                                    </div>
                                                    <div class="modal-body">
                                                        <audio controls>
                                                        <!--<source src="horse.ogg" type="audio/ogg">-->
                                                        <source src="../../CBS-api/<?php echo $audio;?>" type="audio/mpeg">
                                                        
                                                        Your browser does not support the audio element.
                                                        </audio>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-times"> </i> Cancel</button>
                                                        <a href="../../CBS-api/<?php echo $audio;?>" class="btn btn-success btn-ok btn-flat"><i class="fa fa-download"> </i> Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="modal fade" id="img<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <b><i class="fa fa-info-circle"> </i> <?php echo $ntitle;?> - Image</b>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="../../CBS-api/<?php echo $imgurl;?>" class="img-responsive">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-times"> </i> Cancel</button>
                                                        <a href="../../CBS-api/<?php echo $imgurl;?>" class="btn btn-success btn-ok btn-flat"><i class="fa fa-download"> </i> Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        }
                                        
                                        ?>
                                        <div class="clearfix"></div>
                                        
                                        <div class="form-group">
                                            <a href="<?php echo $url;?>" class="btn btn-warning btn-flat"><i class="fa fa-times"></i> Close</a>
                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <h2>No news for this time</h2>
                                        <?php
                                    }
                                }else if(isset($_GET['detail']))
                                {
                                    
                                    ?>
                                    <div class="clearfix"></div>
                                    <br />
                                    <div class="flipbook-viewportsss">
                                        <div class="container">
                                            <div class="flipbooksss">
                                                <!--<div style="background-image:url(turnjs/pages/1.jpg)"></div>-->
                                    <!--<div class="book_wrapper">
                                        <a id="next_page_button"></a>
                                        <a id="prev_page_button"></a>
                                        <div id="loading" class="loading">Loading pages...</div>
                                        <div id="mybook" style="display:none;">
                                            <div class="b-load">-->
                                                <?php
                                                $date = date("Y-m-d");
                                    
                                    $newsstring_array = array();
                                    
                                    $get_tobeaired = $controller->getindividual("postupdate", "tobeaired", $tid);
                                    
                                    //$nums = count($get_tobeaired);
                                    $count = 0;
                                    if(count($get_tobeaired) > 0)
                                    {
                                        foreach($get_tobeaired as $toair)
                                        {
                                            $id = $toair->postId;
                                            $aId = $toair->id;
                                            $ntitle = $toair->title;
                                            $desc = $toair->description;
                                            $count++;
                                            
                                            $getnews = $controller->getindividual("posts", "id", $id);
                                            $user = '';
                                            $datetime = '';
                                            foreach($getnews as $gnews)
                                            {
                                                $user = $gnews->user;
                                                $datetime = $gnews->date;
                                            }
                                            
                                            $time_elapsed = $controller->time_elapsed_string($datetime, false);
                                            
                                            $sender = '';
                                            $get_sender = $controller->getindividual("users", "id", $user);
                                            
                                            foreach($get_sender as $send)
                                            {
                                                $sender = $send->fname.' '.$send->lname;
                                                $photo = $send->photo;
                                            }
                                            
                                            if($photo == '')
                                                $photo = 'dist/img/user2-160x160.jpg';
                                            
                                            $imgurl = '';
                                            $get_img = $controller->getcustomdata("select * from uploads where type = 'Photo' and post = '$id'");
                                            
                                            foreach($get_img as $imgg)
                                            {
                                                $imgurl = $imgg->file_path;
                                            }
                                            
                                            $video = '';
                                            $get_vid = $controller->getcustomdata("select * from uploads where type = 'Video' and post = '$id'");
                                            
                                            foreach($get_vid as $vid)
                                            {
                                                $video = $vid->file_path;
                                            }
                                            
                                            $audio = '';
                                            $get_aud = $controller->getcustomdata("select * from uploads where type = 'Audio' and post = '$id'");
                                            
                                            foreach($get_aud as $aud)
                                            {
                                                $audio = $aud->file_path;
                                            }
                                            
                                            if($video == '')
                                            {
                                                $videotd = '<span style="color:red;">No video </span>';
                                            }else
                                            {
                                                $videotd = "<span class=\"btn btn-success btn-xs btn-flat\" data-toggle=\"modal\" data-target=\"#video-play$id\"><i class=\"fa fa-video-camera\"></i></span>";
                                            }
                                            
                                            if($audio == '')
                                            {
                                                $audiotd = '<span style="color:red;">No audio </span>';
                                            }else
                                            {
                                                $audiotd = "<span class=\"btn btn-success btn-xs btn-flat\" data-toggle=\"modal\" data-target=\"#audio-play$id\"><i class=\"fa fa-music\"></i></span>";
                                            }
                                            
                                            if($imgurl == '')
                                            {
                                                $imgtd = '<span style="color:red;">No image </span>';
                                            }else
                                            {
                                                $imgtd = "<span class=\"btn btn-success btn-xs btn-flat\" data-toggle=\"modal\" data-target=\"#img$id\"><i class=\"fa fa-image\"></i></span>";
                                            }
                                                ?>
                                                
                                                <div>
                                                    <div class="col-sm-12 flip-page">
                                                        
                                                        <h3><?php echo '('.$count.'/'.$num.') '. $ntitle;?></h3>
                                                        <p><?php echo $desc;?></p>
                                                        <hr />
                                                        
                                                        <?php
                                                        if($video != '')
                                                        {
                                                            ?>
                                                            <video width="100%" height="200" controls>
                                                            <source src="../../CBS-api/<?php echo $video;?>" type="video/mp4">
                                                            <source src="../../CBS-api/<?php echo $video;?>" type="video/3gp">
                                                            Your browser does not support the video tag.
                                                            </video>
                                                            <?php
                                                        }
                                                        
                                                        if($audio != '')
                                                        {
                                                            ?>
                                                            <audio controls>
                                                            <source src="horse.ogg" type="audio/ogg">
                                                            <source src="../../CBS-api/<?php echo $audio;?>" type="audio/mpeg">
                                                            
                                                            Your browser does not support the audio element.
                                                            </audio>
                                                            <?php
                                                        }
                                                        ?>
                                                        <div id="root"></div>
                                                        <script type="text/javascript">
                                                            import {RdxVideo, Overlay, Controls} from 'react-html5-video-editor'
                                                            ReactDOM.render(
                                                            <RdxVideo autoPlay loop muted poster="reactvideo/src/img/poster.png" store={store}>
                                                                <Overlay />
                                                                <Controls />
                                                                <source src="reactvideo/src/video/small.mp4" type="video/mp4" />
                                                            </RdxVideo>
                                                            ,
                                                            document.getElementById('root')
                                                            );
                                                        </script>
                                                    </div>
                                                </div>
                                            
                                        
                                        
                                            <?php
                                            }
                                        
                                            }
                                            else
                                            {
                                                ?>
                                                <h2>No news for this time</h2>
                                                <?php
                                            }
                                            ?>
                                                
                                        <!-- </div>
                                        </div>
                                    </div>-->
                                    
                                    <div class="clearfix"></div>
                                    </div>
                                        </div>
                                    </div>
                                    
                                    
                                        
                                        
                                        <div class="modal fade" id="img<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <b><i class="fa fa-info-circle"> </i> <?php echo $ntitle;?> - Image</b>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="../../CBS-api/<?php echo $imgurl;?>" class="img-responsive">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-times"> </i> Cancel</button>
                                                        <a href="../../CBS-api/<?php echo $imgurl;?>" class="btn btn-success btn-ok btn-flat"><i class="fa fa-download"> </i> Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="clearfix"></div>
                                    
                                                
                                        
                                    <?php
                                    
                                }else{
                                    ?>
                                    <h2>No news selected</h2>
                                    <?php
                                }
                                ?>
                                <div class="clearfix"></div>
                            </div><div class="clearfix"></div>
                            <!-- /.box-body -->
                        </div><div class="clearfix"></div>
                        <!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- Flip book -->
	<script src="flipbook/myflips.js"></script>
        
                  
        <?php require_once('inc/footer.php');?>