<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
</div>
<div class="modal-body">
	<?php echo $output->output; ?>
</div>
<!--div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<?php if(isset($actionUrl)){ ?>
	<button type="button" class="btn btn-primary">Save</button>
	<?php } ?>
</div-->