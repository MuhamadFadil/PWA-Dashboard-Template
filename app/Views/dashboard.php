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
					<?php if($r == 'Kota'){ //======================================================= ?>
						<h4>Daftar Kuesioner</h4>
						<?php
						$uid = $_SESSION['DATA_SESSION']['id'];
						$db = \Config\Database::connect();
						$entry = $db->query("select * from kuesioner where status != 'draft'")->getResult();
						if(isset($entry)){ ?>
							<table class="table"><thead><tr><th>Kuesioner</th><th>Action</th></tr></thead>
								<tbody>
								<?php foreach ($entry as $judul) {
									$isitext = "Mulai Pengisian";
									$check = $db->table('jawaban_draft')->where('user', $uid)->where('kuesioner',  $judul->id)->get()->getRow();
									$check2 = $db->table('jawaban_final')->where('user', $uid)->where('kuesioner',  $judul->id)->get()->getRow();
									$drafted = '';
									if (isset($check)) { //sudah ada draft
										$isitext = "Lanjutkan Pengisian";
										$drafted = " Last draft at " . $check->date;
									} else { //belum ada draft
										$isitext = "Mulai Pengisian";
									}
								?>
									<tr>
										<td>
											<?php echo $judul->name;
											if($judul->guide_kota!=''){ ?>
												<a target="_blank" href="<?=base_url('assets/uploads/files/'.$judul->guide_kota)?>" class="btn btn-success"><i class="fa fa-download"></i> Panduan (PDF)</a>
											<?php } ?>
										</td>
										<td>
											<?= is_null($check2) ? '<a class="btn btn-success" href="' . base_url('/isi/isi/'.$judul->id). '">' . $isitext . '</a>'. $drafted : '<a href="' . base_url('isi/isi/' . $judul->id) . '" class="btn btn-default">Lihat Jawaban</a> &nbsp; Submitted at ' . $check2->date ?>
										</td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						<?php }else{ echo 'Tidak ada kuesioner.'; }
					}elseif($r == 'Reviewer'){  //======================================================= ?>
						<h4>Your Review Assignment</h4>
						<?php
						$uid = $_SESSION['DATA_SESSION']['id'];
						$kota = $_SESSION['DATA_SESSION']['kota'];
						$db = \Config\Database::connect();
						$entry = $db->query("select k.*,ra.user as uid, concat(u.kota, ', ', u.provinsi) as kota 
							from kuesioner k
							inner join review_assignment ra on ra.kuesioner = k.id
							join users u on u.id = ra.user
							where k.status != 'draft'
							AND ra.reviewer =  '$uid'")->getResult();
						if (isset($entry)) { ?>
							<table class="table"><thead><tr><th>Kuesioner</th><th>Kota/Kabupaten</th><th>Action</th><th></th></tr></thead>
								<tbody>
								<?php foreach ($entry as $judul) {
									$check  = $db->table('jawaban_draft')->where('user', $_SESSION['DATA_SESSION']['id'])->where('yg_direview', $judul->uid)->where('kuesioner',  $judul->id)->get()->getRow();
									$check2 = $db->table('jawaban_final')->where('user', $_SESSION['DATA_SESSION']['id'])->where('yg_direview', $judul->uid)->where('kuesioner',  $judul->id)->get()->getRow(); //isian reviewer ini sendiri
									$check3 = $db->table('jawaban_final')->where('user', $judul->uid)                                                       ->where('kuesioner',  $judul->id)->get()->getRow(); //isian kota
									$drafted = '';
									if (isset($check)) {
										$isitext = "Lanjutkan Pengisian";
										$drafted = " Drafted at: " . $check->date;
									} else {
										$isitext = "Mulai Pengisian";
									}
								?>
									<tr>
										<td>
												<?php echo $judul->name;
												if($judul->guide_reviewer!=''){ ?>
												<a target="_blank" href="<?=base_url('assets/uploads/files/'.$judul->guide_reviewer)?>" class="btn btn-success"><i class="fa fa-download"></i> Panduan (PDF)</a>
											<?php } ?>
											</td>
											<td>
												<?php echo $judul->kota; ?>
											</td>
											<td>
											<?php if (isset($check3)){ ?>
												<?= is_null($check2) ? '<a class="btn btn-success" href="' . base_url('/hasil/view/'.$judul->id) . '/' . $judul->uid . '">' . $isitext . '</a>' . $drafted : '<a href="' . base_url('/hasil/view/' . $judul->id . '/' . $judul->uid) . '" class="btn btn-default">Lihat Jawaban</a> &nbsp; Submitted at ' . $check2->date ?>
											<?php } else {
												echo "Kota yang akan direview belum mengisi kuesioner.";
												}?>
											</td>
										</tr>
								<?php } ?>
								</tbody>
							</table>
					<?php } else { echo "No review assignment."; }} ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php if(isset($endOfContentWrapper)){ echo $endOfContentWrapper; } echo view("parts/footer"); ?>

