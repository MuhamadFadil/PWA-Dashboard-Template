<?php
$data = [
	"title" => "Forgot Password",
];
echo view("parts/header_front", $data); ?>

<body class="hold-transition skin-red  login-page">
	<div class="login-box">
		<div class="login-box-body">
			<form action="confirm" method="post" id="confirm">
				<p class="login-logo">Forgot Password<br />
					<p class="login-box-msg"><b><?php if (isset($err)) {
													echo $err;
												} ?></b>
							<div id="q">Enter new password:</div>
						<div class="input-group has-feedback" id="show_hide_password">
							<input type="password" class="form-control" placeholder="Password" name="password">
							<div class="input-group-addon">
								<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
							</div>
						</div>
						<div class="input-group has-feedback" id="show_hide_password">
							<input type="password" class="form-control" placeholder="Retype Password" name="password2">
							<div class="input-group-addon">
								<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
							</div>
						</div>
      <div class="form-group has-feedback">
				<div id="q"><br><?php if(isset($question)){echo $question;} ?></div>
				<input type="password" class="form-control" placeholder="?" name="date">
      </div>

						<button class="btn btn-primary btn-block btn-flat" type="submit">Submit</button>
			</form>
			<p>
				<form action="<?php echo base_url("login"); ?>" method="post" id="login">
					<button class="btn btn-primary btn-block btn-flat" type="submit">Back to Login</button>
				</form>
		</div>
	</div>

	<?php echo view("parts/footer_front"); ?>