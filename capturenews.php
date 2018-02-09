<?php 
require_once 'inc/essentials.php';

$class = 'SettingsController';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
        
$page_title = 'Captured news';
$table = 'posts';
$primary_key = 'id';
$url = 'capturenews';
	
if(isset($_GET['entry']))
{
	$page_title = 'Capture news';
	$action_btn_name = 'postnew';
	$action_btn_txt = 'Save';
	$title = '';
    $desc = '';
    $postid = '';
    $typeid = '';
    $tobeaired = '';
	
	if(isset($_GET['update']))
	{
		$updateid = $_GET['update'];
		
		$updatedatas = $controller->getindividual("postupdate", $primary_key, $updateid);
		
		foreach($updatedatas as $data)
		{
			$title = $data->title;
            $desc = $data->description;
            $postid = $data->postId;
            $typeid = $data->newsTypeId;
            $tobeaired = $data->tobeaired;
		}
		
		$page_title = 'Update news';
		$action_btn_name = 'update';
		$action_btn_txt = 'Save changes';
		
	}
}
        ?>
                
            <script>
                $(document).ready(function(){
                    var maxField = 10; //Input fields increment limitation
                    var addButton = $('.add_button'); //Add button selector
                    var wrapper = $('.addable-wrapper'); //Input field wrapper
                    var fieldHTML = '<div class="addable"><a href="javascript:void(0);" class="btn btn-danger btn-flat pull-right remove_button" title="Remove this form"><i class="fa fa-times"></i> Remove form</a><div class="form-group"><label for="title">Title</label> <input type="text" class="form-control" id="title" placeholder="Title" name="title[]"></div><div class="form-group"><label for="desc">Description</label><textarea class="form-control mceEditor" id="desc" placeholder="Description" style="height:150px;" name="desc[]"></textarea></div><div class="form-group"><?php $types = $controller->getdata("newstypes", "id", "asc");?><label class="control-label" for="newstype">News type <span class="required">*</span></label><select name="newstype[]" class="select2 form-control" required id="newstype" required><option value="">Select Option</option><?php foreach($types as $type){?><option value="<?php echo $type->id;?>"><?php echo $type->newsTypeName;?></option><?php }?></select></div><div class="form-group"><?php $times = $controller->getdata("newstime", "id", "asc");?><label class="control-label" for="time">News time <span class="required">*</span></label><select name="time[]" class="select2 form-control" required id="time"><option value="">Select Option</option><?php foreach($times as $tm){?><option value="<?php echo $tm->id;?>" ><?php echo $tm->timeLabel;?></option><?php }?></select></div><div class="form-group"><label for="pic">Picture</label><input type="file" class="form-control" name="pic[]" id="pic"></div><div class="form-group"><label for="audio">Audio</label><input type="file" class="form-control" name="audio[]" id="audio"></div><div class="form-group"><label for="video">Video</label><input type="file" class="form-control" name="video[]" id="video"></div><div class="clearfix"></div><hr></div>'; //New input field html 
                    var x = 1; //Initial field counter is 1
                    $(addButton).click(function(){ //Once add button is clicked
                        if(x <= maxField){ //Check maximum number of input fields
                            x++; //Increment field counter
                            $(wrapper).append(fieldHTML); // Add field html
                        }
                    });
                    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
                        e.preventDefault();
                        $(this).parent('div').remove(); //Remove field html
                        x--; //Decrement field counter
                    });
                });
            </script>
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
                                    <?php
                                    if(isset($_GET['entry']))
                                    {
                                        
                                        if(isset($_POST['postnew']))
                                        {
                                            $controller->postnews($url, $table);
                                            
                                            $user_columns = "user, eventdetails";
                                            $user_values = "'$uid', 'Captured news'";
                                        
                                            $controller->model->saveexcel("userlog", $user_columns, $user_values, "");
                                        }
                                        
                                        if(isset($_POST['update']))
                                        {
                                            $controller->updatenews($updateid, $url, $primary_key, "postupdate");
                                            
                                            $user_columns = "user, eventdetails";
                                            $user_values = "'$uid', 'Updated captured news'";
                                        
                                            $controller->model->saveexcel("userlog", $user_columns, $user_values, "");
                                        }                                    
                                        ?>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="addable-wrapper">
                                                <div class="addable">
                                                    <div class="form-group">
                                                        <label for="title">Title</label> 
                                                        <input type="text" class="form-control" id="title" value="<?php echo $title;?>" placeholder="Title"  name="title[]">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="desc">Description</label>
                                                        <textarea class="form-control mceEditor" id="desc" placeholder="Description" style="height:150px;" name="desc[]"><?php echo $desc;?></textarea>
                                                        <input type="hidden" name="uid" value="<?php echo $uid;?>" />
                                                        <input type="hidden" name="postid" value="<?php echo $postid;?>" />
                                                    </div>
                                                    <div class="form-group">
                                                        <?php
                                                        $types = $controller->getdata("newstypes", "id", "asc");
                                                        ?>
                                                        <label class="control-label" for="newstype">News type <span class="required">*</span>
                                                        </label>
                                                        <select name="newstype[]" class="select2 form-control" required id="newstype" required>
                                                            <option value="">Select Option</option>
                                                            <?php
                                                            foreach($types as $type)
                                                            {
                                                                ?>
                                                                <option value="<?php echo $type->id;?>" <?php if($type->id == $typeid) echo "selected";?>><?php echo $type->newsTypeName;?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <?php
                                                        $times = $controller->getdata("newstime", "id", "asc");
                                                        ?>
                                                        <label class="control-label" for="time">News time <span class="required">*</span>
                                                        </label>
                                                        <select name="time[]" class="select2 form-control" required id="time">
                                                            <option value="">Select Option</option>
                                                            <?php
                                                            foreach($times as $tm)
                                                            {
                                                                ?>
                                                                <option value="<?php echo $tm->id;?>" <?php if($tm->id == $tobeaired) echo "selected";?>><?php echo $tm->timeLabel;?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="pic">Picture</label>
                                                        <a class="preview" data-toggle="tooltip" data-html="true" data-placement="bottom" title="<img  id='blah' src='#'>"><input type="file" class="form-control" name="pic[]" id="imgInp"></a>
														<div class="imgpath" style="display:none;"></div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="audio">Audio</label>
                                                        <input type="file" class="form-control" name="audio[]" id="audio">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="video">Video</label>
                                                        <input type="file" class="form-control" name="video[]" id="video">
                                                    </div>
                                                        <?php if(isset($_GET['update'])){}else{?><div> <a href="javascript:void(0);" title="Add another form" class="btn btn-success btn-flat pull-right add_button"><i class="fa fa-plus"></i> Add a form</a></div><?php }?>
                                                </div>
                                                <div class="clearfix"></div>
                                                <hr>
                                            </div>
                                            <div class="form-group">
                                                
                                                <button type="submit" class="btn btn-primary btn-flat" id="fname" placeholder="First name" name="<?php echo $action_btn_name;?>"><i class="fa fa-check"></i> <?php echo $action_btn_txt;?></button>
                                                <a href="<?php echo $url;?>" class="btn btn-danger btn-flat pull-right"><i class="fa fa-times"></i> Cancel</a>
                                            </div>
                                        </form>
                                        <?php
                                    }
                                    else
                                    {
                                        
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
                                    
                                    if(isset($_GET['delete'])){
                                            
                                        $key_value = $_GET['delete'];
                                        
                                        $controller->delete("postupdate", $primary_key, $key_value, $url);
                                    }
                                    ?>
                                    <div class="col-xs-12 pull-right">
                                        <a href="?entry" class="btn btn-primary btn-flat pull-right"><i class="fa fa-plus"></i> Capture news</a>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <form action="" method="post" name="form1" onSubmit="return delete_confirm();">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Manage</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $datas = $controller->getcustomdata("select pu.id, pu.newsTypeId, pu.tobeaired, pu.title, pu.description, p.user, p.date, p.status from posts p INNER JOIN postupdate pu ON pu.postId = p.id ORDER BY pu.id desc", "user", $uid);
                                    
                                    $count = 0;
                                    foreach($datas as $data)
                                    {
                                        $id = $data->id;
                                        $title = $data->title;
                                        $desc = $data->description;
                                        $datetime = $data->date;
                                        $time_elapsed = $controller->time_elapsed_string($datetime, false);
                                        $count++;
										
										$display_words = trunc($desc, 20);
                                        
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" class="table_records flat" name="ids[]" value="<?php echo $id;?>" title="<?php echo $title;?>"></td>
                                        <td><?php echo $count;?></td>
                                        <td><?php echo $title;?></td>
                                        <td><?php echo $display_words;?></td>
                                        <td> <?php echo $time_elapsed;?></td>
                                        <td><?php echo $data->status;?></td>
                                        <td><a href="?entry&update=<?php echo $id;?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a> <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#confirm-delete<?php echo $id;?>"><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                    
                                    <div class="modal fade" id="confirm-delete<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <b><i class="fa fa-info-circle"> </i> Confirm Delete</b>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this record?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"> </i> Cancel</button>
                                                        <a href="?delete=<?php echo $id;?>" class="btn btn-success btn-ok"><i class="fa fa-check"> </i> OK</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Manage</th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <div class="clearfix"></div>
                                <hr />
                                <button type="submit" class="btn btn-danger btn-flat" name="deletemulti" id="delete_multiple"><i class="fa fa-trash"></i> Delete multiple Records</button>
                                        
                                </form>
                                <div class="clearfix"></div>
                                <?php
                                    }
                                ?>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        
                  
        <?php require_once('inc/footer.php');?>