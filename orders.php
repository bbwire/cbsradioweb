<?php 
require_once 'inc/essentials.php';

$class = 'UsersController';

require_once 'inc/head.php';
    
require_once 'inc/top.php'; 
        
require_once 'inc/sidebar.php'; 
        
$page_title = 'All Orders';
$table = 'orders';
$primary_key = 'id';
$url = 'orders';

if(isset($_GET['orderdetails']))
    $page_title = "Order Details (". $_GET['orderdetails'] .")";

$datas = $controller->getdata("orders", "id", "desc");
	
?>
                

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Orders
                        <small>Preview Page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Orders</li>
                   
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <?php
                    if(isset($_GET['orderdetails']))
                    {
                        $orderid = $_GET['orderdetails'];

                        ?>
                        <div class="row">
                            <div class="col-xs-12"><a class="btn btn-primary pull-right btn-flat no-print" href="<?php echo $url;?>"><i class="fa fa-long-arrow-left"></i> Back to all</a></div>
                        </div>
                        <hr>
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                            <tr>
                                <th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>
                            <th>#</th>
                            <th>Order Id</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $datas = $controller->getindividual("order_items", "order_id", $orderid);
                            
                            $count = 0;
                            foreach($datas as $data)
                            {
                                $id = $data->id;
                                $qty = $data->item_quantity;
                                $orderid = $data->order_id;
								$itemid = $data->item_id;
                                $count++;
                                
                                $itemnam = '';
                                $get_items = $controller->getindividual("items", "id", $itemid);
                                foreach($get_items as $item){
                                    $itemnam = $item->name;
                                }
                            ?>
                            <tr>
                                <td><input type="checkbox" class="table_records flat-red" name="ids[]" value="<?php echo $id;?>" title="<?php echo $data->fname.' '.$data->lname;?>"></td>
                            <td><?php echo $count;?></td>
                            <td><?php echo $orderid;?></td>
                            <td><?php echo $itemnam;?></td>
                            <td> <?php echo $qty;?></td>
                            <td><?php echo $data->status;?></td>
                            <td><a href="?orderdetails=<?php echo $id;?>" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a> <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#confirm-delete<?php echo $id;?>"><i class="fa fa-trash"></i></button></td>
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
                            <th>Order Id</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                        <?php
                    }else if(isset($_GET['salesinvoice']))
                    {
                        $orderid = $_GET['salesinvoice'];

                        ?>
                        <div class="row no-print">
                            <div class="col-xs-12"><a class="btn btn-primary pull-right btn-flat" href="<?php echo $url;?>"><i class="fa fa-long-arrow-left"></i> Back to order</a></div>
							<div class="clearfix"></div>
                        <hr>
                        </div>
						<div class="reports">
						<div class="box big">
						<h3>SALES INVOICE (CLIENT COPY)</h3>
						
						<?php 
                            $order_datas = $controller->getindividual($table, "id", $orderid);
                            
                            $count = 0;
                            foreach($order_datas as $data)
                            {
                                $id = $data->id;
                                $ordernumber = $data->order_number;
                                $orderdate = $data->date;
								$amount = $data->order_price;
								$shopid = $data->shop_id;
								$userid = $data->user_id;
                                $count++;
                                
                                $usernam = '';
								$get_user = $controller->getindividual("users", "id", $userid);
								
								foreach($get_user as $user)
								{
									$usernam = $user->fname.' '.$user->lname;
									$phone = $user->phone;
								}
								
								$shopnam = '';
								$get_shop = $controller->getindividual("shops", "id", $shopid);
								foreach($get_shop as $shop){
									$shopnam = $shop->name;
								}
                            }
                        ?>
						
						<div>
							<h4 class="pull-right" style="font-size: 20px;"> Seller: <?php echo $shopnam;?></h4>
						</div>
						<div class="clearfix"></div>
						<hr>
						<table class="table table-bordered table-striped">
                            
                            <tbody>
                            
                            <tr>
								<td>Order date:</td>
								<td><?php echo $orderdate;?></td>
								<td rowspan="6">
									<p style="font-size: 18px;">
									Address: <br>
									<?php echo $usernam;?> <br>
									Kampala <br>
									Central Region <br>
									Uganda
									</p>
								</td>
                            </tr>
							<tr>
								<td>Order number:</td>
								<td><?php echo $ordernumber;?></td>
                            </tr>
							<tr>
								<td>Payment type:</td>
								<td>Cash on delivery</td>
                            </tr>
							<tr>
								<td>Amount:</td>
								<td> UGX. <?php echo number_format($amount);?></td>
                            </tr>
							<tr>
								<td>Name:</td>
								<td> <?php echo $usernam;?></td>
                            </tr>
							<tr>
								<td>Phone:</td>
								<td> <?php echo $phone;?></td>
                            </tr>
                            <?php
                            ?>
                            </tbody>
                        </table>
						</div>
						</div>
						<div class="reports">
						<div class="box big">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
								<th colspan="5">Order Details</th>
                            </tr>
                            </thead>
							<thead>
                            <tr>
								<th>#</th>
								<th>Product name</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Paid Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $datas = $controller->getindividual("order_items", "order_id", $orderid);
                            
                            $count = 0;
							$total_price = 0;
                            foreach($datas as $data)
                            {
                                $id = $data->id;
                                $qty = $data->item_quantity;
                                $orderid = $data->order_id;
								$itemid = $data->item_id;
								//$uprice = $data->unit_price;
                                $count++;
                                
                                $itemnam = '';
								$uprice = '';
                                $get_items = $controller->getindividual("items", "id", $itemid);
                                foreach($get_items as $item){
                                    $itemnam = $item->name;
									$uprice = $item->price;
                                }
								
								$paid_price = $uprice*$qty;
								
								$total_price = $total_price+$paid_price;
                            ?>
                            <tr>
								<td><?php echo $count;?></td>
								<td><?php echo $itemnam;?></td>
								<td> <?php echo $qty;?></td>
								<td>UGX. <?php echo number_format($uprice);?></td>
								<td>UGX. <?php echo number_format($paid_price);?></td>
                            </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
						
						<table class="table table-bordered table-striped">
                            
							<thead>
                            <tr>
								<th>Subtotal</th>
								<th>Shipping</th>
								<th>Voucher</th>
								<th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $shipping = 3000;
							$voucher = 0;
							$total = $total_price+$shipping+$voucher;
                            ?>
                            <tr>
								<td> UGX. <?php echo number_format($total_price, 2);?></td>
								<td> UGX. <?php echo number_format($shipping, 2);?></td>
								<td>UGX. <?php echo number_format($voucher, 2);?></td>
								<td>UGX. <?php echo number_format($total, 2);?></td>
                            </tr>
                            
                            </tbody>
                        </table>
						
						<div class="no-print">
							<hr>
							<button type="button" class="btn btn-primary" onclick="print();"><i class="fa fa-print"></i> Print invoice</button>
						</div>
						</div>
						</div>
                        <?php
                    }
                    else if(isset($_GET['deliverynote']))
                    {
                        $orderid = $_GET['deliverynote'];

                        ?>
                        <div class="row no-print">
                            <div class="col-xs-12"><a class="btn btn-primary pull-right btn-flat" href="<?php echo $url;?>"><i class="fa fa-long-arrow-left"></i> Back to order</a></div>
							<div class="clearfix"></div>
                        <hr>
                        </div>
						<div class="reports">
						<div class="box big">
						<h3>DELIVERY NOTE (CLIENT COPY)</h3>
						
						<?php 
                            $order_datas = $controller->getindividual($table, "id", $orderid);
                            
                            $count = 0;
                            foreach($order_datas as $data)
                            {
                                $id = $data->id;
                                $ordernumber = $data->order_number;
                                $orderdate = $data->date;
								$amount = $data->order_price;
								$shopid = $data->shop_id;
								$userid = $data->user_id;
                                $count++;
                                
                                $usernam = '';
								$get_user = $controller->getindividual("users", "id", $userid);
								
								foreach($get_user as $user)
								{
									$usernam = $user->fname.' '.$user->lname;
									$phone = $user->phone;
								}
								
								$shopnam = '';
								$get_shop = $controller->getindividual("shops", "id", $shopid);
								foreach($get_shop as $shop){
									$shopnam = $shop->name;
								}
                            }
                        ?>
						
						<div class="row">
							<div class="col-xs-3"><h3 class="h3-bordered"><?php echo date("Y-m-d");?></h3></div>
							<div class="col-xs-4"><h3 class="h3-bordered">Cash on delivery</h3></div>
							<div class="col-xs-5"><h3 class="pull-right h3-bordered" style="font-size: 20px;"> Seller: <?php echo $shopnam;?></h3></div>
						</div>
						<div class="clearfix"></div>
						
						<table class="table table-bordered table-striped">
                            
                            <tbody>
                            
                            <tr>
								<td>Order date:</td>
								<td><?php echo $orderdate;?></td>
								<td rowspan="6">
									<p style="font-size: 18px;">
									Address: <br>
									<?php echo $usernam;?> <br>
									Kampala <br>
									Central Region <br>
									Uganda
									</p>
								</td>
                            </tr>
							<tr>
								<td>Order number:</td>
								<td><?php echo $ordernumber;?></td>
                            </tr>
							<tr>
								<td>Payment type:</td>
								<td>Cash on delivery</td>
                            </tr>
							<tr>
								<td>Amount:</td>
								<td> UGX. <?php echo number_format($amount);?></td>
                            </tr>
							<tr>
								<td>Name:</td>
								<td> <?php echo $usernam;?></td>
                            </tr>
							<tr>
								<td>Phone:</td>
								<td> <?php echo $phone;?></td>
                            </tr>
                            <?php
                            ?>
                            </tbody>
                        </table>
						</div>
						</div>
						<div class="reports">
						<div class="box big">
						
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
								<th colspan="5">Order Details</th>
                            </tr>
                            </thead>
							<thead>
                            <tr>
								<th>#</th>
								<th>Product name</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Paid Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $datas = $controller->getindividual("order_items", "order_id", $orderid);
                            
                            $count = 0;
							$total_price = 0;
                            foreach($datas as $data)
                            {
                                $id = $data->id;
                                $qty = $data->item_quantity;
                                $orderid = $data->order_id;
								$itemid = $data->item_id;
								//$uprice = $data->unit_price;
                                $count++;
                                
                                $itemnam = '';
								$uprice = '';
                                $get_items = $controller->getindividual("items", "id", $itemid);
                                foreach($get_items as $item){
                                    $itemnam = $item->name;
									$uprice = $item->price;
                                }
								
								$paid_price = $uprice*$qty;
								
								$total_price = $total_price+$paid_price;
                            ?>
                            <tr>
								<td><?php echo $count;?></td>
								<td><?php echo $itemnam;?></td>
								<td> <?php echo $qty;?></td>
								<td>UGX. <?php echo number_format($uprice);?></td>
								<td>UGX. <?php echo number_format($paid_price);?></td>
                            </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
						
						<table class="table table-bordered table-striped">
                            
							<thead>
                            <tr>
								<th>Subtotal</th>
								<th>Shipping</th>
								<th>Voucher</th>
								<th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $shipping = 3000;
							$voucher = 0;
							$total = $total_price+$shipping+$voucher;
                            ?>
                            <tr>
								<td> UGX. <?php echo number_format($total_price, 2);?></td>
								<td> UGX. <?php echo number_format($shipping, 2);?></td>
								<td>UGX. <?php echo number_format($voucher, 2);?></td>
								<td>UGX. <?php echo number_format($total, 2);?></td>
                            </tr>
                            
                            </tbody>
                        </table>
						
						<div class="div-bordered">
							<h3>RECEIVED BY:<H3>
							<p>Name and signature:</p>
						</div>
						
						<div class="no-print">
							<hr>
							<button type="button" class="btn btn-primary" onclick="print();"><i class="fa fa-print"></i> Print invoice</button>
						</div>
						</div>
						</div>
                        <?php
                    }else
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
                            
                            $controller->delete($table, $primary_key, $key_value, $url);
                        }

                        $datas = $controller->getdata($table, $primary_key, "asc");
                        $pending_datas = $controller->getindividual($table, "status", "pending");
                        $readytoship_datas = $controller->getindividual($table, "status", "ready to deliver");
                        $shipped_datas = $controller->getindividual($table, "status", "delivered");
                        $completed_datas = $controller->getindividual($table, "status", "delivered");
                        $cancelled_datas = $controller->getindividual($table, "status", "cancelled");
                    ?>
                    <div class="studio">
                        <ul class="nav nav-tabs tab-header material-tab">
                            <li class="active"><a href="#all" data-toggle="tab"><span class="right-space">All</span> <small class="badge pull-right bg-green"><?php echo count($datas);?></small></a></li>
                            <li><a href="#pending" data-toggle="tab">Pending <small class="badge pull-right bg-green"><?php echo count($pending_datas);?></small></a></li>
                            <li><a href="#readytoship" data-toggle="tab">Ready to deliver <small class="badge pull-right bg-green"><?php echo count($readytoship_datas);?></small></a></li>
                            <!--<li><a href="#shipped" data-toggle="tab">Shipped <small class="badge pull-right bg-green"><?php echo count($shipped_datas);?></small></a></li>-->
                            <li><a href="#shipped" data-toggle="tab">Delivered <small class="badge pull-right bg-green"><?php echo count($completed_datas);?></small></a></li>
                            <li><a href="#cancelled" data-toggle="tab">Canceled <small class="badge pull-right bg-green"><?php echo count($cancelled_datas);?></small></a></li>
                            
                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="all">
                                <br>
								<div class="box box-solid">
                                <div class="box-header">
                                    <h3 class="box-title">Shops and all orders</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="box-group" id="accordion">
                                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
										<?php 
										$shop_datas = $controller->getcustomdata("select s.id, s.name from shops s INNER JOIN orders o ON o.shop_id = s.id GROUP BY s.id");
										
										foreach($shop_datas as $data){
											$shopid = $data->id;
											
											$one_shop_orders = $controller->getindividual($table, "shop_id", $shopid);
										?>
                                        <div class="panel box box-success accod">
                                            <div class="box-header">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $shopid;?>" class="collapsed">
                                                        <i class="fa fa-plus"></i> 
														<?php
														echo $data->name;
														?> <small class="badge pull-right bg-red"><?php echo count($one_shop_orders);?></small>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse<?php echo $shopid;?>" class="panel-collapse collapse" style="height: 0px;">
                                                <div class="box-body">
                                                    
													
													<form action="" method="post" name="form1" onSubmit="return delete_confirm();">
												  <table class="table table-bordered table-striped datatable">
													<thead>
													<tr>
														<th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>
													  <th>#</th>
													  <th>Order No.</th>
													  <th>Order Date</th>
													  <th>Order Price</th>
													  <th>Customer</th>
													  <!--<th>Shop</th>-->
													  <th>Status</th>
													  <th>Action</th>
													</tr>
													</thead>
													<tbody>
													<?php 
													
													
													$count = 0;
													foreach($one_shop_orders as $data)
													{
														$id = $data->id;
														$userid = $data->user_id;
														$shopid = $data->shop_id;
														$ordernum = $data->order_number;
														$orderprice = $data->order_price;
														$date = $data->date;
														$count++;
														
														$usernam = '';
														$get_user = $controller->getindividual("users", "id", $userid);
														
														foreach($get_user as $user)
														{
															$usernam = $user->fname.' '.$user->lname;
														}
														
														$shopnam = '';
														$get_shop = $controller->getindividual("shops", "id", $shopid);
														foreach($get_shop as $shop){
															$shopnam = $shop->name;
														}
														
														$buttons = "<a href=\"?orderdetails=$id\" class=\"btn btn-primary btn-xs\" data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Ready to deliver\"><i class=\"fa fa-long-arrow-right\"></i></a>
													  <a href=\"?salesinvoice=$id\" class=\"btn btn-success btn-xs\" data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Sales invoice\"><i class=\"fa fa-usd\"></i></a>								  
													  <span  data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Cancel order\"><button type=\"button\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\" data-target=\"#confirm-delete2$id\" ><i class=\"fa fa-times\"></i></button></span>";
													  
													  if($data->status == 'cancelled')
														  $buttons = "<a href=\"?trash=$id\" class=\"btn btn-danger btn-xs\" data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Trash order\"><i class=\"fa fa-trash\"></i></a>";
													?>
													<tr>
														<td><input type="checkbox" class="table_records flat-red" name="ids[]" value="<?php echo $id;?>" title="<?php echo $data->fname.' '.$data->lname;?>"></td>
													  <td><?php echo $count;?></td>
													  <td style="cursor:pointer" class="accordion-toggle"  data-toggle="modal" data-target=".detailmodal<?php echo $id;?>"><span class="btn btn-danger btn-sm"><?php echo $ordernum;?> <i class="icon ion-ios-arrow-down"></i></span></td>
													  <td> <?php echo $date;?></td>
													  <td> <?php echo number_format($orderprice);?></td>
													  <td><?php echo $usernam;?></td>
													  <!--<td><?php echo $shopnam;?></td>-->
													  <td><?php echo $data->status;?></td>
													  <td>
													  <?php echo $buttons;?>
													  </td>
													</tr>
													
														<div class="modal fade" id="confirm-delete2<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<b><i class="fa fa-info-circle"> </i> Confirm Cancel</b>
																	</div>
																	<div class="modal-body">
																		Are you sure you want to cancel this record?
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"> </i> Cancel</button>
																		<a href="#" class="btn btn-success btn-ok"><i class="fa fa-check"> </i> OK</a>
																	</div>
																</div>
															</div>
														</div>
														
														<div class="modal fade detailmodal<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
															<div class="modal-dialog modal-lg">
																<div class="modal-content">
																	<div class="modal-header">
																		<b><i class="fa fa-info-circle"> </i> Order Details - <?php echo $ordernum;?></b>
																	</div>
																	<div class="modal-body">
																																			
																		<div class="row">
																			<div class="col-sm-2">
																				<h4>#</h4>
																			</div>
																			<div class="col-sm-4">
																				<h4>Product Name</h4>
																			</div>
																			
																			<div class="col-sm-2">
																				<h4>Quantity</h4>
																			</div>
																			
																			<div class="col-sm-2">
																				<h4>Price</h4>
																			</div>
																			
																			<div class="col-sm-2">
																				<h4>Price paid</h4>
																			</div>
																				<div class="clearfix"></div>
																				<hr class="style13">
																				
																			<?php
																			$iodatas = $controller->getindividual("order_items", "order_id", $id);
																			
																			$item_count = 0;
																			$new_count = 0;
																			$total_price = 0;
																			foreach($iodatas as $data)
																			{
																				$item_count++;
																				$new_count++;
																				$ioid = $data->id;
																				$qty = $data->item_quantity;
																				$orderid = $data->order_id;
																				$itemid = $data->item_id;
																				//$uprice = $data->unit_price;
																				
																				$itemnam = '';
																				$uprice = 0;
																				$get_items = $controller->getindividual("items", "id", $itemid);
																				foreach($get_items as $item){
																					$itemnam = $item->name;
																					$uprice = $item->price;
																				}
																				
																				$paidprice = ($uprice*$qty);
																				$total_price = $total_price+$paidprice;
																				
																				if($new_count == 5){
																					echo '<div class="clearfix"></div>';
																					$new_count = 0;
																				}
																				$new_count++;
																				?>
																				<div class="col-sm-2">
																					<h5><?php echo $item_count;?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<div class="col-sm-4">
																					<h5><?php echo $itemnam;?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<div class="col-sm-2">
																					<h5><?php echo $qty;?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<div class="col-sm-2">
																					<h5>UGX. <?php echo number_format($uprice);?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<div class="col-sm-2">
																					<h5>UGX. <?php echo number_format($uprice*$qty);?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<?php
																			}
																			?>
																			<div class="clearfix"></div>
																				<hr class="style13">
																				
																			<div class="col-sm-10">
																				<h4><b>Order Total</b></h4>
																				
																			</div>
																			
																			<div class="col-sm-2">
																				<h5><b>UGX. <?php echo number_format($total_price);?></b></h5>
																				
																			</div>
																				<div class="clearfix"></div>
																				<hr class="style13">
																		</div>
																		
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"> </i> Close</button>
																		<a href="?salesinvoice=<?php echo $id;?>" class="btn btn-success btn-ok"> Generate invoice <i class="fa fa-long-arrow-right"> </i></a>
																		<a href="?deliverynote=<?php echo $id;?>" class="btn btn-success btn-ok"> Generate delivery note <i class="fa fa-long-arrow-right"> </i></a>
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
													  <th>Order No.</th>
													  <th>Order Date</th>
													  <th>Order Price</th>
													  <th>Customer</th>
													  <!--<th>Shop</th>-->
													  <th>Status</th>
													  <th>Action</th>
													</tr>
													</tfoot>
												  </table>
												  	
												   </form>
                                                </div>
                                            </div>
                                        </div>
										<?php
										}
										?>
                                    </div>
                                </div><!-- /.box-body -->
                            </div>
								
								
                                
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="pending">
                                <br>
								
								<div class="box box-solid">
                                <div class="box-header">
                                    <h3 class="box-title">Shops and pending orders</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="box-group accordion" id="">
                                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
										<?php 
										$shop_datas = $controller->getcustomdata("select s.id, s.name from shops s INNER JOIN orders o ON o.shop_id = s.id WHERE o.status = 'pending' GROUP BY s.id");
										
										foreach($shop_datas as $data){
											$shopid = $data->id;
											
											$one_shop_orders = $controller->getcustomdata("select * from $table where shop_id = '$shopid' and status = 'pending'");
										?>
                                        <div class="panel box box-success accod">
                                            <div class="box-header">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent=".accordion" href=".collapse<?php echo $shopid;?>" class="collapsed">
                                                        <i class="fa fa-plus"></i> 
														<?php
														echo $data->name;
														?> <small class="badge pull-right bg-red"><?php echo count($one_shop_orders);?></small>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="" class="panel-collapse collapse collapse<?php echo $shopid;?>" style="height: 0px;">
                                                <div class="box-body">
                                                    
													
													<form action="" method="post" name="form1" onSubmit="return delete_confirm();">
												  <table class="table table-bordered table-striped datatable">
													<thead>
													<tr>
														<th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>
													  <th>#</th>
													  <th>Order No.</th>
													  <th>Order Date</th>
													  <th>Order Price</th>
													  <th>Customer</th>
													  <!--<th>Shop</th>-->
													  <th>Status</th>
													  <th>Action</th>
													</tr>
													</thead>
													<tbody>
													<?php 
													
													
													$count = 0;
													foreach($one_shop_orders as $data)
													{
														$id = $data->id;
														$userid = $data->user_id;
														$shopid = $data->shop_id;
														$ordernum = $data->order_number;
														$orderprice = $data->order_price;
														$date = $data->date;
														$count++;
														
														$usernam = '';
														$get_user = $controller->getindividual("users", "id", $userid);
														
														foreach($get_user as $user)
														{
															$usernam = $user->fname.' '.$user->lname;
														}
														
														$shopnam = '';
														$get_shop = $controller->getindividual("shops", "id", $shopid);
														foreach($get_shop as $shop){
															$shopnam = $shop->name;
														}
														
														$buttons = "<a href=\"?orderdetails=$id\" class=\"btn btn-primary btn-xs\" data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Ready to deliver\"><i class=\"fa fa-long-arrow-right\"></i></a>
													  <a href=\"?salesinvoice=$id\" class=\"btn btn-success btn-xs\" data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Sales invoice\"><i class=\"fa fa-usd\"></i></a>								  
													  <span  data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Cancel order\"><button type=\"button\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\" data-target=\"#confirm-delete3$id\" ><i class=\"fa fa-times\"></i></button></span>";
													  
													  if($data->status == 'cancelled')
														  $buttons = "<a href=\"?trash=$id\" class=\"btn btn-danger btn-xs\" data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Trash order\"><i class=\"fa fa-trash\"></i></a>";
													?>
													<tr>
														<td><input type="checkbox" class="table_records flat-red" name="ids[]" value="<?php echo $id;?>" title="<?php echo $data->fname.' '.$data->lname;?>"></td>
													  <td><?php echo $count;?></td>
													  <td style="cursor:pointer" class="accordion-toggle"  data-toggle="modal" data-target=".detailmodal1<?php echo $id;?>"><span class="btn btn-danger btn-sm"><?php echo $ordernum;?> <i class="icon ion-ios-arrow-down"></i></span></td>
													  <td> <?php echo $date;?></td>
													  <td> <?php echo number_format($orderprice);?></td>
													  <td><?php echo $usernam;?></td>
													  <!--<td><?php echo $shopnam;?></td>-->
													  <td><?php echo $data->status;?></td>
													  <td>
													  <?php echo $buttons;?>
													  </td>
													</tr>
													
														<div class="modal fade" id="confirm-delete3<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<b><i class="fa fa-info-circle"> </i> Confirm Cancel</b>
																	</div>
																	<div class="modal-body">
																		Are you sure you want to cancel this order?
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"> </i> Cancel</button>
																		<a href="#" class="btn btn-success btn-ok"><i class="fa fa-check"> </i> OK</a>
																	</div>
																</div>
															</div>
														</div>
														
														<div class="modal fade detailmodal1<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
															<div class="modal-dialog modal-lg">
																<div class="modal-content">
																	<div class="modal-header">
																		<b><i class="fa fa-info-circle"> </i> Order Details - <?php echo $ordernum;?></b>
																	</div>
																	<div class="modal-body">
																																			
																		<div class="row">
																			<div class="col-sm-2">
																				<h4>#</h4>
																			</div>
																			<div class="col-sm-4">
																				<h4>Product Name</h4>
																			</div>
																			
																			<div class="col-sm-2">
																				<h4>Quantity</h4>
																			</div>
																			
																			<div class="col-sm-2">
																				<h4>Price</h4>
																			</div>
																			
																			<div class="col-sm-2">
																				<h4>Price paid</h4>
																			</div>
																				<div class="clearfix"></div>
																				<hr class="style13">
																				
																			<?php
																			$iodatas = $controller->getindividual("order_items", "order_id", $id);
																			
																			$item_count = 0;
																			$new_count = 0;
																			$total_price = 0;
																			foreach($iodatas as $data)
																			{
																				$item_count++;
																				$new_count++;
																				$ioid = $data->id;
																				$qty = $data->item_quantity;
																				$orderid = $data->order_id;
																				$itemid = $data->item_id;
																				//$uprice = $data->unit_price;
																				
																				$itemnam = '';
																				$uprice = 0;
																				$get_items = $controller->getindividual("items", "id", $itemid);
																				foreach($get_items as $item){
																					$itemnam = $item->name;
																					$uprice = $item->price;
																				}
																				
																				$paidprice = ($uprice*$qty);
																				$total_price = $total_price+$paidprice;
																				
																				if($new_count == 5){
																					echo '<div class="clearfix"></div>';
																					$new_count = 0;
																				}
																				$new_count++;
																				?>
																				<div class="col-sm-2">
																					<h5><?php echo $item_count;?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<div class="col-sm-4">
																					<h5><?php echo $itemnam;?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<div class="col-sm-2">
																					<h5><?php echo $qty;?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<div class="col-sm-2">
																					<h5>UGX. <?php echo number_format($uprice);?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<div class="col-sm-2">
																					<h5>UGX. <?php echo number_format($uprice*$qty);?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<?php
																			}
																			?>
																			<div class="clearfix"></div>
																				<hr class="style13">
																				
																			<div class="col-sm-10">
																				<h4><b>Order Total</b></h4>
																				
																			</div>
																			
																			<div class="col-sm-2">
																				<h5><b>UGX. <?php echo number_format($total_price);?></b></h5>
																				
																			</div>
																				<div class="clearfix"></div>
																				<hr class="style13">
																		</div>
																		
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"> </i> Close</button>
																		<a href="?salesinvoice=<?php echo $id;?>" class="btn btn-success btn-ok"> Generate invoice <i class="fa fa-long-arrow-right"> </i></a>
																		<a href="?deliverynote=<?php echo $id;?>" class="btn btn-success btn-ok"> Generate delivery note <i class="fa fa-long-arrow-right"> </i></a>
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
													  <th>Order No.</th>
													  <th>Order Date</th>
													  <th>Order Price</th>
													  <th>Customer</th>
													  <!--<th>Shop</th>-->
													  <th>Status</th>
													  <th>Action</th>
													</tr>
													</tfoot>
												  </table>
												  	
												   </form>
                                                </div>
                                            </div>
                                        </div>
										<?php
										}
										?>
                                    </div>
                                </div><!-- /.box-body -->
                            </div>
								
                                
                                
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="readytoship">
							<br>
								<div class="box box-solid">
									<div class="box-header">
										<h3 class="box-title">Shops and ready to deliver orders</h3>
									</div><!-- /.box-header -->
									<div class="box-body">
										<div class="box-group accordion" id="">
											<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
											<?php 
											$shop_datas = $controller->getcustomdata("select s.id, s.name from shops s INNER JOIN orders o ON o.shop_id = s.id WHERE o.status = 'ready to deliver' GROUP BY s.id");
											
											foreach($shop_datas as $data){
												$shopid = $data->id;
												
												$one_shop_orders = $controller->getcustomdata("select * from $table where shop_id = '$shopid' and status = 'ready to deliver'");
											?>
											<div class="panel box box-success accod">
												<div class="box-header">
													<h4 class="box-title">
														<a data-toggle="collapse" data-parent=".accordion" href=".collapse<?php echo $shopid;?>" class="collapsed">
															<i class="fa fa-plus"></i> 
															<?php
															echo $data->name;
															?> <small class="badge pull-right bg-red"><?php echo count($one_shop_orders);?></small>
														</a>
													</h4>
												</div>
												<div id="" class="panel-collapse collapse collapse<?php echo $shopid;?>" style="height: 0px;">
													<div class="box-body">
														
														
														<form action="" method="post" name="form1" onSubmit="return delete_confirm();">
													  <table class="table table-bordered table-striped datatable">
														<thead>
														<tr>
															<th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>
														  <th>#</th>
														  <th>Order No.</th>
														  <th>Order Date</th>
														  <th>Order Price</th>
														  <th>Customer</th>
														  <!--<th>Shop</th>-->
														  <th>Status</th>
														  <th>Action</th>
														</tr>
														</thead>
														<tbody>
														<?php 
														
														
														$count = 0;
														foreach($one_shop_orders as $data)
														{
															$id = $data->id;
															$userid = $data->user_id;
															$shopid = $data->shop_id;
															$ordernum = $data->order_number;
															$orderprice = $data->order_price;
															$date = $data->date;
															$count++;
															
															$usernam = '';
															$get_user = $controller->getindividual("users", "id", $userid);
															
															foreach($get_user as $user)
															{
																$usernam = $user->fname.' '.$user->lname;
															}
															
															$shopnam = '';
															$get_shop = $controller->getindividual("shops", "id", $shopid);
															foreach($get_shop as $shop){
																$shopnam = $shop->name;
															}
															
															$buttons = "<a href=\"?orderdetails=$id\" class=\"btn btn-primary btn-xs\" data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Ready to deliver\"><i class=\"fa fa-long-arrow-right\"></i></a>
														  <a href=\"?salesinvoice=$id\" class=\"btn btn-success btn-xs\" data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Sales invoice\"><i class=\"fa fa-usd\"></i></a>								  
														  <span  data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Cancel order\"><button type=\"button\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\" data-target=\"#confirm-delete4$id\" ><i class=\"fa fa-times\"></i></button></span>";
														  
														  if($data->status == 'cancelled')
															  $buttons = "<a href=\"?trash=$id\" class=\"btn btn-danger btn-xs\" data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Trash order\"><i class=\"fa fa-trash\"></i></a>";
														?>
														<tr>
															<td><input type="checkbox" class="table_records flat-red" name="ids[]" value="<?php echo $id;?>" title="<?php echo $data->fname.' '.$data->lname;?>"></td>
														  <td><?php echo $count;?></td>
														  <td style="cursor:pointer" class="accordion-toggle"  data-toggle="modal" data-target=".detailmodal2<?php echo $id;?>"><span class="btn btn-danger btn-sm"><?php echo $ordernum;?> <i class="icon ion-ios-arrow-down"></i></span></td>
														  <td> <?php echo $date;?></td>
														  <td> <?php echo number_format($orderprice);?></td>
														  <td><?php echo $usernam;?></td>
														  <!--<td><?php echo $shopnam;?></td>-->
														  <td><?php echo $data->status;?></td>
														  <td>
														  <?php echo $buttons;?>
														  </td>
														</tr>
														
															<div class="modal fade" id="confirm-delete4<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																<div class="modal-dialog">
																	<div class="modal-content">
																		<div class="modal-header">
																			<b><i class="fa fa-info-circle"> </i> Confirm Cancel</b>
																		</div>
																		<div class="modal-body">
																			Are you sure you want to cancel this order?
																		</div>
																		<div class="modal-footer">
																			<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"> </i> Cancel</button>
																			<a href="#" class="btn btn-success btn-ok"><i class="fa fa-check"> </i> OK</a>
																		</div>
																	</div>
																</div>
															</div>
															
															<div class="modal fade detailmodal2<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																<div class="modal-dialog modal-lg">
																	<div class="modal-content">
																		<div class="modal-header">
																			<b><i class="fa fa-info-circle"> </i> Order Details - <?php echo $ordernum;?></b>
																		</div>
																		<div class="modal-body">
																																				
																			<div class="row">
																				<div class="col-sm-2">
																					<h4>#</h4>
																				</div>
																				<div class="col-sm-4">
																					<h4>Product Name</h4>
																				</div>
																				
																				<div class="col-sm-2">
																					<h4>Quantity</h4>
																				</div>
																				
																				<div class="col-sm-2">
																					<h4>Price</h4>
																				</div>
																				
																				<div class="col-sm-2">
																					<h4>Price paid</h4>
																				</div>
																					<div class="clearfix"></div>
																					<hr class="style13">
																					
																				<?php
																				$iodatas = $controller->getindividual("order_items", "order_id", $id);
																				
																				$item_count = 0;
																				$new_count = 0;
																				$total_price = 0;
																				foreach($iodatas as $data)
																				{
																					$item_count++;
																					$new_count++;
																					$ioid = $data->id;
																					$qty = $data->item_quantity;
																					$orderid = $data->order_id;
																					$itemid = $data->item_id;
																					//$uprice = $data->unit_price;
																					
																					$itemnam = '';
																					$uprice = 0;
																					$get_items = $controller->getindividual("items", "id", $itemid);
																					foreach($get_items as $item){
																						$itemnam = $item->name;
																						$uprice = $item->price;
																					}
																					
																					$paidprice = ($uprice*$qty);
																					$total_price = $total_price+$paidprice;
																					
																					if($new_count == 5){
																						echo '<div class="clearfix"></div>';
																						$new_count = 0;
																					}
																					$new_count++;
																					?>
																					<div class="col-sm-2">
																						<h5><?php echo $item_count;?></h5>
																						
																						<div class="clearfix"></div>
																						<hr class="style13">
																					</div>
																					
																					<div class="col-sm-4">
																						<h5><?php echo $itemnam;?></h5>
																						
																						<div class="clearfix"></div>
																						<hr class="style13">
																					</div>
																					
																					<div class="col-sm-2">
																						<h5><?php echo $qty;?></h5>
																						
																						<div class="clearfix"></div>
																						<hr class="style13">
																					</div>
																					
																					<div class="col-sm-2">
																						<h5>UGX. <?php echo number_format($uprice);?></h5>
																						
																						<div class="clearfix"></div>
																						<hr class="style13">
																					</div>
																					
																					<div class="col-sm-2">
																						<h5>UGX. <?php echo number_format($uprice*$qty);?></h5>
																						
																						<div class="clearfix"></div>
																						<hr class="style13">
																					</div>
																					
																					<?php
																				}
																				?>
																				<div class="clearfix"></div>
																					<hr class="style13">
																					
																				<div class="col-sm-10">
																					<h4><b>Order Total</b></h4>
																					
																				</div>
																				
																				<div class="col-sm-2">
																					<h5><b>UGX. <?php echo number_format($total_price);?></b></h5>
																					
																				</div>
																					<div class="clearfix"></div>
																					<hr class="style13">
																			</div>
																			
																		</div>
																		<div class="modal-footer">
																			<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"> </i> Close</button>
																			<a href="?salesinvoice=<?php echo $id;?>" class="btn btn-success btn-ok"> Generate invoice <i class="fa fa-long-arrow-right"> </i></a>
																			<a href="?deliverynote=<?php echo $id;?>" class="btn btn-success btn-ok"> Generate delivery note <i class="fa fa-long-arrow-right"> </i></a>
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
														  <th>Order No.</th>
														  <th>Order Date</th>
														  <th>Order Price</th>
														  <th>Customer</th>
														  <!--<th>Shop</th>-->
														  <th>Status</th>
														  <th>Action</th>
														</tr>
														</tfoot>
													  </table>
														
													   </form>
													</div>
												</div>
											</div>
											<?php
											}
											?>
										</div>
									</div><!-- /.box-body -->
								</div>
                            
                            
                            </div><!-- /.tab-pane -->

                            <div class="tab-pane" id="shipped">
							<br>
                            <div class="box box-solid">
                                <div class="box-header">
                                    <h3 class="box-title">Shops and delivered orders</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="box-group accordion" id="">
                                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
										<?php 
										$shop_datas = $controller->getcustomdata("select s.id, s.name from shops s INNER JOIN orders o ON o.shop_id = s.id WHERE o.status = 'delivered' GROUP BY s.id");
										
										foreach($shop_datas as $data){
											$shopid = $data->id;
											
											$one_shop_orders = $controller->getcustomdata("select * from $table where shop_id = '$shopid' and status = 'delivered'");
										?>
                                        <div class="panel box box-success accod">
                                            <div class="box-header">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent=".accordion" href=".collapse<?php echo $shopid;?>" class="collapsed">
                                                        <i class="fa fa-plus"></i> 
														<?php
														echo $data->name;
														?> <small class="badge pull-right bg-red"><?php echo count($one_shop_orders);?></small>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="" class="panel-collapse collapse collapse<?php echo $shopid;?>" style="height: 0px;">
                                                <div class="box-body">
                                                    
													
													<form action="" method="post" name="form1" onSubmit="return delete_confirm();">
												  <table class="table table-bordered table-striped datatable">
													<thead>
													<tr>
														<th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>
													  <th>#</th>
													  <th>Order No.</th>
													  <th>Order Date</th>
													  <th>Order Price</th>
													  <th>Customer</th>
													  <!--<th>Shop</th>-->
													  <th>Status</th>
													  <th>Action</th>
													</tr>
													</thead>
													<tbody>
													<?php 
													
													
													$count = 0;
													foreach($one_shop_orders as $data)
													{
														$id = $data->id;
														$userid = $data->user_id;
														$shopid = $data->shop_id;
														$ordernum = $data->order_number;
														$orderprice = $data->order_price;
														$date = $data->date;
														$count++;
														
														$usernam = '';
														$get_user = $controller->getindividual("users", "id", $userid);
														
														foreach($get_user as $user)
														{
															$usernam = $user->fname.' '.$user->lname;
														}
														
														$shopnam = '';
														$get_shop = $controller->getindividual("shops", "id", $shopid);
														foreach($get_shop as $shop){
															$shopnam = $shop->name;
														}
														
														$buttons = "<a href=\"?orderdetails=$id\" class=\"btn btn-primary btn-xs\" data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Ready to deliver\"><i class=\"fa fa-long-arrow-right\"></i></a>
													  <a href=\"?salesinvoice=$id\" class=\"btn btn-success btn-xs\" data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Sales invoice\"><i class=\"fa fa-usd\"></i></a>								  
													  <span  data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Cancel order\"><button type=\"button\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\" data-target=\"#confirm-delete5$id\" ><i class=\"fa fa-times\"></i></button></span>";
													  
													  if($data->status == 'cancelled')
														  $buttons = "<a href=\"?trash=$id\" class=\"btn btn-danger btn-xs\" data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Trash order\"><i class=\"fa fa-trash\"></i></a>";
													?>
													<tr>
														<td><input type="checkbox" class="table_records flat-red" name="ids[]" value="<?php echo $id;?>" title="<?php echo $data->fname.' '.$data->lname;?>"></td>
													  <td><?php echo $count;?></td>
													  <td style="cursor:pointer" class="accordion-toggle"  data-toggle="modal" data-target=".detailmodal3<?php echo $id;?>"><span class="btn btn-danger btn-sm"><?php echo $ordernum;?> <i class="icon ion-ios-arrow-down"></i></span></td>
													  <td> <?php echo $date;?></td>
													  <td> <?php echo number_format($orderprice);?></td>
													  <td><?php echo $usernam;?></td>
													  <!--<td><?php echo $shopnam;?></td>-->
													  <td><?php echo $data->status;?></td>
													  <td>
													  <?php echo $buttons;?>
													  </td>
													</tr>
													
														<div class="modal fade" id="confirm-delete5<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<b><i class="fa fa-info-circle"> </i> Confirm Cancel</b>
																	</div>
																	<div class="modal-body">
																		Are you sure you want to cancel this order?
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"> </i> Cancel</button>
																		<a href="#" class="btn btn-success btn-ok"><i class="fa fa-check"> </i> OK</a>
																	</div>
																</div>
															</div>
														</div>
														
														<div class="modal fade detailmodal3<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
															<div class="modal-dialog modal-lg">
																<div class="modal-content">
																	<div class="modal-header">
																		<b><i class="fa fa-info-circle"> </i> Order Details - <?php echo $ordernum;?></b>
																	</div>
																	<div class="modal-body">
																																			
																		<div class="row">
																			<div class="col-sm-2">
																				<h4>#</h4>
																			</div>
																			<div class="col-sm-4">
																				<h4>Product Name</h4>
																			</div>
																			
																			<div class="col-sm-2">
																				<h4>Quantity</h4>
																			</div>
																			
																			<div class="col-sm-2">
																				<h4>Price</h4>
																			</div>
																			
																			<div class="col-sm-2">
																				<h4>Price paid</h4>
																			</div>
																				<div class="clearfix"></div>
																				<hr class="style13">
																				
																			<?php
																			$iodatas = $controller->getindividual("order_items", "order_id", $id);
																			
																			$item_count = 0;
																			$new_count = 0;
																			$total_price = 0;
																			foreach($iodatas as $data)
																			{
																				$item_count++;
																				$new_count++;
																				$ioid = $data->id;
																				$qty = $data->item_quantity;
																				$orderid = $data->order_id;
																				$itemid = $data->item_id;
																				//$uprice = $data->unit_price;
																				
																				$itemnam = '';
																				$uprice = 0;
																				$get_items = $controller->getindividual("items", "id", $itemid);
																				foreach($get_items as $item){
																					$itemnam = $item->name;
																					$uprice = $item->price;
																				}
																				
																				$paidprice = ($uprice*$qty);
																				$total_price = $total_price+$paidprice;
																				
																				if($new_count == 5){
																					echo '<div class="clearfix"></div>';
																					$new_count = 0;
																				}
																				$new_count++;
																				?>
																				<div class="col-sm-2">
																					<h5><?php echo $item_count;?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<div class="col-sm-4">
																					<h5><?php echo $itemnam;?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<div class="col-sm-2">
																					<h5><?php echo $qty;?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<div class="col-sm-2">
																					<h5>UGX. <?php echo number_format($uprice);?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<div class="col-sm-2">
																					<h5>UGX. <?php echo number_format($uprice*$qty);?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<?php
																			}
																			?>
																			<div class="clearfix"></div>
																				<hr class="style13">
																				
																			<div class="col-sm-10">
																				<h4><b>Order Total</b></h4>
																				
																			</div>
																			
																			<div class="col-sm-2">
																				<h5><b>UGX. <?php echo number_format($total_price);?></b></h5>
																				
																			</div>
																				<div class="clearfix"></div>
																				<hr class="style13">
																		</div>
																		
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"> </i> Close</button>
																		<a href="?salesinvoice=<?php echo $id;?>" class="btn btn-success btn-ok"> Generate invoice <i class="fa fa-long-arrow-right"> </i></a>
																		<a href="?deliverynote=<?php echo $id;?>" class="btn btn-success btn-ok"> Generate delivery note <i class="fa fa-long-arrow-right"> </i></a>
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
													  <th>Order No.</th>
													  <th>Order Date</th>
													  <th>Order Price</th>
													  <th>Customer</th>
													  <!--<th>Shop</th>-->
													  <th>Status</th>
													  <th>Action</th>
													</tr>
													</tfoot>
												  </table>
												  	
												   </form>
                                                </div>
                                            </div>
                                        </div>
										<?php
										}
										?>
                                    </div>
                                </div><!-- /.box-body -->
                            </div>
                            
                            </div><!-- /.tab-pane -->

                            <div class="tab-pane" id="cancelled">
                            <br>
                            <div class="box box-solid">
                                <div class="box-header">
                                    <h3 class="box-title">Shops and canceled orders</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="box-group accordion" id="">
                                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
										<?php 
										$shop_datas = $controller->getcustomdata("select s.id, s.name from shops s INNER JOIN orders o ON o.shop_id = s.id WHERE o.status = 'cancelled' GROUP BY s.id");
										
										foreach($shop_datas as $data){
											$shopid = $data->id;
											
											$one_shop_orders = $controller->getcustomdata("select * from $table where shop_id = '$shopid' and status = 'cancelled'");
										?>
                                        <div class="panel box box-success accod">
                                            <div class="box-header">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent=".accordion" href=".collapse<?php echo $shopid;?>" class="collapsed">
                                                        <i class="fa fa-plus"></i> 
														<?php
														echo $data->name;
														?> <small class="badge pull-right bg-red"><?php echo count($one_shop_orders);?></small>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="" class="panel-collapse collapse collapse<?php echo $shopid;?>" style="height: 0px;">
                                                <div class="box-body">
                                                    
													
													<form action="" method="post" name="form1" onSubmit="return delete_confirm();">
												  <table class="table table-bordered table-striped datatable">
													<thead>
													<tr>
														<th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>
													  <th>#</th>
													  <th>Order No.</th>
													  <th>Order Date</th>
													  <th>Order Price</th>
													  <th>Customer</th>
													  <!--<th>Shop</th>-->
													  <th>Status</th>
													  <th>Action</th>
													</tr>
													</thead>
													<tbody>
													<?php 
													
													
													$count = 0;
													foreach($one_shop_orders as $data)
													{
														$id = $data->id;
														$userid = $data->user_id;
														$shopid = $data->shop_id;
														$ordernum = $data->order_number;
														$orderprice = $data->order_price;
														$date = $data->date;
														$count++;
														
														$usernam = '';
														$get_user = $controller->getindividual("users", "id", $userid);
														
														foreach($get_user as $user)
														{
															$usernam = $user->fname.' '.$user->lname;
														}
														
														$shopnam = '';
														$get_shop = $controller->getindividual("shops", "id", $shopid);
														foreach($get_shop as $shop){
															$shopnam = $shop->name;
														}
														
														$buttons = "<a href=\"?orderdetails=$id\" class=\"btn btn-primary btn-xs\" data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Ready to deliver\"><i class=\"fa fa-long-arrow-right\"></i></a>
													  <a href=\"?salesinvoice=$id\" class=\"btn btn-success btn-xs\" data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Sales invoice\"><i class=\"fa fa-usd\"></i></a>								  
													  <span  data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Cancel order\"><button type=\"button\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\" data-target=\"#confirm-delete6$id\" ><i class=\"fa fa-times\"></i></button></span>";
													  
													  if($data->status == 'cancelled')
														  $buttons = "<a href=\"?trash=$id\" class=\"btn btn-danger btn-xs\" data-toggle=\"tooltip\" data-html=\"true\" data-placement=\"top\" title=\"Trash order\"><i class=\"fa fa-trash\"></i></a>";
													?>
													<tr>
														<td><input type="checkbox" class="table_records flat-red" name="ids[]" value="<?php echo $id;?>" title="<?php echo $data->fname.' '.$data->lname;?>"></td>
													  <td><?php echo $count;?></td>
													  <td style="cursor:pointer" class="accordion-toggle"  data-toggle="modal" data-target=".detailmodal4<?php echo $id;?>"><span class="btn btn-danger btn-sm"><?php echo $ordernum;?> <i class="icon ion-ios-arrow-down"></i></span></td>
													  <td> <?php echo $date;?></td>
													  <td> <?php echo number_format($orderprice);?></td>
													  <td><?php echo $usernam;?></td>
													  <!--<td><?php echo $shopnam;?></td>-->
													  <td><?php echo $data->status;?></td>
													  <td>
													  <?php echo $buttons;?>
													  </td>
													</tr>
													
														<div class="modal fade" id="confirm-delete6<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<b><i class="fa fa-info-circle"> </i> Confirm Cancel</b>
																	</div>
																	<div class="modal-body">
																		Are you sure you want to cancel this order?
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"> </i> Cancel</button>
																		<a href="#" class="btn btn-success btn-ok"><i class="fa fa-check"> </i> OK</a>
																	</div>
																</div>
															</div>
														</div>
														
														<div class="modal fade detailmodal4<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
															<div class="modal-dialog modal-lg">
																<div class="modal-content">
																	<div class="modal-header">
																		<b><i class="fa fa-info-circle"> </i> Order Details - <?php echo $ordernum;?></b>
																	</div>
																	<div class="modal-body">
																																			
																		<div class="row">
																			<div class="col-sm-2">
																				<h4>#</h4>
																			</div>
																			<div class="col-sm-4">
																				<h4>Product Name</h4>
																			</div>
																			
																			<div class="col-sm-2">
																				<h4>Quantity</h4>
																			</div>
																			
																			<div class="col-sm-2">
																				<h4>Price</h4>
																			</div>
																			
																			<div class="col-sm-2">
																				<h4>Price paid</h4>
																			</div>
																				<div class="clearfix"></div>
																				<hr class="style13">
																				
																			<?php
																			$iodatas = $controller->getindividual("order_items", "order_id", $id);
																			
																			$item_count = 0;
																			$new_count = 0;
																			$total_price = 0;
																			foreach($iodatas as $data)
																			{
																				$item_count++;
																				$new_count++;
																				$ioid = $data->id;
																				$qty = $data->item_quantity;
																				$orderid = $data->order_id;
																				$itemid = $data->item_id;
																				//$uprice = $data->unit_price;
																				
																				$itemnam = '';
																				$uprice = 0;
																				$get_items = $controller->getindividual("items", "id", $itemid);
																				foreach($get_items as $item){
																					$itemnam = $item->name;
																					$uprice = $item->price;
																				}
																				
																				$paidprice = ($uprice*$qty);
																				$total_price = $total_price+$paidprice;
																				
																				if($new_count == 5){
																					echo '<div class="clearfix"></div>';
																					$new_count = 0;
																				}
																				$new_count++;
																				?>
																				<div class="col-sm-2">
																					<h5><?php echo $item_count;?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<div class="col-sm-4">
																					<h5><?php echo $itemnam;?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<div class="col-sm-2">
																					<h5><?php echo $qty;?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<div class="col-sm-2">
																					<h5>UGX. <?php echo number_format($uprice);?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<div class="col-sm-2">
																					<h5>UGX. <?php echo number_format($uprice*$qty);?></h5>
																					
																					<div class="clearfix"></div>
																					<hr class="style13">
																				</div>
																				
																				<?php
																			}
																			?>
																			<div class="clearfix"></div>
																				<hr class="style13">
																				
																			<div class="col-sm-10">
																				<h4><b>Order Total</b></h4>
																				
																			</div>
																			
																			<div class="col-sm-2">
																				<h5><b>UGX. <?php echo number_format($total_price);?></b></h5>
																				
																			</div>
																				<div class="clearfix"></div>
																				<hr class="style13">
																		</div>
																		
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"> </i> Close</button>
																		<a href="?salesinvoice=<?php echo $id;?>" class="btn btn-success btn-ok"> Generate invoice <i class="fa fa-long-arrow-right"> </i></a>
																		<a href="?deliverynote=<?php echo $id;?>" class="btn btn-success btn-ok"> Generate delivery note <i class="fa fa-long-arrow-right"> </i></a>
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
													  <th>Order No.</th>
													  <th>Order Date</th>
													  <th>Order Price</th>
													  <th>Customer</th>
													  <!--<th>Shop</th>-->
													  <th>Status</th>
													  <th>Action</th>
													</tr>
													</tfoot>
												  </table>
												  	
												   </form>
                                                </div>
                                            </div>
                                        </div>
										<?php
										}
										?>
                                    </div>
                                </div><!-- /.box-body -->
                            </div>
                            
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