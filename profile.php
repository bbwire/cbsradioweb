<?php 
require_once 'inc/essentials.php';

$class = 'UsersController';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 

$page_title = 'Profile';
$table = 'users';
$primary_key = 'id';
$url = 'profile';
		
$updatedatas = $controller->getindividual($table, $primary_key, $uid);

foreach($updatedatas as $data)
{
    $fname = $data->fname;
    $lname = $data->lname;
    $phone = $data->phone;
    $gender = $data->gender;
    $email = $data->email;
    $dob = $data->dob;
    $joindate = $data->joindate;
    $username = $data->username;
    $position = $data->position;
    $station = $data->station;
}

$action_btn_name = 'update';
$action_btn_txt = 'Save changes';
?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Hi <?php echo $name;?>, your profile
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Profile</li>

                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Your profile</h3>
                                </div><!-- /.box-header -->

                                <div class="box-body">
                                <?php
                                                        
                                    if(isset($_POST['update']))
                                    {
                                        $controller->updateprofile($uid, $url, $primary_key, $table);
                                    }
                                    
                                    if(isset($_POST['updatepas']))
                                    {
                                        $controller->updatepassword($uid, "logout", $primary_key, $table);
                                    }
                                
                                    ?>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="fname">First name</label>
                                            <input type="text" class="form-control" id="fname" value="<?php echo $fname;?>" required="required" placeholder="First name" name="fname">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="lname">Last name</label>
                                            <input type="text" class="form-control" id="lname" value="<?php echo $lname;?>" placeholder="Last name" required="required" name="lname">
                                        </div>
                                        <div class="item form-group">
                                        <?php
                                            $genders = array("Male", "Female");
                                            ?>
                                            <label class="control-label" for="gender">Sex <span class="required">*</span>
                                            </label>
                                        <select name="gender" class="select2 form-control" required id="gender" style="width: 100%;">
                                            <option value="">Select Option</option>
                                            <?php
                                            foreach($genders as $sex)
                                            {
                                                ?>
                                                <option <?php if($gender == $sex) echo "selected";?>><?php echo $sex;?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        
                                    </div>
                                        
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" required="required" id="phone" value="<?php echo $phone;?>" placeholder="Phone" name="phone">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" required="required" id="email" value="<?php echo $email;?>" placeholder="Email" name="email">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="dob">Date of birth</label>
                                            <input type="text" class="form-control" required="required" id="dob" value="<?php echo $dob;?>" placeholder="Date of birth" name="dob">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="pic">Change you profile picture</label>
                                            <input type="file" class="form-control" name="pic">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" required="required" id="username" placeholder="Username" value="<?php echo $username;?>" name="username">
                                        </div>
                                        <?php
                                        if(!isset($_GET['update'])){
                                        ?>
                                        
                                        <?php
                                        }
                                        ?>
                                        <hr>
                                        <div class="form-group">
                                            
                                            <button type="submit" class="btn btn-primary btn-flat" id="fname" placeholder="First name" name="<?php echo $action_btn_name;?>"><i class="fa fa-check"></i> <?php echo $action_btn_txt;?></button>
                                            
                                        </div>
                                    </form>
                                    
                                    <hr />
                                    <h3>Change your password</h3>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="password">New password</label>
                                            <input type="password" class="form-control" id="password" placeholder="Password" required="required" name="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="cpassword">Confirm password</label>
                                            <input type="password" class="form-control" id="cpassword" placeholder="Confirm password" required="required" name="cpassword">
                                        </div>
                                        <div class="form-group">
                                            
                                            <button type="submit" class="btn btn-primary btn-flat" id="pass" name="updatepas"><i class="fa fa-check"></i> Change password</button>
                                            
                                        </div>
                                    </form>
                                  
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <?php require_once('inc/footer.php');?>