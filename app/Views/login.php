
<?php
$data = [
  "title" => "login",
];
echo view("parts/header_front", $data); ?>

<body class="hold-transition skin-red  login-page">
<div class="login-box">
  <div class="login-logo"><a style="color:#fff" href="">PWA DashBoard</a>
	</div>
  
  <div class="login-box-body">
    <p class="login-box-msg">
		<span style="color:red;font-weight:bold"><?php if(isset($err)){echo $err;} ?></span>
		<br>Please Login
		</p>
		
    <form action="login" method="post" id="login">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Email" name="username">
      </div>
      <div class="input-group has-feedback" id="show_hide_password">
        <input type="password" class="form-control" placeholder="Password" name="password">
				<div class="input-group-addon">
					<a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
				</div>
      </div>
      <div class="form-group has-feedback">
				<div id="q"><br><?php if(isset($question)){echo $question;} ?></div>
				<input type="text" class="form-control" placeholder="?" name="date">
      </div>
			<center>
				<button class="btn btn-success btn-block btn-flat" type="submit">Sign In</button>
			</center>
    </form>
		<br>
	<br />
	<form action="login/forgot" method="post" id="forgot">
		<center>
			<div class="row">
					<div class="">
						<!--a class="btn btn-default btn-flat" href="register">Register</a--> &nbsp; 
						<input type="submit" class="btn btn-default btn-flat" value="Forgot Password">
					</div>
			</div>
		</center>
	</form>

  </div>
</div>
<div style="color:#999;position:fixed;bottom:0;right:0;padding:15px">&copy;<?=date('Y')?> Pajon.co.id
</div>


<?php echo view("parts/footer_front"); ?>