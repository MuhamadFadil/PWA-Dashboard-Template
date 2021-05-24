<?php 
$data = ['simple' => true, 'add_body_class' => 'login-page', 'title' => 'Pop-Up'];
$this->load->view('parts/header', $data); ?>
<div class="login-box">
	<p class="login-logo"><b><?php echo $err; ?></b><br />
	<div class="login-box-body">
		<form action="<?=base_url('Login');?>" method="post">
			<button class="btn btn-primary btn-block btn-flat" type="submit">Back to Login</button>
		</form>
	 </div>
</div>