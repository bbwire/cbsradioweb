<?php 
require_once 'inc/essentials.php';

$class = 'Controller';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
        
        $table = "orders";
        $placedtable = "placed_bids";
        $pk = "id";
        $url = "reports";
        $path_url = "http://ulvcloud.com/cbsradioweb/";

        
        ?>
            <style>
				
			</style>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Reports
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Reports</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content reports">
                    <!-- Custom Tabs -->
                    <?php
                    if(isset($_GET['entry']))
                    {
                    }
                    else{
					
						
						
						if(isset($_GET['delete'])){
							
							$del = $_GET['delete'];
							
							$controller->delete($table, $pk, $del, $url);
							
						}
					?>
                    <div class="studio">
                        <ul class="nav nav-tabs tab-header material-tab">
                            <li class="active"><a href="#account_statements" data-toggle="tab">Account Statements</a></li>
                            <li><a href="#stockaccounting" data-toggle="tab">Stock Accounting</a></li>
                            <li><a href="#orderreports" data-toggle="tab">Graphs</a></li>
                            <!--<li><a href="#tab_2" data-toggle="tab">Rejected Bids <small class="badge pull-right bg-green">0</small></a></li>-->
                            
                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                        </ul>
                        <div class="tab-content">
                        <div class="tab-pane active" id="account_statements">
							<div class="clearfix"></div>
							<hr>
							<form >
								<div class="row">
								<div class="col-sm-3">
									<div class="form-group">
									  <select class="selectpicker form-control" data-show-subtext="true" data-live-search="true" name="type">
										<option value="" selected data-hidden="true">Select shop to generate report</option>
										<?php 
										$get_shops = $controller->getdata("shops", "id", "asc");
										
										foreach($get_shops as $data){
											?>
											<option value="<?php echo $data->id;?>" ><?php echo $data->name;?></option>
											<?php
										}
										?>
									  </select>
									</div>
								</div>
								
								<div class="col-sm-3">
									<div class="form-group">
									  <button type="submit" name="reports" class="btn btn-primary">Go</button>
									</div>
								</div>
								</div>
							</form>
							<div class="clearfix"></div>
                            <hr>   
                                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                    <a href="#"><div class="box small">
                                        <!--<div class="box-icon">
                                            <span class="fa fa-4x fa-css3"></span>
                                        </div>-->
                                        <div class="info">
                                            <h5 class="text-center">DUE AND UNPAID</h5>
											<h5 class="text-center black">0 UGX</h5>
                                            <!--<p>nulla dolore necessitatibus doloremque exercitationem sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!</p>
                                            <a href="" class="btn">Link</a>-->
                                        </div>
                                    </div></a>
                                </div>
                                
                                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                    <a href="#"><div class="box small">
                                        <!--<div class="box-icon">
                                            <span class="fa fa-4x fa-css3"></span>
                                        </div>-->
                                        <div class="info">
                                            <h5 class="text-center">OPEN STATEMENT</h5>
											<h5 class="text-center black">0 UGX</h5>
                                            <!--<p>nulla dolore necessitatibus doloremque exercitationem sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!</p>
                                            <a href="" class="btn">Link</a>-->
                                        </div>
                                    </div></a>
                                </div>
								
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                    <a href="#"><div class="box small">
                                        <!--<div class="box-icon">
                                            <span class="fa fa-4x fa-css3"></span>
                                        </div>-->
                                        <div class="info">
                                            <h5 class="text-center">PENDING TRANSACTIONS</h5>
											<h5 class="text-center black">0 UGX</h5>
                                            <!--<p>nulla dolore necessitatibus doloremque exercitationem sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!</p>
                                            <a href="" class="btn">Link</a>-->
                                        </div>
                                    </div></a>
                                </div>
                                
                                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                    <a href="#"><div class="box small">
                                        <!--<div class="box-icon">
                                            <span class="fa fa-4x fa-css3"></span>
                                        </div>-->
                                        <div class="info">
                                            <h5 class="text-center">PAID IN THE LAST THREE MONTHS</h5>
											<h5 class="text-center black">0 UGX</h5>
                                            <!--<p>nulla dolore necessitatibus doloremque exercitationem sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!</p>
                                            <a href="" class="btn">Link</a>-->
                                        </div>
                                    </div></a>
                                </div>
								
								<div class="clearfix"></div>
								
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 summary">
									<!--<div class="box-icon">
										<span class="fa fa-4x fa-css3"></span>
									</div>-->
									<!-- Nav tabs -->
									<div class="card">
										<ul class="nav nav-tabs" role="tablist">
											<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">All</a></li>
											<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Open</a></li>
											<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Paid</a></li>
											<li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Unpaid</a></li>
										</ul>

										<!-- Tab panes -->
										<div class="tab-content">
											<div role="tabpanel" class="tab-pane active" id="home">
												<div class="col-sm-6">
													<h5>PERIOD</h5>
													<hr>
													<p>
														07 Feb 2018 - 09 Feb 2018 
Current statement
													</p>
												</div>
												<div class="col-sm-6">
													<h5>PAYOUT</h5>
													<hr>
													<p>
														0.00 UGX
													</p>
												</div>
												
												<div class="clearfix"></div>
											</div>
											<div role="tabpanel" class="tab-pane" id="profile">
												<div class="col-sm-6">
													<h5>PERIOD</h5>
													<hr>
													<p>
														07 Feb 2018 - 09 Feb 2018 
Current statement
													</p>
												</div>
												<div class="col-sm-6">
													<h5>PAYOUT</h5>
													<hr>
													<p>
														0.00 UGX
													</p>
												</div>
												<div class="clearfix"></div>
											</div>
											<div role="tabpanel" class="tab-pane" id="messages">
												<div class="col-sm-6">PERIOD</div>
												<div class="col-sm-6">PAYOUT</div>
											</div>
											<div role="tabpanel" class="tab-pane" id="settings">
												<div class="col-sm-6">PERIOD</div>
												<div class="col-sm-6">PAYOUT</div>
											</div>
										</div>
									</div>
                                </div>
								
								<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                    <div class="box big">
                                        <!--<div class="box-icon">
                                            <span class="fa fa-4x fa-css3"></span>
                                        </div>-->
                                        <div class="infos printableArea">
                                            <div class="col-sm-3">
											<h5 class="blacks">PERIOD</h5>
											07 Feb 2018 - 09 Feb 2018 
											</div>
											<div class="col-sm-3">
											<h5 class="blacks">STATUS</h5>
											Open
											</div>
											<div class="clearfix"></div>
											<br>
											<div class="col-sm-3">
												<h5><b>Opening Balance</b></h5>
											</div>
											<div class="col-sm-5">
												Negative closing balance from previous statements
											</div>
											<div class="col-sm-4">
												<div><p class="pull-right">0.00 UGX </p></div>
												<div class="clearfix"></div>
											</div>
											<br>
											<hr>
											
											<div class="col-sm-3">
												<h5><b>Orders</b></h5>
											</div>
											<div class="col-sm-5">
												<p>Sales Revenue </p>
												<p>Other Revenues </p>
												<p>Fees </p>
											</div>
											<div class="col-sm-4">
												<div><p class="pull-right">0.00 UGX </p></div>
												<div class="clearfix"></div>
												<div><p class="pull-right">0.00 UGX </p></div>
												<div class="clearfix"></div>
												<div><p class="pull-right">0.00 UGX </p></div>
												<div class="clearfix"></div>
												<hr>
												
												<div><span>Subtotal</span> <p class="pull-right">0.00 UGX </p></div>
												<div class="clearfix"></div>
											</div>
											<br>
											<div class="clearfix"></div>
											
											<div class="col-sm-3">
												<h5><b>Refunds</b></h5>
											</div>
											<div class="col-sm-5">
												<p>Returned or Canceled orders </p>
												<p>Refund on fees </p>
											</div>
											<div class="col-sm-4">
												<div><p class="pull-right">0.00 UGX </p></div>
												<div class="clearfix"></div>
												<div><p class="pull-right">0.00 UGX </p></div>
												<div class="clearfix"></div>
												<hr>
												
												<div><span>Subtotal</span> <p class="pull-right">0.00 UGX </p></div>
												<div class="clearfix"></div>
											</div>
											<br>
											<div class="clearfix"></div>
											
											<div class="col-sm-3">
												<h5><b>Others</b></h5>
											</div>
											<div class="col-sm-5">
												<p>Others </p>
											</div>
											<div class="col-sm-4">
												<div><p class="pull-right">0.00 UGX </p></div>
												<div class="clearfix"></div>
												<hr>
												
												<div><span>Subtotal</span> <p class="pull-right">0.00 UGX </p></div>
												<div class="clearfix"></div>
											</div>
											<br>
											<div class="clearfix"></div>
											<hr>
											
											<div class="col-sm-3">
												<h5><b>Closing Balance</b></h5>
											</div>
											<div class="col-sm-5">
												<p>Total Balance </p>
											</div>
											<div class="col-sm-4">
												<div><p class="pull-right">0.00 UGX </p></div>
												<div class="clearfix"></div>
											</div>
											<br>
											<div class="clearfix"></div>
											<hr>
											<div class="col-sm-3">
												<h5><b>Payout</b></h5>
											</div>
											<div class="col-sm-5">
												
											</div>
											<div class="col-sm-4">
												<div><p class="pull-right"><b>0.00 UGX</b> </p></div>
												<div class="clearfix"></div>
											</div>
											<br>
											<div class="clearfix"></div>
											
                                            <!--<p>nulla dolore necessitatibus doloremque exercitationem sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!</p>
                                            <a href="" class="btn">Link</a>-->
											<div class="clearfix"></div>
                                        </div>
										<div class="clearfix"></div>
										<hr>
										<div >
											<a href="javascript:void(0);" id="printButton" class="btn btn-primary">Print</a> 
										</div>
                                    </div>
                                </div>
                                
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="stockaccounting">
                                <br>
                                <h4>Stock Accounting Summaries Here</h4>
                                
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="orderreports">
                                <br>
                                <hr>
                                <div id="chart_div"></div>
                                
                                
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="placedbids">
                                <br>
                                <table id="example2" class="table table-bordered table-striped items-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Bidder</th>
                                            <th>Bid id</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th class="no-print">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
                                        $bid_datas = $controller->getdata($placedtable, $pk, "asc");
                                        foreach($bid_datas as $data){
                                            $count++;
                                            
                                            
                                            $id = $data->id;
                                            $amount = $data->amount;
                                            $status = $data->status;
                                            $bidid = $data->bid_id;
                                            $userid = $data->user_id;

                                            $usernam = '';
                                            $get_users = $controller->getindividual("users", "id", $userid);
                                            foreach($get_users as $user){
                                                $usernam = $user->fname.' '.$user->lname;
                                            }
                                            
                                        ?>
                                        <tr>
                                            <td ><?php echo $count;?></td>
                                            <td ><?php echo $usernam;?></td>
                                            <td ><?php echo $bidid;?></td>
                                            <td ><?php echo $amount;?></td>
                                            <td ><?php echo $status;?></td>
                                            <td class="no-print"><a href="?entry&update=<?php echo $id;?>" style="cursor:pointer;" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> or <a href="?delete=<?php echo $id;?>" onClick="return confirm('Are you sure you want to delete this record?');" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>
                                        </tr>
                                        
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                        
                                </table>
                                
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                            <br><b>No Bids Yet</b>
                            
                            </div><!-- /.tab-pane -->
                        </div><!-- /.tab-content -->
                    </div><!-- nav-tabs-custom -->
                	 <?php
					}
					?>
                   
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <?php require_once('inc/footer.php');?>