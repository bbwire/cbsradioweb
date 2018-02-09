<?php

date_default_timezone_set("Africa/Kampala");
define('SMS_RATE', '28');
require_once('application/controller/'. $class .'.php');

$controller = new $class("application");

if(isset($_SESSION['user']))
{
	$uid = $_SESSION['user'];
	
	$settings = $controller->getdata("configurationsettings", "configId", "asc");
	
	$users = $controller->getuser();
	
	$uid = $controller->userid();
	//echo "userid ".$uid;
	$userdetails = $controller->getindividual("users", "id", $uid);
	
	$photo = '';
    $typidd = '';
    $stn = '';
	foreach($userdetails as $userdata)
	{
		$typidd = $userdata->position;
		$name = $userdata->fname.' '.$userdata->lname;
		$photo = $userdata->photo;
		$stn = $userdata->station;
	}
	
	$get_his_role = $controller->getindividual("usertype", "id", $typidd);
	
	foreach($get_his_role as $userrol)
	{
		$role = $userrol->typeName;
    }
    
    $get_his_stn = $controller->getindividual("stations", "id", $stn);
	
	foreach($get_his_stn as $stnn)
	{
		$stion = $stnn->stationName;
	}
	
	if($photo == '')
	{
		$img = "img/user.jpg";
	}
	else
	{
		$img = $photo;
	}
	
}else
{
	header("location:logout.php");
}

$class = 'class="active"';

