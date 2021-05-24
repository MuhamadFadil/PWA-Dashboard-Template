<?php
// use CodeIgniter\Session\Session;
echo view("parts/header");
echo view("parts/settingView");

?>

<!DOCTYPE html>
<html lang="en">
<head>

</head>

<body>
	<section class="content-header">
	<h1>Data Subscribers</h1>
	</section>
	<section class="content">
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
											<th>Kota/Kabubapten</th>
											<th>Auth</th>
											<th>Data Access</th>
											<th>Action</th>
											<!-- <th>auth</th> -->
										</tr>
									</thead>
									<tbody>

										<?php
										$no = 0;
										foreach ($tampil as $row) {
											$no++;
										?>
											<tr>
												<td><?= $no ?></td>
												<!-- <td><?= $row->id_user?></td> -->
												<td><?= $row->name_user?></td>
												<td><?= $row->kota_user?></td>
												<td><?= $row->auth?></td>
												<td><?= $row->log?></td>
												<td>
													<!-- referensi pdq code icons: http://www.pdqcoders.com/font-based-icons.html -->
													<!-- https://material.io/components/menus#usage -->
													<!-- <a href="#test" onclick="window.location='<?php echo site_url('setting/sendAll')?>'" class="test" data-toggle="modal"><i class="material-icons md-dark" data-toggle="tooltip" title="Test Push">&#xe627;</i></a> -->
													<a href="#test" onclick="sendAll('<?= $row->id_subs ?>')" class="test" data-toggle="modal" id="tombol"><i class="material-icons md-dark" data-toggle="tooltip" title="Test Push">&#xe627;</i></a>

													<a href="#kirimPesan" class="kirim" data-toggle="modal" data-whatever="<?= $row->name_user?>" data-whatever2="<?= $row->kota_user?>"><i class="material-icons md-light orange" data-toggle="tooltip" title="Kirin Pesan">&#xe0c9;</i></a>			

														<div class="modal fade" id="kirimPesan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="kirimPesanLabel">New message</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																<form>
																<div class="form-group">
																	<label for="recipient-name" class="col-form-label">Recipient:</label>
																	<input type="text" class="form-control" id="recipient-name">
																</div>
																<div class="form-group">
																	<label for="message-text" class="col-form-label">Message:</label>
																	<textarea class="form-control" id="message-text"></textarea>
																</div>
																</form>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																<button type="button" class="btn btn-primary">Send message</button>
															</div>
															</div>
														</div>
														</div>
														<script>
															$('#kirimPesan').on('show.bs.modal', function (event) {
															var a = $(event.relatedTarget) // Button that triggered the modal
															var recipient = a.data('whatever') // Extract info from data-* attributes
															// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
															// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
															var b =  $(event.relatedTarget)
															var kota = b.data('whatever2'); 
															var modal = $(this)
															modal.find('.modal-title').text('To ' + recipient)
															modal.find('.modal-body input').val(recipient + '['+ kota +']')
															// modal.find('.modal-body message-text').val(kota)
															})
														</script>

													<a href="#deteleSubscriber" onclick="hapus('<?= $row->id_subs ?>')" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
												</td>
											</tr>
										<?php } ?>

									</tbody>
								</table>

									<script type="text/javascript"> 
										function sendAll(id_subs){
											pesan = confirm('kirim data ?');
											
											if(pesan){
												window.location.href=("<?= site_url('setting/sendAll/') ?>") + id_subs; 
											}else return false; 
										}
									
									</script>

									<script type="text/javascript"> 
										function hapus(id_subs){
											const swalWithBootstrapButtons = Swal.mixin({
												customClass: {
													confirmButton: 'btn btn-success',
													cancelButton: 'btn btn-danger'
												},
												buttonsStyling: false
												})

												swalWithBootstrapButtons.fire({
												title: 'Yakin hapus data?',
												text: "Data subscriber akan terhapus",
												icon: 'warning',
												showCancelButton: true,
												confirmButtonText: 'Iya, hapus!',
												cancelButtonText: 'Tidak, batal!',
												reverseButtons: true
												}).then((result) => {
												if (result.isConfirmed) {
													window.location.href=("<?= site_url('setting/hapus/') ?>") + id_subs;

													swalWithBootstrapButtons.fire(
													'Terhapus!',
													'Data berhasil terhapus.',
													'success'
													)
												} else if (
													/* Read more about handling dismissals below */
													result.dismiss === Swal.DismissReason.cancel
												) {
													swalWithBootstrapButtons.fire(
													'Batal',
													'Data tidak terhapus',
													'error'
													)
												}
												})
											// pesan = confirm('Yakin hapus data user ?');
											
											// if(pesan){
											// 	window.location.href=("<?= site_url('setting/hapus/') ?>") + id_subs; 
											// }else return false; 
										}
									</script>

									<script>
										
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
<script src="/scripts/main.js"></script>
</html>
<br>
<?php echo view("parts/footer"); ?>





