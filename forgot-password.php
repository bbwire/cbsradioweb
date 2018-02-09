<?php
ob_start();
session_start();
$mysql = new mysqli("localhost","root","","bana");

?>
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Bana - Forgot password</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
        	<?php

			if($_POST){
				$phone = $_POST['phone'];


				$check_user = $mysql->query("select * from users where phone_number='$phone'");

				if($check_user){

					$num = $check_user->num_rows;

					if($num==1){

						function generateRandomString($length = 10) {
							$characters = './#\,0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							$charactersLength = strlen($characters);
							$randomString = '';
							for ($i = 0; $i < $length; $i++) {
								$randomString .= $characters[rand(0, $charactersLength - 1)];
							}
							return $randomString;
						}
						$row = mysqli_fetch_array($check_user,MYSQL_ASSOC);
						$id = $row['userId'];
						$fn = $row['First_Name'];
						$ln = $row['Other_Names'];
						$n = $fn.' '.$ln;

						$pas = generateRandomString();
						$random = md5($pas);

						$updt = $mysql->query("update users set Password='$random' where phone_number='$phone'");

						?>
                        <div class="alert alert-success alert-dismissable">
                            <i class="fa fa-check"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            Hi, <b><?php echo $n;?></b>, Your temporary password is : <b><?php echo $pas;?></b>, use this to <a href="login.php">login</a>.
                        </div>
                        <?php

					}else{
						?>
                        <div class="alert alert-danger alert-dismissable">
                            <i class="fa fa-ban"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <b>Oops!</b> The phone number you provided looks to be invalid, you can try again.
                        </div>
                        <?php
						header("refresh:2; url=forgot-password.php");
					}

				}else{
					?>
                    <div class="alert alert-danger alert-dismissable">
                        <i class="fa fa-ban"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <b>Oops!</b> We have encountered a database error.<?php echo $mysql->error;?>
                    </div>
                    <?php
					header("refresh:10; url=forgot-password.php");
				}


			?>

            <?php
			}else{
			?>
            <div class="header">Forgot password?</div>
            <form action="" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="phone" class="form-control" required placeholder="Enter your account's phone number here"/>
                    </div>
                    <div class="form-group">
                        Just provide us with your account phone number, we will provide you with a temporary password which you can change after login
                    </div>
                </div>
                <div class="footer">
                    <button type="submit" class="btn bg-olive btn-block">Get a temporary password</button>

                    <p><a href="login.php">Go back to login</a></p>
                </div>
            </form>

            <!--<div class="margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div>-->
            <?php }?>
        </div>


        <!-- jQuery 2.0.2
        <script src="js/jquery.min.js"></script>-->
        <script src="js/jquery-1.7.1.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>
