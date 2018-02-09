
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- bootstrap datepicker -->
        <script src="js/plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- Select2 -->
        <script src="js/plugins/select2/dist/js/select2.full.min.js"></script>
        <!-- bootstrap color picker -->
        <script src="js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <!-- bootstrap time picker -->
        <script src="js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes 
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>-->
        <!-- page script -->
        <script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="js/popper.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="js/mdb.min.js"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js"></script>
       
        <script type="text/javascript">
            
            $(function() {

                $('input[type="checkbox"]').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });

                //Enable check and uncheck all functionality
                $(".checkbox-toggle").click(function () {
                    var clicks = $(this).data('clicks');
                    if (clicks) {
                        //Uncheck all checkboxes
                        $("tbody input[type='checkbox']").iCheck("uncheck");
                        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
                    } else {
                        //Check all checkboxes
                        $("tbody input[type='checkbox']").iCheck("check");
                        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
                    }
                    $(this).data("clicks", !clicks);
                });

                $(".datatable").dataTable();
                $("#example1").dataTable();
				$("#example2").dataTable();
                $("#example3").dataTable();
                $("#example4").dataTable();
                $("#example5").dataTable();
                $('#example10').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
        <!-- Page script -->
        <script type="text/javascript">
            $(function() {
                $('.options').select2();
                
                $('.select2').select2();
                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal',
                    radioClass: 'iradio_minimal'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });

                //Colorpicker
                $(".my-colorpicker1").colorpicker();
                //color picker with addon
                $(".my-colorpicker2").colorpicker();

                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false
                });
				//Timepicker
                $(".timepicker2").timepicker({
                    showInputs: false
                });
            });

            //Date picker
            $('#dob').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd"
            })
            
            //Date picker
            $('#jdate').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd"
            })
            
            //Date picker
            $('#deadline').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd"
            })
            
            //Date picker
            $('#start_date').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd"
            })
            
            //Date picker
            $('#end_date').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd"
            })
            
            //Timepicker
            $('#timelabel').timepicker({
            showInputs: false
            })

            function loadApp() {

                // Create the flipbook

                $('.flipbook').turn({
                        // Width

                        width:922,
                        
                        // Height

                        height:600,

                        // Elevation

                        elevation: 50,
                        
                        // Enable gradients

                        gradients: true,
                        
                        // Auto center this flipbook

                        autoCenter: true

                });
            }

            yepnope({
                test : Modernizr.csstransforms,
                yep: ['turnjs/lib/turn.js'],
                nope: ['turnjs/lib/turn.html4.min.js'],
                both: ['turnjs/css/basic.css'],
                complete: loadApp
            });

           
        </script>
		
		<script type="text/javascript">
			$(document).ready(function(){
				$('a[data-toggle=tooltip]').tooltip();
				
				$(".preview").hover(function(){
					var imgdata = $(".imgpath").html();
					$('#blah').attr('src', imgdata);
				});
			});
			
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					
					reader.onload = function (e) {
						//$('#blah').attr('src', e.target.result);
						$(".imgpath").html(e.target.result);
					}
					
					reader.readAsDataURL(input.files[0]);
				}
			}
			
			$("#imgInp").change(function(){
				readURL(this);
			});
			
			
		  </script>

        <script type="text/javascript">
            $(function () {
                $(".font-button").bind("click", function () {
                    var size = parseInt($('.flip-page').css("font-size"));
                    if ($(this).hasClass("plus")) {
                        size = size + 2;
                    } else {
                        size = size - 2;
                        if (size <= 10) {
                            size = 10;
                        }
                    }
                    $('.flip-page').css("font-size", size);
                });
            });
        </script>

<script type="text/javascript">
            $(document).ready(function(){
                $(".starttime").datetimepicker({
                  pickDate: false,
                  minuteStep: 15,
                  pickerPosition: 'bottom-right',
                  format: 'HH:ii p',
                  autoclose: true,
                  showMeridian: true,
                  startView: 1,
                  maxView: 1,
                });
                $(".datetimepicker").find('thead th').remove();
                $(".datetimepicker").find('thead').append($('<th class="switch">').text('Pick Time'));
                $('.switch').css('width','190px');
                });
        </script>
	
     
    </body>
</html>