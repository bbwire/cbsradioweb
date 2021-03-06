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
                <section class="content">
                    <!-- Custom Tabs -->
                    <ul class="nav nav-tabs" id="interest_tabs">
    <!--top level tabs-->
  <li><a href="#all" data-toggle="tab">All</a></li>
  <li><a href="#brands" data-toggle="tab">Brands</a></li>
  <li><a href="#media" data-toggle="tab">Media</a></li>
  <li><a href="#music" data-toggle="tab">Music</a></li>
  <li><a href="#public_figures" data-toggle="tab">Public Figures</a></li>
  <li><a href="#sports" data-toggle="tab">Sports</a></li>
  <li><a href="#tv_movies" data-toggle="tab">TV/Movies</a></li>
</ul>

<!--top level tab content-->
<div class="tab-content">
    <!--all tab menu-->
    <div id="all" class="tab-pane">
        <ul class="nav nav-tabs" id="all_tabs">
            <li><a href="#all_popular" data-toggle="tab">Popular</a></li>
            <li><a href="#all_unique" data-toggle="tab">Unique</a></li>
        </ul>
    </div>
    
    <!--brands tab menu-->
    <div id="brands" class="tab-pane">
        <ul class="nav nav-tabs" id="brands_tabs">
            <li><a href="#brands_popular" data-toggle="tab">Popular</a></li>
            <li><a href="#brands_unique" data-toggle="tab">Unique</a></li>
        </ul>
    </div>
  
    <!--media tab menu-->
    <div id="media" class="tab-pane">
        <ul class="nav nav-tabs" id="media_tabs">
            <li><a href="#media_popular" data-toggle="tab">Popular</a></li>
            <li><a href="#media_unique" data-toggle="tab">Unique</a></li>
        </ul>
    </div>
  
    <!--music tab menu-->
    <div id="music" class="tab-pane">
        <ul class="nav nav-tabs" id="music_tabs">
            <li><a href="#music_popular" data-toggle="tab">Popular</a></li>
            <li><a href="#music_unique" data-toggle="tab">Unique</a></li>
        </ul>
    </div>
  
    <!--public_figures tab menu-->
    <div id="public_figures" class="tab-pane">
        <ul class="nav nav-tabs" id="public_figures_tabs">
            <li><a href="#public_figures_popular" data-toggle="tab">Popular</a></li>
            <li><a href="#public_figures_unique" data-toggle="tab">Unique</a></li>
        </ul>
    </div>
  
    <!--sports tab menu-->
    <div id="sports" class="tab-pane">
        <ul class="nav nav-tabs" id="sports_tabs">
            <li><a href="#sports_popular" data-toggle="tab">Popular</a></li>
            <li><a href="#sports_unique" data-toggle="tab">Unique</a></li>
        </ul>
    </div>
  
  <!--tv/movies tab menu-->
    <div id="tv_movies" class="tab-pane">
        <ul class="nav nav-tabs" id="tv_movies_tabs">
            <li><a href="#tv_movies_popular" data-toggle="tab">Popular</a></li>
            <li><a href="#tv_movies_unique" data-toggle="tab">Unique</a></li>
        </ul>
    </div>
  
  
  
 </div>
  
    <!--all tab content-->
    <div class="tab-content">
        <div id="all_popular" class="tab-pane">
            <i>all_popular interests go here</i>
        </div>
        <div id="all_unique" class="tab-pane">
            <i>all_unique interests go here</i>
        </div>
    </div>

    <!--brands tab content-->
    <div class="tab-content">
        <div id="brands_popular" class="tab-pane">
            <i>brands_popular interests go here</i>
        </div>
        <div id="brands_unique" class="tab-pane">
            <i>brands_unique interests go here</i>
        </div>
    </div>

    <!--media tab content-->
    <div class="tab-content">
        <div id="media_popular" class="tab-pane">
            <i>media_popular interests go here</i>
        </div>
        <div id="media_unique" class="tab-pane">
            <i>media_unique interests go here</i>
        </div>
    </div>

    <!--music tab content-->
    <div class="tab-content">
        <div id="music_popular" class="tab-pane">
            <i>music_popular interests go here</i>
        </div>
        <div id="music_unique" class="tab-pane">
            <i>music_unique interests go here</i>
        </div>
    </div>

    <!--public_figures tab content-->
    <div class="tab-content">
        <div id="public_figures_popular" class="tab-pane">
            <i>public_figures_popular interests go here</i>
        </div>
        <div id="public_figures_unique" class="tab-pane">
            <i>public_figures_unique interests go here</i>
        </div>
    </div>

    <!--sports tab content-->
    <div class="tab-content">
        <div id="sports_popular" class="tab-pane">
            <i>sports_popular interests go here</i>
        </div>
        <div id="sports_unique" class="tab-pane">
            <i>sports_unique interests go here</i>
        </div>
    </div>

    <!--tv_movies tab content-->
    <div class="tab-content">
        <div id="tv_movies_popular" class="tab-pane">
            <i>tv_movies_popular interests go here</i>
        </div>
        <div id="tv_movies_unique" class="tab-pane">
            <i>tv_movies_unique interests go here</i>
        </div>
    </div>

</div>
                   
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <?php require_once('inc/footer.php');?>