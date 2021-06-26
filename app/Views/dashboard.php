<?php echo view("parts/header"); if(isset($startOfContentWrapper)){ echo $startOfContentWrapper; } ?>

<section class="content-header">
	<h1>Dashboard</h1>
</section>
<?php $r = $_SESSION['DATA_SESSION']['role']; ?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-body">
					<!-- isi aja -->
				</div>
			</div>
		</div>
	</div>
</section>

<?php if(isset($endOfContentWrapper)){ echo $endOfContentWrapper; } echo view("parts/footer"); ?>

