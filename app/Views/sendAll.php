<?php
$data = ['form_editor' => true];
echo view("parts/header", $data); ?>

<section class="content-header">
	<h1>Send Notification</h1>
	<br>
	<div style="text-align:left;">
		<a href="<?php echo base_url("setting/broadcast"); ?>" class="btn btn-primary" role="button">Broadcast<br><small>(Semua subscriber)</small></a>
        <br>
        <br>
		<a href="<?php echo base_url("setting/custom"); ?>" class="btn btn-default" role="button">Custom<br><small>(Pilih subscriber)</small></a>
		<br>
	</div>
</section>
<br>
<br>

<?php echo view("parts/footer"); ?>