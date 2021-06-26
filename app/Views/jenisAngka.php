<?php
echo view("parts/header"); 
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
					<b>Pertanyaan:</b>
					<table>
						<tr>
							<td>Kuesioner</td><td> &nbsp; : &nbsp; </td><td> <?=$o->kname?> (<?=$o->kkode?>)</td>
						</tr><tr>
							<td>Status Kuesioner</td><td> &nbsp; : &nbsp; </td><td> <?=$o->status?> </td>
						</tr><tr>
							<td>Grup</td><td> &nbsp; : &nbsp; </td><td> <?=$o->gname?> (<?=$o->gkode?>)</td>
						</tr><tr>
							<td>Teks Pertanyaan</td><td> &nbsp; : &nbsp; </td><td> <?=trim(strip_tags($o->teks))?> <small><a target="_blank" href="<?=base_url('pertanyaan#/edit/'.$o->pid)?>">(Edit Pertanyaan)</a></small></td>
						</tr><tr>
							<td>Hint</td><td> &nbsp; : &nbsp; </td><td><?=$o->hint?></td>
						</tr><tr>
							<td>Kode Pertanyaan</td><td> &nbsp; : &nbsp; </td><td><?=$o->kode?></td>
						</tr><tr>
							<td>Skor maksimal yang dapat diperoleh</td><td> &nbsp; : &nbsp; </td><td><?=$o->max_score?></td>
						</tr>						
					</table>
					<br><b>Ketentuan isian angka:</b>
					<?php $e = ' disabled '; if(isset($canEdit) && $canEdit==1){$e = '';} ?>
					<form <?php if(isset($canEdit) && $canEdit==1){ ?>method="post" action="<?=base_url('jenisAngka/save')?>"<?php } ?> >
						<input type="hidden" name="id" value="<?=$o->id?>">
						<div class="form-group">
							<div class="col-sm-2 control-label">Min</div>
							<div class="col-sm-10"><input class="form-control input-sm" <?=$e?> style="width:150px" name="min" type="number" value="<?=$o->min?>"></div>
						</div>
						<div class="form-group">
							<div class="col-sm-2 control-label">Max</div>
							<div class="col-sm-10"><input class="form-control input-sm" <?=$e?> style="width:150px" name="max" type="number" value="<?=$o->max?>"></div>
						</div>
						<div class="form-group">
							<div class="col-sm-2 control-label">Jumlah angka di belakang koma</div>
							<div class="col-sm-10"><input class="form-control input-sm" <?=$e?> style="width:150px" name="decimal_place" type="number" value="<?=$o->decimal_place?>"></div>
						</div>
						<div class="form-group">
							<?php if(isset($canEdit) && $canEdit==1){ ?>
							<input type="submit" class="btn btn-primary" value="Save">
							<?php }else{echo '&nbsp;<br><i>Tidak bisa edit karena kuesioner yang mengandung pertanyaan ini tidak berstatus draft.</i><br>';} ?>
							<a href="<?=base_url('pertanyaan#/read/'.$o->pid)?>" class="btn btn-warning">Back</a>
							<?php if(isset($success) && $success ==1 ){ echo '<i><small onclick="$(this).hide()">Penyimpanan berhasil (click to hide)</small></i>'; } ?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<?php if(isset($endOfContentWrapper)){ echo $endOfContentWrapper; } ?>
<?php echo view("parts/footer"); ?>