
<?php
$data = [
  "title" => "Forgot Password",
];
echo view("parts/header_front", $data); ?>

<body class="hold-transition skin-red  login-page">
<div class="login-box">
	<div class="login-box-body">
		<form action="forgot" method="post" id="forgot">
			<p class="login-logo">Forgot Password<br />
			<p class="login-box-msg"><b><?php if(isset($err)){echo $err;}?></b>	
			<div class="form-group has-feedback">
				<div id="q">Your registered email address:</div>
				<input type="text" class="form-control" placeholder="Email" name="email"><br />
			</div>
			<div class="form-group has-feedback">
				<div id="q"><?php echo $question; ?></div>
				<input type="text" class="form-control" placeholder="?" name="date">
      </div>
			
				<button class="btn btn-primary btn-block btn-flat" type="submit">Submit</button>
		 </form><p>
		 <form action="<?php echo base_url("login");?>" method="post" id="login">
				<button class="btn btn-primary btn-block btn-flat" type="submit">Back to Login</button>
		 </form>
	 </div>
</div>

<?php echo view("parts/footer_front"); ?>