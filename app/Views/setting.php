<?php echo view("parts/header");
// echo view("parts/upup");
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
												<td><?= $row->name_user?></td>
												<td><?= $row->kota_user?></td>
												<td><?= $row->auth?></td>
												<td><?= $row->log?></td>
												<td>
													
													<a href="#broadcast" onclick="window.location='<?php echo site_url('setting/sendPushMessage')?>'" class="test" data-toggle="modal"><i class="material-icons md-dark" data-toggle="tooltip" title="Test Push">&#xe627;</i></a>
													
										
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
																<button type="button" onclick="custom_user('<?= $row->id_subs ?>')" class="btn btn-primary">Send message</button>
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
															modal.find('.modal-title').text('Message to ' + recipient)
												// 			modal.find('.modal-body input').val(recipient)
												modal.find('.modal-body input').val(recipient + ' ['+ kota +']')
															})
														</script>

													<a href="#deteleSubscriber" onclick="hapus('<?= $row->id_subs ?>')" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
												</td>
											</tr>
										<?php } ?>

									</tbody>
								</table>
								
								
									<script type="text/javascript"> 
									
										function sendPushMessage(id){
											pesan = confirm('Coba kirim data' + '?');
											
											if(pesan){
												window.location.href=("<?= site_url('/setting/test2/') ?>") + id_user;
											
											}
											else return false; 
										}
									
									</script>
									
									<script type="text/javascript">
								// 	sessionStorage.setItem('custom_ID', '<?= $row->id_subs?>');
									    function custom_user(id_subs){
									    	pesan = confirm('Coba kirim data' + '?');
									  
											if(pesan){
												window.location.href=("<?= site_url('/setting/custom_user/') ?>")+id; 
											}else return false; 
										}
									    
									</script>
								
								<script type="text/javascript"> 
										function hapus(id){
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
													window.location.href=("<?= site_url('/setting/hapus/') ?>") + id;

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
	</section>
</body>
<script src="/scripts/main.js"></script>

<script>
localStorage.setItem('nama', '<?php echo $_SESSION['DATA_SESSION']['name'];?>');
localStorage.setItem('id', '<?php echo $_SESSION['DATA_SESSION']['id'];?>');
// sessionStorage.setItem('userID', '<?= $row->id_user?>');
</script>

</html>
<br>
<?php echo view("parts/footer"); ?>





