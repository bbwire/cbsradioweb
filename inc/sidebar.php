<ul class="sidebar-menu">
		<li <?php if($page == 'index.php') echo $class;?>>
			<a href="./">
				<i class="fa fa-dashboard"></i> <span>Dashboard</span>
			</a>
		</li>
		
		<?php
		$radio_privilages = 'Comments,Listeners,Line up,Programmes,Presenters,Sponsors,Topic';
		$radio_pages = array('comments','listeners','lineup','programmes','presenters','sponsors','topic', 'studio');
		?>
		<li class="<?php echo $controller->showModule($uid, $radio_privilages);?> treeview <?php if(in_array($page, $radio_pages)) echo 'active';?>">
			<a href="#">
				<i class="fa fa-bars"></i> <span>Radio</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<!--<li class="<?php echo $controller->showMenu($uid, "Comments");?> <?php if($page == 'comments') echo 'active';?>"><a href="comments"><i class="fa fa-comment"></i> Comments</a></li>
				
				<li class="<?php echo $controller->showMenu($uid, "Listeners");?> <?php if($page == 'listeners') echo 'active';?>"><a href="listeners"><i class="fa fa-headphones"></i> Listeners</a></li>-->
				<li class="<?php echo $controller->showMenu($uid, "Programmes");?> <?php if($page == 'programmes') echo 'active';?>"><a href="programmes"><i class="fa fa-bars"></i> Programmes</a></li>
				<li class="<?php echo $controller->showMenu($uid, "Line up");?> <?php if($page == 'lineup') echo 'active';?>"><a href="lineup"><i class="fa fa-bars"></i> Line up</a></li>
				<li class="<?php echo $controller->showMenu($uid, "Presenters");?> <?php if($page == 'presenters') echo 'active';?>"><a href="presenters"><i class="fa fa-user"></i> Presenters</a></li>
				<li class="<?php echo $controller->showMenu($uid, "Sponsors");?> <?php if($page == 'sponsors') echo 'active';?>"><a href="sponsors"><i class="fa fa-user"></i> Sponsors</a></li>
				<li class="<?php echo $controller->showMenu($uid, "Studio");?> <?php if($page == 'studio') echo 'active';?>"><a href="studio"><i class="fa fa-bars"></i> Studio</a></li>
			</ul>
		</li>
		<?php
		$newsroom_privilages = 'Incoming news,News highlights,To be aired,Reorder news,Trashed news,Assign time,News archive,Capture news,Media';
		$newsroom_pages = array('incoming','highlights','tobeaired','reorder','trashed','assigntime','archive','capturenews','media');
		?>
		<li class="<?php echo $controller->showModule($uid, $newsroom_privilages);?> treeview <?php if(in_array($page, $newsroom_pages)) echo 'active';?>">
			<a href="#">
				<i class="fa fa-newspaper-o"></i> <span>Newsroom</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li class="<?php echo $controller->showMenu($uid, "Incoming news");?> <?php if($page == 'incoming') echo 'active';?>">
					<a href="incoming">
						<i class="fa fa-bars"></i> Incoming news
						<?php
						if($count_incoming > 0){
						?>
						<small class="badge pull-right bg-green"><?php echo $count_incoming;?></small>
						<?php
						}
						?>
					</a>
				</li>
				<li class="<?php echo $controller->showMenu($uid, "News highlights");?> <?php if($page == 'highlights') echo 'active';?>"><a href="highlights"><i class="fa fa-bars"></i> News highlights</a></li>
				<li class="<?php echo $controller->showMenu($uid, "To be aired");?> treeview <?php if($page == 'tobeaired') echo 'active';?>"><a href="tobeaired">
				<i class="fa fa-bars"></i> To be aired 
				<i class="fa fa-angle-left pull-right"></i>
				</a>
					<ul class="treeview-menu">
					<?php
					$get_breaking = $controller->getindividual('postupdate', 'isBreakingNews', "yes");
					?>
						<li class="<?php if($page == 'incoming') echo 'active';?>"><a href="tobeaired"><i class="fa fa-clock-o"></i> Breaking news (<?php echo count($get_breaking);?>)</a></li>
						<?php
						if(isset($_GET['detail']))
							$dets = $_GET['detail'];

						$get_newstimes = $controller->getdata("newstime", "id", "asc");
						foreach($get_newstimes as $ntime){
							//$count++;
							$id = $ntime->id;
							$label = $ntime->timeLabel;
							
							$newsstring_array = array();
							$newsstring = '';
							$num = 0;
							
							$get_tobeaired = $controller->getindividual("postupdate", "tobeaired", $id);
							
								$num = count($get_tobeaired);
							?>
								<li class="<?php if($dets == $id) echo 'active';?>"><a href="tobeaired?detail=<?php echo $id;?>"><i class="fa fa-clock-o"></i> <?php echo $label;?> (<?php echo $num;?>)</a></li>
							<?php
						}
						?>
					</ul>
				</li>
				<li class="<?php echo $controller->showMenu($uid, "Reorder new");?> <?php if($page == 'reorder') echo 'active';?>"><a href="reorder"><i class="fa fa-bars"></i> Reorder news</a></li>
				<li class="<?php echo $controller->showMenu($uid, "Trashed news");?> <?php if($page == 'trashed') echo 'active';?>"><a href="trashed"><i class="fa fa-trash-o"></i> Trashed news</a></li>
				<li class="<?php echo $controller->showMenu($uid, "Assign time");?> <?php if($page == 'assigntime') echo 'active';?>"><a href="assigntime"><i class="fa fa-clock-o"></i> Assign time</a></li>
				<li class="<?php echo $controller->showMenu($uid, "News archive");?> <?php if($page == 'archive') echo 'active';?>"><a href="archive"><i class="fa fa-bars"></i> News archive</a></li>
				<li class="<?php echo $controller->showMenu($uid, "Capture news");?> <?php if($page == 'capturenews') echo 'active';?>"><a href="capturenews"><i class="fa fa-plus"></i> Capture news</a></li>
				<li class="<?php echo $controller->showMenu($uid, "Video editor");?> <?php if($page == 'video/editor') echo 'active';?>"><a href="video/editor"><i class="fa fa-bars"></i> Video editor</a></li>
				<li class="<?php echo $controller->showMenu($uid, "Media");?> <?php if($page == 'media') echo 'active';?>"><a href="media"><i class="fa fa-bars"></i> Media</a></li>
			</ul>
		</li>
		<?php
		$katale_privilages = 'Shop,Bids,Items,Orders,Reports';
		$katale_pages = array('shop','bids','items','orders','reports' );
		?>
		<li class="<?php echo $controller->showModule($uid, $katale_privilages);?> treeview <?php if(in_array($page, $katale_pages)) echo 'active';?>">
			<a href="#">
				<i class="fa fa-bars"></i> <span>Katale</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li class="<?php echo $controller->showMenu($uid, "Items");?> <?php if($page == 'items') echo 'active';?>"><a href="items"><i class="fa fa-bars"></i> Items</a></li>
				<li class="<?php echo $controller->showMenu($uid, "Shop");?> <?php if($page == 'shop') echo 'active';?>"><a href="shop"><i class="fa fa-bars"></i> Shop</a></li>
				<li class="<?php echo $controller->showMenu($uid, "Bids");?> <?php if($page == 'bids') echo 'active';?>"><a href="bids"><i class="fa fa-bars"></i> Bids</a></li>
				<li class="<?php echo $controller->showMenu($uid, "Orders");?> <?php if($page == 'orders') echo 'active';?>"><a href="orders"><i class="fa fa-bars"></i> Orders</a></li>
				<li class="<?php echo $controller->showMenu($uid, "Reports");?> <?php if($page == 'reports') echo 'active';?>"><a href="reports"><i class="fa fa-bar-chart"></i> Reports</a></li>
			</ul>
		</li>
		<?php
		$settings_privilages = 'Tasks,Assign tasks,News types,Stations,User types,News times';
		$settings_pages = array('tasks','assigntasks','newstypes','stations','privilages','station','usertypes','newstimes');
		?>
		<li class="<?php echo $controller->showModule($uid, $settings_privilages);?> treeview <?php if(in_array($page, $settings_pages)) echo 'active';?>">
			<a href="#">
				<i class="fa fa-cog"></i> <span>Settings</span>
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<li class="<?php echo $controller->showMenu($uid, "Tasks");?> <?php if($page == 'tasks') echo 'active';?>"><a href="tasks"><i class="fa fa-tasks"></i> Tasks</a></li>
				<li class="<?php echo $controller->showMenu($uid, "Assign tasks");?> <?php if($page == 'assigntasks') echo 'active';?>"><a href="assigntasks"><i class="fa fa-tasks"></i> Assign tasks</a></li>
				<li class="<?php echo $controller->showMenu($uid, "News types");?> <?php if($page == 'newstypes') echo 'active';?>"><a href="newstypes"><i class="fa fa-bars"></i> News types</a></li>
				<li class="<?php echo $controller->showMenu($uid, "Stations");?> <?php if($page == 'station') echo 'active';?>"><a href="station"><i class="fa fa-bars"></i> Stations</a></li>
				<li class="<?php echo $controller->showMenu($uid, "User types");?> <?php if($page == 'usertypes') echo 'active';?>"><a href="usertypes"><i class="fa fa-bars"></i> User types</a></li>
				<li class="<?php echo $controller->showMenu($uid, "Privilages");?> <?php if($page == 'privilages') echo 'active';?>"><a href="privilages"><i class="fa fa-bars"></i> Privilages</a></li>
				<li class="<?php echo $controller->showMenu($uid, "Confidurations");?> treeview <?php if($page == 'configurations') echo 'active';?>"><a href="configurations"><i class="fa fa-bars"></i> Configurations</a></li>
				<li class="<?php echo $controller->showMenu($uid, "News times");?> <?php if($page == 'newstimes') echo 'active';?>"><a href="newstimes"><i class="fa fa-clock-o"></i> News times</a></li>
				<li class="<?php echo $controller->showMenu($uid, "User log");?> <?php if($page == 'userlog') echo 'active';?>"><a href="userlog"><i class="fa fa-bars"></i> User log</a></li>
			</ul>
		</li>
		<li class="<?php echo $controller->showMenu($uid, "Users");?> <?php if($page == 'users') echo 'active';?>"><a href="users"><i class="fa fa-user"></i> Users</a></li>

        <!--<li><a href="settings.php"><i class="fa fa-cogs"></i> Settings</a></li>-->
				<!--<li><a href="schedule.php"><i class="fa fa-cogs"></i> Schedule</a></li>-->


		<!--<li>
			<a href="donate/partners.php">
				<i class="fa fa-bars"></i> <span>Manage Partners</span>
			</a>
		</li>-->




     </ul>
     
  </section>
                <!-- /.sidebar -->
</aside>
