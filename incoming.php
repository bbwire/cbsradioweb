<?php 
require_once 'inc/essentials.php';

$class = 'SettingsController';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
    
$page_title = 'Incoming news';
$table = 'posts';
$primary_key = 'id';
$url = 'incoming';
        
        ?>
                

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Incoming news
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Incoming news</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                	
                    <div class="row">
                        <div class="col-sm-12">
                        <div class="box">
                        <div class="box-header">
                        <h3 class="box-title">Incoming news</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                    <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">CBS Staff</a></li>
                            <li><a href="#tab_2" data-toggle="tab">Public</a></li>
                            
                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                            </ul>
                            <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                
                            <div class="col-xs-5">
                                <div class="box">
                                    <div class="box-header">
                                    <h3 class="box-title"><?php echo $page_title;?></h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                    <?php
                                        if(isset($_POST['deletemulti'])){
                                            
                                            if(isset($_POST['ids']))
                                            {
                                                $count = count($_POST['ids']);
                                                
                                                for($i=0; $i<$count; $i++)
                                                {
                                                    $value = $_POST['ids'][$i];
                                                    $controller->deletemultiple($table, $primary_key, $value, $url);
                                                }
                                                
                                                $controller->model->Alert("alert-success", "$count Records have been deleted");
                                                
                                            }else
                                            {
                                                $controller->model->Alert("alert-danger", "Please select record(s) to delete");
                                            }
                                        }
                                        
                                        if(isset($_POST['highlightmulti'])){
                                            
                                            if(isset($_POST['ids']))
                                            {
                                                $newsids = implode(',', $_POST['ids']);
                                                
                                                $date = date("Y-m-d");
                                                
                                                $check_highlights = $controller->getindividual("newshighlight", "date", $date);
                                                
                                                if(count($check_highlights) > 0)
                                                {
                                                    $columns = "newsString = '$newsids'";
                                                    
                                                    $controller->update("newshighlight", $columns, "date", $date, $url);
                                                }
                                                else
                                                {
                                                    $columns = 'newsString, date';
                                                    $rows = "'$newsids', '$date'";
                                                    
                                                    $controller->insert("newshighlight", $columns, $rows, $url);
                                                
                                                }
                                                
                                            }else
                                            {
                                                $controller->model->Alert("alert-danger", "Please select record(s) to delete");
                                            }
                                        }
                                        
                                        if(isset($_POST['trashmulti'])){
                                            
                                            if(isset($_POST['ids']))
                                            {
                                                $count = count($_POST['ids']);
                                                
                                                for($i=0; $i<$count; $i++)
                                                {
                                                    $value = $_POST['ids'][$i];
                                                    $controller->trashmultiple($table, $primary_key, $value, $url);
                                                }
                                                
                                                $controller->model->Alert("alert-success", "$count Records have been approved");
                                                
                                            }else
                                            {
                                                $controller->model->Alert("alert-danger", "Please select record(s) to delete");
                                            }
                                        }
                                        ?>
                                        <hr>
                                        <!--<div class="col-xs-12 pull-right">
                                            <a href="?entry" class="btn btn-primary btn-flat pull-right"><i class="fa fa-plus"></i> Add user</a>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>-->
                                        <div class="info"></div>
                                        <form action="" method="post" name="form1" onSubmit="return delete_confirm();">
                                        <div id="loading"><center></center></div>
                                    <table id="example" class="table table-bordered table-striped bulk_action">
                                        <thead>
                                        <tr>
                                            <th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Sender</th>
                                            <th>Date</th>
                                        <!--<th>Status</th>-->
                                        </tr>
                                        </thead>
                                        <tbody id="content">
                                        <?php
                                        $date = date("Y-m-d");
                                        
                                        $datas = $controller->getcustomdata("select * from ".$table." where dateReported = '$date' and status = 'pending' and isTrashed = 0 order by id desc");
                                        
                                        $count = 0;
                                        foreach($datas as $data)
                                        {
                                            $id = $data->id;
                                            $user = $data->user;
                                            $isread = $data->isRead;
                                            
                                            
                                            $datetime = $data->date;
                                            $datet = $data->dateReported;
                
                                            $time = $datet;
                                            if($date == $date){
                                                $time = 'Today';
                                            }
                                            
                                            $split_date = explode(' ', $datetime);
                                            
                                            $newsdate = $split_date[0];
                                            //echo $date;
                                            
                                            $count++;
                                            $time_elapsed = $controller->time_elapsed_string($datetime, false);
                                            
                                            $sender = '';
                                            $get_sender = $controller->getindividual("users", "id", $user);
                                            
                                            foreach($get_sender as $send)
                                            {
                                                $sender = $send->fname.' '.$send->lname;
                                            }
                                            
                                            $style = '';
                                            if($isread == 0)
                                                $style = 'style="text-weight:bold;"';
                                            
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" class="table_records flat" name="ids[]" value="<?php echo $id;?>" title="<?php echo $data->title;?>"></td>
                                            <td><?php echo $count;?></td>
                                            <td><a <?php echo $style;?> href="?detail=<?php echo $id;?>"><?php echo $data->title;?></a></td>
                                            <td><?php echo $sender;?></td>
                                            <td><?php echo $time;?></td>
                                            <!--<td><?php echo $data->status;?></td>-->
                                        </tr>
                                        <?php
                                            
                                        }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Sender</th>
                                            <th>Date</th>
                                        <!--<th>Status</th>-->
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <div class="clearfix"></div>
                                            <hr>
                                            <button type="submit" class="btn btn-success btn-flat" name="highlightmulti" id="approve_multiple"><i class="fa fa-check"></i> Add to news highlights</button>
                                            <button type="submit" class="btn btn-danger btn-flat pull-right" name="trashmulti" id="delete_multiple"><i class="fa fa-trash"></i> Trash selected records</button>
                                            <div class="clearfix"></div>
                                    </form>
                                    </div><div class="clearfix"></div>
                                    <!-- /.box-body -->
                                </div><div class="clearfix"></div>
                                <!-- /.box -->
                                    
                                </div>
                                
                                <div class="col-xs-7">
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
                                    <h3 class="box-title"><?php echo $detail_panel_title;?></h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                    
                                        <div class="info"></div>
                                    
                                        <?php
                                        if(isset($_GET['detail']))
                                        {
                                            
                                            if(isset($_POST['editnews']))
                                            {
                                                $ntitle = mysqli_real_escape_string($controller->model->mysqli, $_POST['title']);
                                                $ndesc = mysqli_real_escape_string($controller->model->mysqli, $_POST['desc']);
                                                $types = mysqli_real_escape_string($controller->model->mysqli, $_POST['types']);
                                                $time = mysqli_real_escape_string($controller->model->mysqli, $_POST['time']);
                                                $isbreaking = 'no';
                                                if(isset($_POST['isbreaking']))
                                                    $isbreaking = mysqli_real_escape_string($controller->model->mysqli, $_POST['isbreaking']);
                                                
                                                $ncolumns = "postId, title, description, newsTypeId, isBreakingNews, tobeaired";
                                                $nvalues = "'$id', '$ntitle', '$ndesc', '$types', '$isbreaking', '$time'";
                                                
                                                $updatencolumns = "title = '$ntitle', description = '$ndesc', newsTypeId = '$types', isBreakingNews = '$isbreaking'";
                                                
                                                $check_updt = $controller->getindividual("postupdate", "postId", $id);
                                                
                                                if(count($check_updt) > 0)
                                                {
                                                    $controller->update("postupdate", $updatencolumns, "postId", $id, "incoming?detail=$id");
                
                                                    //$columns_post = "status = 'selected'";
                                                    //$controller->update("posts", $columns_post, "id", $id, "incoming?detail=$id");
                                                }
                                                else
                                                {
                                                    $controller->insert("postupdate", $ncolumns, $nvalues, "incoming?detail=$id");
                
                                                    $columns_post = "status = 'selected'";
                
                                                    $controller->update("posts", $columns_post, "id", $id, "incoming?detail=$id");
                                                }
                                            }
                                            
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
                                        <?php
                                        $isbreaking = '';
                                        $typ = '';
                                        $get_editednews = $controller->getindividual("postupdate", "postId", $id);
                                        foreach($get_editednews as $newsupdt)
                                        {
                                            $title = $newsupdt->title;
                                            $desc = $newsupdt->description;
                                            $typ = $newsupdt->newsTypeId;
                                            $isbreaking = $newsupdt->isBreakingNews;
                                            $toair = $newsupdt->tobeaired;
                                        }
                                        
                                        if(isset($_GET['edit']))
                                        {
                                            
                                            ?>
                                            <form action="" method="post">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" placeholder="Title" name="title" class="form-control" value="<?php echo $title;?>" /> 
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Main news bulleting</label>
                                                    <textarea id="editor" placeholder="Description" name="desc" class="form-control" /><?php echo $desc;?></textarea> 
                                                </div>
                                                
                                                <div class="form-group">
                                                    <?php
                                                        $types = $controller->getdata("newstypes", "id", "asc");
                                                        ?>
                                                        <label class="control-label" for="types">News type <span class="required">*</span>
                                                        </label>
                                                    <select name="types" class="select2 form-control" required id="types" required>
                                                        <option value="">Select Option</option>
                                                        <?php
                                                        foreach($types as $type)
                                                        {
                                                            ?>
                                                            <option value="<?php echo $type->id;?>" <?php if($type->id == $typ) echo "selected";?>><?php echo $type->newsTypeName;?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label style="cursor:pointer"><input type="checkbox" id="check-all" class="flat" name="isbreaking" <?php if($isbreaking == 'yes') echo 'checked';?> value="yes"> Is Breaking News</label>
                                                </div>
                                        
                                                <script type="text/javascript">
                                                    CKEDITOR.replace("editor");
                                                </script>
                
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-7">
                                                            <?php
                                                            $times = $controller->getdata("newstime", "id", "asc");
                                                            ?>
                                                            <label class="control-label" for="time">News time <span class="required">*</span>
                                                            </label>
                                                        <select name="time" class="select2 form-control" required id="time">
                                                            <option value="">Select Option</option>
                                                            <?php
                                                            foreach($times as $tm)
                                                            {
                                                                ?>
                                                                <option value="<?php echo $tm->id;?>" <?php if($tm->id == $toair) echo "selected";?>><?php echo $tm->timeLabel;?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div class="clearfix"></div>
                                                <hr />
                                                <div class="pull-right">
                                                    <button type="submit" name="editnews" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Save changes</button>
                                                    <a href="?detail=<?php echo $id;?>" class="btn btn-danger btn-flat"><i class="fa fa-times"></i> Cancel</a>
                                                    
                                                </div>
                                            </form>
                                            <?php
                                        }else{
                                        ?>
                                        <div class="form-group">
                                            <label>Title:</label> <?php echo $title;?>
                                        </div>
                                        <div class="form-group">
                                            <label>Main news bulleting:</label> <?php echo $desc;?>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="pull-right">
                                            <a href="?detail=<?php echo $id;?>&edit" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-edit"></i> Edit news</a>
                                            
                                        </div>
                                        <?php
                                        }
                                        ?>
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
                                        
                                        <hr>
                                        <div class="form-group">
                                            <a href="<?php echo $url;?>" class="btn btn-danger btn-flat"><i class="fa fa-times"></i> Close</a>
                                        </div>
                                        
                                        <div class="modal fade" id="video-play<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <b><i class="fa fa-info-circle"> </i>  <?php echo $data->title;?> - Video</b>
                                                    </div>
                                                    <div class="modal-body">
                                                        <video width="100%" height="240" controls>
                                                        <source src="<?php echo $video;?>" type="video/mp4">
                                                        <source src="<?php echo $video;?>" type="video/3gp">
                                                        Your browser does not support the video tag.
                                                        </video>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-times"> </i> Cancel</button>
                                                        <a href="<?php echo $video;?>" class="btn btn-success btn-ok btn-flat"><i class="fa fa-download"> </i> Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="modal fade" id="audio-play<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <b><i class="fa fa-info-circle"> </i> <?php echo $data->title;?> - Audio</b>
                                                    </div>
                                                    <div class="modal-body">
                                                        <audio controls>
                                                        <!--<source src="horse.ogg" type="audio/ogg">-->
                                                        
                                                        <source src="<?php echo $audio;?>" type="audio/ogg">
                                                        <source src="<?php echo $audio;?>" type="audio/amr">
                                                        Your browser does not support the audio element.
                                                        </audio>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-times"> </i> Cancel</button>
                                                        <a href="<?php echo $audio;?>" class="btn btn-success btn-ok btn-flat"><i class="fa fa-download"> </i> Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="modal fade" id="img<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <b><i class="fa fa-info-circle"> </i> <?php echo $data->title;?> - Image</b>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="<?php echo $imgurl;?>" class="img-responsive">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-times"> </i> Cancel</button>
                                                        <a href="<?php echo $imgurl;?>" class="btn btn-success btn-ok btn-flat"><i class="fa fa-download"> </i> Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="modal fade" id="editnews" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <b><i class="fa fa-info-circle"> </i>  <?php echo $data->title;?> - Update</b>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post">
                                                            <div class="form-group">
                                                                <label for="title">Title</label>
                                                                <input type="text" placeholder="Title" class="form-control" name="title" value="<?php echo $title;?>" id="title">
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="desc">Description</label>
                                                                <textarea placeholder="Description" class="form-control" name="desc" id="desc"><?php echo $desc;?></textarea>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-times"> </i> Cancel</button>
                                                        <button type="submit" class="btn btn-success btn-ok btn-flat" name="update"><i class="fa fa-check"> </i> Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }else{
                                            ?>
                                            <h2>No news selected</h2>
                                            <?php
                                        }
                                        ?>
                                    </div><div class="clearfix"></div>
                                    <!-- /.box-body -->
                                </div><div class="clearfix"></div>
                                <!-- /.box -->
                                    
                                </div>
                                <!-- /.col -->
                                <div class="clearfix"></div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                            <h2>Waiting for public news</h2>
                            </div>
                            <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    </div>
                    </div>
                    </div>
                    
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
            
        <?php require_once('inc/footer.php');?>