<?php
// $at = basename($_SERVER['PHP_SELF'], ".php");
// $at = $this->uri->segment(1);
// $at2 = $this->uri->segment(2);
// $ro=$this->session->role;
if (isset($_SESSION['LAST_ACTIVITY'])) {
	$uri =  explode("/", uri_string());
	$at = "";
	$at2 = "";
	$i = 0;
	foreach ($uri as $wow) {
		if ($i == 0) {
			$at = $wow;
		} else if ($i == 1) {
			$at2 = $wow;
		}
		$i = $i + 1;
	}
?>
	<ul class="sidebar-menu">
		<li class="<?= ($at == 'dashboard' || $at == '') ? 'active' : ''; ?>"><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
		<!--li class="<?= ($at == 'rooms') ? 'active' : ''; ?>"><a href="<?php echo base_url('rooms'); ?>"><i class="fa fa-building"></i><span>Rooms</span></a></li-->
		<?php if (in_array($_SESSION['DATA_SESSION']['role'], array('Admin', 'Manager', 'SAA'))) { ?>
			<li class="<?= ($at == 'kuesioner') ? 'active' : ''; ?>"><a href="<?php echo base_url('kuesioner/index'); ?>"><i class="fa fa-question"></i><span>Kuesioner</span></a></li>
			<li class="<?= ($at == 'grup') ? 'active' : ''; ?>"><a href="<?php echo base_url('grup/index'); ?>"><i class="fa fa-tag"></i><span>Grup</span></a></li>
			<li class="<?= ($at == 'pertanyaan') ? 'active' : ''; ?>"><a href="<?php echo base_url('pertanyaan'); ?>"><i class="fa fa-list"></i><span>Pertanyaan</span></a></li>
			<!--li class="<?= ($at == 'form') ? 'active' : ''; ?>"><a href="<?php echo base_url('form'); ?>"><i class="fa fa-building"></i><span>Form Preview</span></a></li-->

			<li class="treeview <?= $at == 'users' ? 'active' : ''; ?>"><a href="#"><i class="fa fa-users"></i><span>Users</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
				<ul class="treeview-menu">
					<li class="<?= ($at == 'users' & $at2 == 'all') ? 'active' : ''; ?>"><a href="<?= base_url('users/all'); ?>"> Kota/Kabupaten</a></li>
					<li class="<?= ($at == 'users' & $at2 == '') ? 'active' : ''; ?>"><a href="<?= base_url('users/index'); ?>">Staf</a></li>
				</ul>
			</li>
		<?php } ?>
	</ul>
<?php } ?>