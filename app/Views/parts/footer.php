		<div style="padding: 0 20px 20px 20px;font-size:small;color:#999;margin-top: -20px;">
			<span id="txt"> &nbsp; </span>
			<div class="pull-right hidden-xs">
				<strong>&copy;<?=date('Y')?> PWA DashBoard Project</strong>
			</div>
		</div>
	</div>
</div>
<script>
	// $(document).ready( function () { $('.dataTable').addClass("table table-striped table-bordered"); } );
	function commonConfirm(){return confirm('Are you sure?');} //show confirmation box
	$('.sidebar-toggle').click(function(){ //remember sidebar collapse state
		hideSide=1;
		if($('body').hasClass('sidebar-collapse')){hideSide=0;} //status just before the toggle is clicked
		$.ajax({type: "POST",url: "<?=base_url('users/setSesData/hideSide')?>/"+hideSide});
	});
	//load server time here
</script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<?php //used by adminLTE: ?>
<script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/fastclick/fastclick.js');?>"></script>
<script src="<?php echo base_url('assets/dist/js/app.js');?>"></script>

<script src="<?= base_url (); ?>/assets/sweatalert/sweetalert2.all.min.js"></script>
<script src="<?= base_url (); ?>/assets/sweatalert/myscript.js"></script>


</body>
</html>