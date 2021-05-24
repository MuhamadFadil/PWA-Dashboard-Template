
<?php
$data = [
  "title" => "register",
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
        <br>Please Register
      </p>

      <form action="register" method="post" id="register">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Name" name="name">
        </div>
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="username" name="username">
        </div>
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="email" name="email">
        </div>
        <div class="input-group has-feedback" id="show_hide_password">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-addon">
            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
          </div>
        </div>
        <div class="input-group has-feedback" id="show_hide_password2">
          <input type="password" class="form-control" placeholder="Retype Password" name="password2">
          <div class="input-group-addon">
            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
          </div>
        </div>
        <div class="form-group has-feedback">
          <div id="q"><br><?php if (isset($question)) {
                            echo $question;
                          } ?></div>
          <input type="text" class="form-control" placeholder="?" name="date">
        </div>
        <center>
          <button class="btn btn-warning btn-block btn-flat" type="submit">Register</button>
        </center>
      </form>
          <a class="btn btn-warning btn-block btn-flat" href="login">Back to login</a>

      <br />

    </div>
  </div>

<?php echo view("parts/footer_front"); ?>