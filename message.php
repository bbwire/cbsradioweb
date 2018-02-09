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
                        Message
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Message</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                	<?php
					
					if(isset($_POST['post'])){
						$subject = $_POST['subject'];
						$message = $_POST['message'];
						
						$message_body = "Subject: ". $subject;
						$message_body .= " Message: ". $message;
						$sender = 'Ssubiryo';
						
						$contacts = getAllData('addressdetail');
						
						$count = 0;
						
						foreach($contacts as $contact):
							$phone = $contact->mobile;
							$count = $count+1;
							
							$res = send_new_sms($sender, $phone, $message_body);
						endforeach;
						
						if ($res) 
					   {
						   $used_amount = ($count_num*SMS_RATE);
							
						   Alert("alert-success", "Message has been sent to ". $count ." contacts. amount used is UGX. ". $used_amount);
						   
						   Redirect($redirect);
					   }
					   else
					   {
							Alert("alert-danger", "Message not sent ");
							Redirect($redirect);
					   }
						
					}
					?>
                    <div class="row">
                        <div class="col-xs-12">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Compose message to send</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <form action="#" method="post">
                                        <div class="modal-body">
                                                                                
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Subject</span>
                                                    <input type="text" name="subject" required class="form-control" placeholder="Enter subject">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <textarea name="message" required class="form-control" style="height:200px;" placeholder="Enter message"></textarea>
                                                
                                            </div>
                                        </div>
                                        <div class="modal-footer clearfix">
                
                                            <button type="submit" name="post" class="btn btn-primary pull-left"><i class="fa fa-forward"></i> Send Message</button>
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