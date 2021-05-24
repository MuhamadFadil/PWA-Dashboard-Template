<?php
$data = ['form_editor' => true];
echo view("parts/header", $data);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- base CSS classes (required) -->
	<!-- <link href="assets/master-icon/css/material-icons-base.min.css" rel="stylesheet"> -->

	<!-- loads Material Icons Regular font -->
	<!-- <link href="assets/master-icon/css/material-icons-regular.min.css" rel="stylesheet"> -->

	<!-- loads Material Icons Outlined font -->
	<!-- <link href="assets/master-icon/css/material-icons-outlined.min.css" rel="stylesheet"> -->

	<!-- loads Material Icons Round font -->
	<!-- <link href="assets/master-icon/css/material-icons-round.min.css" rel="stylesheet"> -->

	<!-- loads Material Icons Sharp font -->
	<!-- <link href="assets/master-icon/css/material-icons-sharp.min.css" rel="stylesheet"> -->

	<!-- loads Material Icons Two Tone font -->
	<!-- <link href="assets/master-icon/css/material-icons-two-tone.min.css" rel="stylesheet"> -->

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- loads Material Icons Outlined font -->
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">

	<!-- loads Material Icons Round font -->
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons+Round" rel="stylesheet">

	<!-- loads Material Icons Sharp font -->
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet">

	<!-- loads Material Icons Two Tone font -->
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons+Two+Tone" rel="stylesheet">

	<style>
		.material-icons {
			font-family: 'Material Icons';
			font-weight: normal;
			font-style: normal;
			font-size: 24px;
			/* Preferred icon size */
			display: inline-block;
			line-height: 1;
			text-transform: none;
			letter-spacing: normal;
			word-wrap: normal;
			white-space: nowrap;
			direction: ltr;

			/* Support for all WebKit browsers. */
			-webkit-font-smoothing: antialiased;
			/* Support for Safari and Chrome. */
			text-rendering: optimizeLegibility;

			/* Support for Firefox. */
			-moz-osx-font-smoothing: grayscale;

			/* Support for IE. */
			font-feature-settings: 'liga';

		}

		/* material coloring */
		.material-icons.md-dark {
			color: rgba(0, 0, 0, 0.54);
		}

		.material-icons.md-dark.md-inactive {
			color: rgba(0, 0, 0, 0.26);
		}

		.material-icons.md-light {
			color: rgba(255, 255, 255, 1);
		}

		.material-icons.md-light.md-inactive {
			color: rgba(255, 255, 255, 0.3);
		}

		.material-icons.orange {
			color: #FB8C00;
		}
	</style>

</head>

<body>

	<section class="content-header">
		<h1>Data Subscribers</h1>
	</section>
	<section class="content">
		<?php if (in_array($_SESSION['DATA_SESSION']['role'], array('Admin', "reviewer"))) { ?>
			<!-- <div class="table-responsive"> -->
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Subscribers:</h3>
							<div class="box-tools pull-right">
								<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							<div class="table-responsive">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>No.</th>
											<th>Subcribers</th>
											<!-- <th>Kota/Kabubapten</th> -->
											<th>Auth</th>
											<th>Data Access</th>
											<th>Action</th>
											<!-- <th>auth</th> -->
										</tr>
									</thead>
									<tbody>

										<?php
										//$query = mysqli_query($conn, "SELECT * FROM subscriber INNER JOIN users ON subscriber.user_subs = users.id");
										$no = 0;
										foreach ($tampil as $row) {
											$no++;
										?>

											<tr>
												<td><?= $no ?></td>
												<td><?= $row->id_user?></td>
												<!-- <td><?= $row->id_subs?></td> -->
												<td><?= $row->auth?></td>
												<td><?= $row->log?></td>
												<td>
													<!-- referensi pdq code icons: http://www.pdqcoders.com/font-based-icons.html -->
													<!-- https://material.io/components/menus#usage -->
													<a href="#test" onclick="window.location='<?php echo site_url('setting/broadcast')?>'" class="test" data-toggle="modal"><i class="material-icons md-light orange" data-toggle="tooltip" title="Test Push">&#xe627;</i></a>
													<a href="#kirimPesan" class="kirim" data-toggle="modal"><i class="material-icons md-light orange" data-toggle="tooltip" title="Kirin Pesan">&#xe0c9;</i></a>

														<!-- Modal -->
														<div class="modal fade" id="kirimPesan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">Kirim Pesan</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																...
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																<button type="button" class="btn btn-primary">Send Message</button>
															</div>
															</div>
														</div>
														</div>

													<a href="#deteleSubscriber" onclick="hapus('<?= $row->id_subs ?>')" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
												</td>
											</tr>
										<?php } ?>

									</tbody>
								</table>
										<script>
										function hapus(id_subs){
											pesan = confirm('Yakin hapus data user ?');
											
											if(pesan){
												window.location.href=("<?= site_url('setting/hapus/') ?>") + id_subs; 
											}else return false; 
										}
									</script>
							</div>
							<?php if (count($tampil) == 0) {
								echo '<center><br><i>Empty.</i></center>';
							} ?>

						</div>
					</div>
				</div>

			</div>
			<!-- </div> -->
		<?php } ?>

		<!-- <section class="subscription-details js-subscription-details is-invisible">
			<p><a href="https://web-push-codelab.glitch.me//">Push Companion
					Site</a></p>
					<p>Subscribe:</p>
			<pre><code class="js-subscription-json"></code></pre>
		</section> -->

		<!-- <div class="container mt-3 mb-3" style="background-color:#dfdfdf; height: 250px; border-radius: 15px;">
			<br>
			<h3 class="mt-2 mb-2" style="text-align: left;">Subscription JSON:</h3>
			<span class="m-3" id="subscription-json" style="font-size: 24px; overflow-wrap: break-word;"></span>
		</div> -->
	</section>
</body>
<script src="/scripts/app.js"></script>

</html>
<br>
<?php echo view("parts/footer"); ?>