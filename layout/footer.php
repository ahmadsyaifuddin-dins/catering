</div> <!-- /container -->
    </div> <!-- /container -->
	
	<div class="container footer" style="margin-top:20px;" >
		<br/>
		<footer class="text-center">
			<div class="col-md-12 "> <b>&#169; Asai's Kitchen <span id="year"> </span> | AS Katering Online</b> 
			<br>
			<br>
			</div>
		</footer>
	</div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo $url ?>assets/js/jquery.js"></script>
    <!--<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->
    <script src="<?php echo $url ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug 
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
	
	<script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
	
	<script src="<?php echo $url ?>assets/bootstrap/js/moment.js"></script>
		<script src="<?php echo $url ?>assets/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript">
			$(function () {
				$('#datetimepicker').datetimepicker({
					format: 'YYYY-MM-DD HH:mm',
                });
				
				// $('#datepicker').datetimepicker({
					// format: 'DD MMMM YYYY',
				// });
				
				// $('#timepicker').datetimepicker({
					// format: 'HH:mm'
				// });
			});

			// Get Year Dynamic
			document.getElementById("year").innerHTML = new Date().getFullYear();
		</script>
  </body>
</html>
