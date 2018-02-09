<?php require_once('inc/head.php'); ?>
    
    	<?php require_once('inc/top.php'); ?>
        
        <?php require_once('inc/sidebar.php'); ?>
                

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Clients
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Clients</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                	<?php
					if(isset($_GET['client']) and isset($_GET['account']))
					{
						$clid = $_GET['client'];
						$acc = $_GET['account'];
						
						$query = "SELECT * FROM client_account WHERE autoId = '$clid'";
						
						$client_datas = getcustom($query);
						
						foreach($client_datas as $cdata):
							$fname = $cdata->lastName;
							$sname = $cdata->surName;
							$famname = $cdata->familyName;
							$accno = $cdata->accountNumber;
							$gender = $cdata->gender;
							$status = $cdata->maritalStatus;
							$title = $cdata->title;
							$type = $cdata->idType;
							$idno = $cdata->idNo;
							$dob = $cdata->dateOfBirth;
							$pob = $cdata->placeOfBirth;
							$nation = $cdata->Nationality;
							$resid = $cdata->CountryOfResidence;
							$photo = $cdata->clientphoto;
							$clientid = $cdata->idPhotoCopyUrl;
						endforeach;
						?>
                        <div class="row">
                        	<div class="col-sm-9 col-xs-12">
                            
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title"><?php echo $fname. ' ' .$sname;?> Personal Information</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body table-responsive">
                                    	<div class="row">
                                        	<div class="col-lg-6">
                                                <label>Name: </label> <?php echo $fname. ' ' .$sname;?>
                                                <hr>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <label>Account Number: </label> <?php echo $accno;?>
                                                <hr>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                        	<div class="col-lg-6">
                                                <label>Gender: </label> <?php echo $gender;?>
                                                <hr>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <label>Marital Status: </label> <?php echo $status;?>
                                                <hr>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row">
                                        	<div class="col-lg-6">
                                                <label>Title: </label> <?php echo $title;?>
                                                <hr>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <label>Id Type: </label> <?php echo $type;?>
                                                <hr>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                        	<div class="col-lg-6">
                                                <label>Id Number: </label> <?php echo $idno;?>
                                                <hr>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <label>Date of Birth: </label> <?php echo $dob;?>
                                                <hr>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row">
                                        	<div class="col-lg-6">
                                                <label>Place of Birth: </label> <?php echo $pob;?>
                                                <hr>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <label>Nationality: </label> <?php echo $nation;?>
                                                <hr>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row">
                                        	<div class="col-lg-6">
                                        		<label>Country of Residence: </label> <?php echo $resid;?>
                                        	</div>
                                        </div>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                                
                                <div class="box">
                                	<?php
									$query1 = "SELECT * FROM addressdetail WHERE accountNumber = '$acc'";
						
									$address_datas = getcustom($query1);
									
									if(count($address_datas) < 1)
									{
										?>
                                        <div class="box-header">
                                            <h3 class="box-title"><i>No Address Information found</i></h3>
                                        </div><!-- /.box-header -->
                                        
                                        <?php
									}
									else
									{
										foreach($address_datas as $adata):
											$lc = $adata->lc_zone;
											$parish = $adata->parish;
											$district = $adata->district;
											$region = $adata->region;
											$email_ad = $adata->email_address;
											$pobox = $adata->poBox;
											$pcode = $adata->postalcode;
											$mobile = $adata->mobile;
											$wrktl = $adata->worktel;
										endforeach;
									
						
									?>
                                    <div class="box-header">
                                        <h3 class="box-title">Address Information</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body table-responsive">
                                    	<div class="row">
                                        	<div class="col-lg-6">
                                                <label>LC Zone: </label> <?php echo $lc;?>
                                                <hr>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <label>Parish: </label> <?php echo $parish;?>
                                                <hr>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                        	<div class="col-lg-6">
                                                <label>District: </label> <?php echo $district;?>
                                                <hr>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <label>Region: </label> <?php echo $region;?>
                                                <hr>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row">
                                        	<div class="col-lg-6">
                                                <label>Email: </label> <?php echo $email_ad;?>
                                                <hr>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <label>P.O. Box: </label> <?php echo $pobox;?>
                                                <hr>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                        	<div class="col-lg-6">
                                                <label>Postal Code: </label> <?php echo $pcode;?>
                                                <hr>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <label>Mobile: </label> <?php echo $mobile;?>
                                                <hr>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row">
                                        	<div class="col-lg-6">
                                                <label>Work Telephone: </label> <?php echo $wrktl;?>
                                                
                                            </div>
                                            
                                        </div>
                                    </div><!-- /.box-body -->
                                    <?php
									}
									?>
                                </div><!-- /.box -->
                                
                                <div class="box">
                                	<?php
									$query_next = "SELECT * FROM client_nextofkin WHERE accountNumber = '$acc'";
						
									$next_datas = getcustom($query_next);
									
									if(count($next_datas) < 1)
									{
										?>
                                        <div class="box-header">
                                            <h3 class="box-title"><i>No Next of Kin Information Found</i></h3>
                                        </div><!-- /.box-header -->
                                        
                                        <?php
									}
									else
									{
										foreach($next_datas as $ndata):
											$name = $ndata->name;
											$contact = $ndata->contact;
											$relation = $ndata->relationship;
											$idtype = $ndata->idType;
											$idnum = $ndata->idNo;
											$idcopy = $ndata->idphotoCopyUrl;
										endforeach;
									
						
									?>
                                    <div class="box-header">
                                        <h3 class="box-title">Next of Kin Information</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body table-responsive">
                                    	<div class="row">
                                        	<div class="col-lg-6">
                                                <label>Name: </label> <?php echo $name;?>
                                                <hr>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <label>Contact: </label> <?php echo $contact;?>
                                                <hr>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                        	<div class="col-lg-6">
                                                <label>Relationship: </label> <?php echo $relation;?>
                                                <hr>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <label>Id Type: </label> <?php echo $idtype;?>
                                                <hr>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row">
                                        	<div class="col-lg-6">
                                                <label>Id Number: </label> <?php echo $idnum;?>
                                                
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <?php
									}
									?>
                                </div><!-- /.box -->
                                
                            </div>
                            
                            <div class="col-sm-3 col-xs-12">
                            
                                <div class="box">
                                    <div class="box-header">
                                        
                                    </div><!-- /.box-header -->
                                    <div class="box-body table-responsive">
                                    	<img src="<?php echo $photo;?>" class="img-responsive">
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                                
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Client id copy</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body table-responsive">
                                    	<img src="<?php echo $clientid;?>" class="img-responsive">
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                                
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Next of kin id copy</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body table-responsive">
                                    	<img src="<?php echo $idcopy;?>" class="img-responsive">
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                                
                                <div class="clearfix"></div>
                                <hr>
                                <a href="clients.php" class="btn btn-danger"><i class="fa fa-times"></i> Close View</a>
                            </div>
                        </div>
                        <?php
					}
					else{
					
						
						if(isset($_GET['delete']))
						{
							$delid = $_GET['delete'];
							$table = 'client_account';
							$pk = 'autoId';
							$redirect = 'clients.php';
							
							delete($table, $pk, $delid, $redirect);
						}
							
						
					?>
                    <div class="row">
                        <div class="col-xs-12">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">All clients</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th>First name</th>
                                                <th>Last name</th>
                                                <th>Family Name</th>
                                                <th>Account</th>
                                                <th>Gender</th>
                                                <th>Marital Status</th>
                                                <th>Title</th>
                                                <th class="no-print">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
											$count = 0;
											$user_datas = getAllData("client_account");
											foreach($user_datas as $data){
												$count++;
												
												
												$id = $data->autoId;
												$fname = $data->lastName;
												$sname = $data->surName;
												$famname = $data->familyName;
												$account = $data->accountNumber;
												$gender = $data->gender;
												$marital = $data->maritalStatus;
												$title = $data->title;
												$idtype = $data->idType;
												$photo = $data->clientphoto;
												
										?>
                                            <tr>
                                            	<td ><?php echo $count;?></td>
                                                <td ><?php echo $fname;?></td>
                                                <td ><?php echo $sname;?></td>
                                                <td ><?php echo $famname;?></td>
                                                <td ><?php echo $account;?></td>
                                                <td ><?php echo $gender;?></td>
                                                <td><?php echo $marital;?></td>
                                                <td><?php echo $title;?></td>
                                                <td class="no-print"><a href="?client=<?php echo $id;?>&account=<?php echo $account;?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i> View details</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure to delete <?php echo $fname;?>');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>
                                            </tr>
                                            
                                            <?php
											}
											?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            	<th>#</th>
                                                <th>First name</th>
                                                <th>Last name</th>
                                                <th>Family Name</th>
                                                <th>Account</th>
                                                <th>Gender</th>
                                                <th>Marital Status</th>
                                                <th>Title</th>
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