function trunc($phrase, $max_words) {
   $phrase_array = explode(' ',$phrase);
   if(count($phrase_array) > $max_words && $max_words > 0)
      $phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).'...';
   return $phrase;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php
	
        $this_page = basename($_SERVER['PHP_SELF']);
        
        $split_page = explode('.', $this_page);
        
        $page = $split_page[0];
        
        
        ?>
        <title>CBS Radio  - <?php echo $page;?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!--<link href="css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />-->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <link href="https://www.malot.fr/bootstrap-datetimepicker/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">
         <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="css/datepicker/datepicker3.css">
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Color Picker -->
        <link href="css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
        <!-- Bootstrap time Picker -->
        <link href="css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <!-- DATA TABLES -->
        <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Select2 -->
        <link rel="stylesheet" href="js/plugins/select2/dist/css/select2.css">
        <link rel="stylesheet" href="css/studio.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" >
		<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Material Design Bootstrap 
        <link href="css/mdb.min.css" rel="stylesheet">-->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]
        <script src="js/jquery/dist/jquery.min.js"></script>-->

        <script src="js/jquery-1.7.1.min.js"></script>

        <script src="js/ckeditor/ckeditor.js"></script>

        <script src="https://www.malot.fr/bootstrap-datetimepicker/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

        <!---tinymce-->
        <script src="js/tinymce/tinymce.min.js"></script>

        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/google.charts.customs.js"></script>
    <script src="js/custom-scripts.js"></script>
    <script src="js/jquery.PrintArea.js"></script>
    <script type="text/javascript">
   
    // Load the Visualization API.
    google.load('visualization', '1', {'packages':['corechart']});
     
        // Set a callback to run when the Google Visualization API is loaded.
        google.setOnLoadCallback(drawChart);
      
        function drawChart() {
        var jsonData = $.ajax({
           url: "getData.php",
           dataType:"json",
           async: false
           }).responseText;
          
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable(jsonData);
        var options = {
           title: 'Order Summaries',
           //curveType: 'function',
           legend: { position: 'bottom' },
           width: 800, height: 400
         };
     
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }

    $('#interest_tabs').on('click', 'a[data-toggle="tab"]', function(e) {
      e.preventDefault();

      var $link = $(this);

      if (!$link.parent().hasClass('active')) {

        //remove active class from other tab-panes
        $('.tab-content:not(.' + $link.attr('href').replace('#','') + ') .tab-pane').removeClass('active');

        // click first submenu tab for active section
        $('a[href="' + $link.attr('href') + '_all"][data-toggle="tab"]').click();

        // activate tab-pane for active section
        $('.tab-content.' + $link.attr('href').replace('#','') + ' .tab-pane:first').addClass('active');
      }

    });

    </script>
        
        <script>
        
        tinymce.init({
             mode:'textareas',
            height: 200,
            theme: 'modern',
            plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
            toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat image',
            image_advtab: true,
            editor_selector : "mceEditor",
            editor_deselector : "mceNoEditor",  // change this value according to your HTML
            image_title: true, 
            // enable automatic uploads of images represented by blob or data URIs
            // without images_upload_url set, Upload tab won't show up
    images_upload_url: 'postAcceptor.php',
    
    // override default upload handler to simulate successful upload
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;
      
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', 'postAcceptor.php');
      
        xhr.onload = function() {
            var json;
        
            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }
        
            json = JSON.parse(xhr.responseText);
        
            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }
        
            success(json.location);
        };
      
        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
      
        xhr.send(formData);
    },
            // and here's our custom image picker
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                
                // Note: In modern browsers input[type="file"] is functional without 
                // even adding it to the DOM, but that might not be the case in some older
                // or quirky browsers like IE, so you might want to add it to the DOM
                // just in case, and visually hide it. And do not forget do remove it
                // once you do not need it anymore.

                input.onchange = function() {
                var file = this.files[0];
                
                var reader = new FileReader();
                reader.onload = function () {
                    // Note: Now we need to register the blob in TinyMCEs image blob
                    // registry. In the next release this part hopefully won't be
                    // necessary, as we are looking to handle it internally.
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    // call the callback and populate the Title field with the file name
                    cb(blobInfo.blobUri(), { title: file.name });
                };
                reader.readAsDataURL(file);
                };
                
                input.click();
            }
            
             
        });
        </script>
        <script type="text/javascript" src="turnjs/extras/modernizr.2.5.3.min.js"></script>

        <script type="text/javascript">
                function delete_confirm(){
                    var result = confirm("Are you sure you want to continue?");
                    if(result){
                        return true;
                    }else{
                        return false;
                    }
                }
        </script>
        <script type="text/javascript">
            $(document).ready(function(e) {
                $("button[name='deletemulti']").click(function(){
                    var check = $("td input:checkbox.flat:checked").val();
                    
                    if(!check){
                        $("div.error").html('<div class="alert alert-danger alert-dismissable no-print"><i class="fa fa-check"></i>			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Please select record(s) to delete</div>'); 
                        return false;
                    }else{
                        $("div.error").html('');
                    }
                });
                
                $("td input:checkbox").on("ifChecked", function(event){
                    $("div.info").html('');
                });
            });
        </script>

        <script type="text/javascript">
	
        (function($)
        {
            $(document).ready(function()
            {
                $.ajaxSetup(
                {
                    cache: false,
                    beforeSend: function() {
                        //$('#content').hide();
                        $('#loading').show().fadeIn("fast");
                    },
                    complete: function() {
                        $('#loading').hide().fadeOut("slow");
                        $('#content').show().fadeIn("fast");
                    },
                    success: function() {
                        $('#loading').hide().fadeOut("slow");
                        $('#content').show().fadeIn("fast");
                    }
                });
                var $container = $("#content");
                $container.load("ajaxrequests.php?incoming").fadeOut("fast");
                var refreshId = setInterval(function()
                {
                    $container.load('ajaxrequests.php?incoming').fadeIn("fast");
                }, 19000);
            });
        })(jQuery);
        </script>

        <script>
        $(document).ready(function(){
            $("#printButton").click(function(){
                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = { mode : mode, popClose : close};
                $("div.printableArea").printArea( options );
            });
        });
        </script>
		
		
        
        <style>
            .color-black{
                color:#222 !important;
            }
            .hidemenu{
                display:none !important;
            }
            .isbold{
                font-weight:bold !important;
            }

                .flip-page
                {
                    font-family: Arial;
                    font-size: 16px;
                }
                .font-button
                {
                    
                    display: inline-block;
                    color: #fff;
                    text-align: center;
                    cursor: pointer;
                }

                
            
        </style>    
            
    </head>