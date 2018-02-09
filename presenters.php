<?php 
require_once 'inc/essentials.php';

$class = 'Controller';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php';  
    
    $table = "presenter";
    $pk = "id";
    $url = "presenters";

    if(isset($_GET['entry'])){
        $action_btn_name = "postnew";
        $action_btn_txt = "Save";

        $staff = '';
        $program = '';
        $nickname = '';

        if(isset($_GET['update'])){
            $updateid = $_GET['update'];

            $get_user = $controller->getindividual($table, $pk, $updateid);

            foreach($get_user as $data)
            {
                $staff = $data->staffid;
                $program = $data->progid;
                $nickname = $data->nickname;
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
                    Presenters
                    <small>Preview Page</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Presenters</li>
               
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <?php
                if(isset($_GET['entry']))
                {
                    if(isset($_POST['postnew'])){
                        $staff = $_POST['staff'];
                        $prog = $_POST['prog'];
                        $nickname = $_POST['nickname'];
                        
                        $columns = "staffid, progid, nickname";
                        $values = "'$staff', '$prog', '$nickname'";
                        
                        $controller->insert($table, $columns, $values, $url);
                            
                        
                    }
                    
                    if(isset($_POST['update'])){
                        $staff = $_POST['staff'];
                        $prog = $_POST['prog'];
                        $nickname = $_POST['nickname'];
                        
                        
                        $columns = "staffid = '$staff', progid = '$prog', nickname = '$nickname'";
                        
                        $controller->update($table, $columns, $pk, $updateid, $url);
                        
                        
                    }

                    ?>
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <div class="input-group">
                                    <?php
                                    $get_staff = $controller->getdata("staff");
                                    ?>
                                    <span class="input-group-addon">Staff</span>
                                    <select name="staff" required class="form-control">
                                        <option value="">Select Staff</option>
                                        <?php
                                        foreach($get_staff as $staf){
                                            ?>
                                            <option value="<?php echo $staf->id;?>" <?php if($staf->id == $staff) echo "selected";?>><?php echo $staf->fname.' '.$staf->sname;?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="input-group">
                                    <?php
                                    $get_programme = $controller->getdata("programme");
                                    ?>
                                    <span class="input-group-addon">Programme</span>
                                    <select name="prog" required class="form-control">
                                        <option value="">Select program</option>
                                        <?php
                                        foreach($get_programme as $pro){
                                            ?>
                                            <option value="<?php echo $pro->id;?>" <?php if($pro->id == $program) echo "selected";?>><?php echo $pro->name;?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Nickname</span>
                                    <input type="text" name="nickname" class="form-control" required value="<?php echo $nickname;?>" placeholder="Nickname">
                                    
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
                    <div class="col-xs-3"><a class="btn btn-block btn-primary no-print" href="?entry"><i class="fa fa-pencil"></i> Add a new presenter</a>
                    </div>
                    
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12">
                        
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">All presenters</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Staff</th>
                                            <th>Programme</th>
                                            <th>Nickname</th>
                                            <th class="no-print">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $count = 0;
                                        $user_datas = $controller->getdata($table);
                                        foreach($user_datas as $data){
                                            $count++;
                                            
                                            
                                            $id = $data->id;
                                            $staff = $data->staffid;
                                            $prog = $data->progid;
                                            $nickname = $data->nickname;

                                            $stafnam = '';
                                            $get_staff = $controller->getindividual("staff", "id", $staff);
                                            foreach($get_staff as $staf){
                                                $stafnam = $staf->fname.' '.$staf->sname;
                                            }

                                            $prognam = '';
                                            $get_program = $controller->getindividual("programme", "id", $prog);
                                            foreach($get_program as $program){
                                                $prognam = $program->name;
                                            }
                                            
                                    ?>
                                        <tr>
                                            <td ><?php echo $count;?></td>
                                            <td ><?php echo $stafnam;?></td>
                                            <td ><?php echo $prognam;?></td>
                                            <td ><?php echo $nickname;?></td>
                                            <td class="no-print"><a href="?entry&update=<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure you want to delete <?php echo $fname;?>');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>
                                        </tr>
                                        
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Staff</th>
                                            <th>Programme</th>
                                            <th>Nickname</th>
                                            <th class="no-print">Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <br><br>
                                <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
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