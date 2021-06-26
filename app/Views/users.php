<?php
$data = ['css_files' => $css_files, 'js_files' => $js_files];
echo view("parts/header", $data); 
?>
<script>
$(function() {
    $('#kota').change(function(e) {
        var selected = $(e.target).val();
        $("#kotareview").val(selected);
    }); 
});
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#kota option").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Account Details
			<!--small>Control panel</small-->
		</h1>
		<!--ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Account Details</li>
      </ol-->
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">

			<div class="col-md-12">
				<div class="box">
					<div class="box-body">

						<?php echo $output; ?>
					</div>
				</div>
			</div>

		</div>
	</section>

	<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				Loading... </div>
		</div>
	</div>

	<script type="text/javascript">
		$(".cloneQuarterSchedule").click(function(e) {
			e.stopPropagation();
		});

		var myModalContent = '';
		$('button.close').on('click', function(e) {
			$('#myModal').modal('hide');
		})
		// $("#myModal .close").click(function(){$("#myModal").hide();});
		$('[data-load-remote]').on('click', function(e) {
			e.preventDefault();
			var $this = $(this);
			var remote = $this.data('load-remote');
			if (remote) {
				if (myModalContent != remote) { //update only when the URL is different
					$($this.data('remote-target')).html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title" id="myModalLabel">Loading...</h4></div>');
					myModalContent = remote;
					$($this.data('remote-target')).load(remote);
					if ($this.data('manual-toggle')) {
						setTimeout(function() {
							$('#myModal').modal('show');
						}, 100);
						// alert('a');
						// setTimeout(function(){alert('a');},2000);
						//
					}
				}
			}
		});
	</script>

</div>

<script>
	var data;
	$("body").on('DOMSubtreeModified', "#field_kota_chosen span", function() {

		$.getJSON("<?php echo base_url("assets/provinsi.json"); ?>", function(result) {
			$("#field-provinsi").html(result[$("#field_kota_chosen span").html()]);
		});
	});
</script>

<!-- /.content-wrapper -->
<?php echo view("parts/footer"); ?>