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
                                $id = $_GET['detail'];
                                
                                if(isset($_GET['isread'])){
                                    $controller->model->update($table, "isRead = '1'", $primary_key, $id, "incoming?detail=$id");
                                }
                                
                                $datas = $controller->getindividual($table, "id", $id);
                                
                                foreach($datas as $data)
                                {
                                    $title = $data->title;
                                    $desc = $data->description;
                                    $datetime = $data->date;
                                    $user = $data->user;
                                }
                                
                                $detail_panel_title = $title;
                            }
                            ?>
                        <div class="box">
                            <div class="box-header">
                            <h3 class="box-title"><?php echo $page_title;?></h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                            
                                <div class="info"></div>
                            
                                <?php
                                if(isset($_GET['detail']))
                                {
                                    
                                    $date = date("Y-m-d");
                                    
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
                                    $video_array = array();
                                    $get_vid = $controller->getcustomdata("select * from uploads where type = 'Video' and post = '$id'");
                                    
                                    foreach($get_vid as $vid)
                                    {
                                        $video = $vid->file_path;
                                        
                                        array_push($video_array, $video);
                                    }
                                    
                                    $audio = '';
                                    $audio_array = array();
                                    $get_aud = $controller->getcustomdata("select * from uploads where type = 'Audio' and post = '$id'");
                                    
                                    foreach($get_aud as $aud)
                                    {
                                        $audio = $aud->file_path;
                                        
                                        array_push($audio_array, $audio);
                                    }
                                    
                                    $videotd = '';
                                    if(count($video_array) == 0)
                                    {
                                        $videotd = '<span style="color:red;">No video </span>';
                                    }else
                                    {
                                        for($i = 0; $i < count($video_array); $i++)
                                        {
                                            $videotd .= " <span class=\"btn btn-success btn-xs btn-flat\" data-toggle=\"modal\" data-target=\"#video-play$id\"><i class=\"fa fa-video-camera\"></i>  Click to play video</span>";
                                        }
                                    }
                                    
                                    $audiotd = '';
                                    if(count($audio_array) == 0)
                                    {
                                        $audiotd = '<span style="color:red;">No audio </span>';
                                    }else
                                    {
                                        for($i = 0; $i < count($audio_array); $i++)
                                        {
                                            $audiotd .= " <span class=\"btn btn-success btn-xs btn-flat\" data-toggle=\"modal\" data-target=\"#audio-play$id\"><i class=\"fa fa-music\"></i> Click to play audio</span>";
                                        }
                                    }
                                    
                                    if($imgurl == '')
                                    {
                                        $imgtd = '<span style="color:red;">No image </span>';
                                    }else
                                    {
                                        $imgtd = "<span class=\"btn btn-success btn-xs btn-flat\" data-toggle=\"modal\" data-target=\"#img$id\"><i class=\"fa fa-image\"></i> Click to view image</span>";
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
                                    <label>Title:</label> <?php echo $title;?>
                                </div>
                                <div class="form-group">
                                    <label>Main news bulleting:</label> <?php echo $desc;?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="pull-right">
                                    <button type="button" class="btn btn-primary btn-flat btn-xs"  data-toggle="modal" data-target="#editnews"><i class="fa fa-edit"></i></button>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                
                                <div class="form-group">
                                    <label>Video:</label> <?php echo $videotd;?>
                                </div>
                                
                                <div class="form-group">
                                    <label>Audio:</label> <?php echo $audiotd;?>
                                </div>
                                
                                <div class="form-group">
                                    <label>Image:</label> <?php echo $imgtd;?>
                                </div>
                                
                                <hr>
                                <?php
                                if(isset($_POST['addtoair']))
                                {
                                    $controller->posttoair("incoming?detail=$id", "tobeaired", $id);
                                }
                                ?>
                                <form action="" method="post">
                                    <h3>Add to air</h3>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-7">
                                                <?php
                                                $types = $controller->getdata("newstime", "timeId", "asc");
                                                ?>
                                                <label class="control-label" for="time">News time <span class="required">*</span>
                                                </label>
                                            <select name="time" class="select2 form-control" required id="time">
                                                <option value="">Select Option</option>
                                                <?php
                                                foreach($types as $type)
                                                {
                                                    ?>
                                                    <option value="<?php echo $type->id;?>"><?php echo $type->timeLabel;?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            </div>
                                            
                                            <div class="col-xs-5">
                                                <label class="control-label" for="time"> <span class="required">*</span>
                                                </label>
                                                <div class="clearfix"></div>
                                                <button type="submit" name="addtoair" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Save</button>
                                            </div>
                                        </div>
                                    </div>
                                
                                </form>
                                
                                <hr>
                                <div class="form-group">
                                    <a href="<?php echo $url;?>" class="btn btn-danger btn-flat"><i class="fa fa-times"></i> Close</a>
                                </div>
                                <?php
                                }else{
                                    $date = date("Y-m-d");
                                    $get_highlights = $controller->getindividual($table, "date", $date);
                                    
                                    $newsstring = '';
                                    foreach($get_highlights as $highlight)
                                    {
                                        $newsstring = $highlight->newsString;
                                    }
                                    
                                    $newsarray = explode(',', $newsstring);
                                    
                                    $numnews = count($newsarray);
                                    $ncount = 0;
                                    for($i = 0; $i < $numnews; $i++)
                                    {
                                        $ncount++;
                                        $id = $newsarray[$i];
                                        
                                        $get_news = $controller->getindividual("posts", "id", $id);
                                        foreach($get_news as $news)
                                        {
                                            
                                            $title = $news->title;
                                            ?>
                                            <h2><?php echo $ncount.'. '.$title;?></h2>
                                            <?php
                                        }
                                    ?>
                                        
                                    <?php
                                    }
                                }
                                ?>
                            </div><div class="clearfix"></div>
                            <!-- /.box-body -->
                        </div><div class="clearfix"></div>
                        <!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
                  
        <?php require_once('inc/footer.php');?>