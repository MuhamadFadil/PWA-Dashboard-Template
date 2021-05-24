
<?php
$data = [
  "title" => "activate",
];
echo view("parts/header_front", $data); ?>

<body class="hold-transition skin-red  login-page">
  <div class="login-box">
    <div class="login-logo"><a style="color:#fff" href="">ABCD</a>
    </div>

    <div class="login-box-body">
      <p class="login-box-msg">
        <span style="color:red;font-weight:bold"><?php if (isset($err)) {
                                                    echo $err;
                                                  } ?></span>
        <br>We have sent an activation link to your email. Plase open the link to activate your account.
      </p>

      <form action="activate" method="post" id="register">
      <input type="hidden" id="custId" name="resend" value="1">
        <center>
          <button class="btn btn-warning btn-block btn-flat" type="submit">Resend email</button>
        </center>
      </form>

      <br />

    </div>
  </div>


  <?php echo view("parts/footer_front"); ?>