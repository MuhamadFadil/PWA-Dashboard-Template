<?php
$data = array();
if(isset($output)){ 
	$data = ['css_files' => $css_files, 'js_files' => $js_files];
}
echo view("parts/header", $data); 
if(isset($startOfContentWrapper)){ echo $startOfContentWrapper; }
if(isset($additionalContentTop)){ ?>
<div id="kandang" style="display:none"><?=$additionalContentTop?></div>
<script>$(document).ready(function(){$('.panel-body').prepend($('#kandang'));$('#kandang').show();});</script>
<?php } ?>

<section class="content-header">
	<h1><?=isset($title) ? $title : ''?><small><?=isset($title2)?$title2:''?></small></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-body">
					<?php 
					if(isset($beforeOutput)){ echo $beforeOutput; }
					if(isset($output)){ echo $output; }
					?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php if(isset($endOfContentWrapper)){ echo $endOfContentWrapper; } ?>
<?php 
// echo '<script>
// var data;
// $("body").on("DOMSubtreeModified", "#field_kota_chosen span", function() {
// 	$.getJSON('.base_url("assets/provinsi.json").', function(result) {
// 		$("#field-provinsi").html(result[$("#field_kota_chosen span").html()]);
// 	});
// });
// </script>'; 
?>
<?php echo view("parts/footer"); ?>