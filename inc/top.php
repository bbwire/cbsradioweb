<?php
  $date = date("Y-m-d");
  
  $get_incoming = $controller->getcustomdata("select * from posts where dateReported = '$date' and status = 'pending' and isTrashed = 0 order by id desc");
  
  $count_incoming = count($get_incoming);
  
  $get_selected = $controller->getcustomdata("select * from posts where status = 'selected'");
  
  $count_selected = count($get_selected);
  ?>
<body class="skin-blue">
<!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                CBS Admin
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        
                    <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-newspaper-o"></i>
                                <span class="label label-success"><?php echo $count_incoming;?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have <?php echo $count_incoming;?> incoming news</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <?php
                                        foreach($get_incoming as $incom)
                                        {
                                          $userid = $incom->user;
                                          $datetime = $incom->date;
                                          
                                          $get_us = $controller->getindividual("users", "id", $userid);
                                          foreach($get_us as $us)
                                          {
                                            $nm = $us->fname.' '.$us->lname;
                                            $photou = $us->photo;
                                          }
                                        
                                          $time_elapsed = $controller->time_elapsed_string($datetime, false);
                                        ?>
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo $photou;?>" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    <?php echo $nm;?>
                                                    <small><i class="fa fa-clock-o"></i> <?php echo $time_elapsed;?></small>
                                                </h4>
                                                <p><?php echo $incom->title;?></p>
                                            </a>
                                        </li><!-- end message -->
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li class="footer"><a href="incoming">See All News</a></li>
                            </ul>
                        </li>

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $name;?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo $img;?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $name;?> - <?php echo "Admin";?>
                                        <!--<small>User since April. 2015</small>-->
                                    </p>
                                </li>
                                <!-- Menu Body -->
                               
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="profile" class="btn btn-primary btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="logout" class="btn btn-primary btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo $img;?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $name;?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>