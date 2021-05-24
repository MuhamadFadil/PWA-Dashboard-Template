<?php 
$data = ['simple' => true, 'add_body_class' => 'login-page', 'title' => 'Activate Account'];
$this->load->view('parts/header', $data); ?>
<div class="login-box">
	<div class="login-box-body">
		<form action="<?=base_url('Forget_Reset/AktivasiAkun');?>" method="post" id="Activate Account">
			<p class="login-logo">Resend Activation Link
			<p class="login-box-msg"><b><?php echo $err; ?></b>
			<div id="q"><i>Please type your registered email address</i></div>
			<div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="Email" name="email"><br />
				<div id="q"><i>We will send you an email to activate your account</i></div>
			</div>
				<button class="btn btn-primary btn-block btn-flat" type="submit">Submit</button>
		 </form><p>
		 <form action="<?=base_url('Login');?>" method="post" id="forgot">
				<button class="btn btn-primary btn-block btn-flat" type="submit">Back to Login</button>
		 </form>
	 </div>
</div>