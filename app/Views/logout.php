<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/x-icon" href="assets/	ico.png">

  <title>
    ABCD - Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"-->
  <link rel="stylesheet" href="assets/bootstrap/css/font-awesome.min.css">
  <!-- Ionicons -->
  <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"-->
  <link rel="stylesheet" href="assets/bootstrap/css/ionicons.min.css">


  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="assets/plugins/morris/morris.css">
  <link rel="stylesheet" href="assets/plugins/datatables/jquery.dataTables.min.css">



  <!-- jvectormap -->
  <!--link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css"-->
  <!-- Date Picker -->
  <!--link rel="stylesheet" href="assets/plugins/datepicker/datepicker3.css"-->
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <!--link rel="stylesheet" href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"-->

  <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">

  <script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>



  <style>
    .crud-form .container {
      float: left
    }

    .table-label {
      background: none
    }

    .table-container {
      border: none
    }

    .floatR.r5.minimize-maximize-container.minimize-maximize {
      display: none
    }

    .floatR.r5.gc-full-width {
      display: none
    }

    body.login-page {
      background-image: url(assets/loginbg.jpg) !important;
      background-position: center center !important;
      background-repeat: no-repeat !important;
      background-attachment: fixed !important;
      background-size: cover !important;
      background-color: #d2d6de;
    }
  </style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-red  login-page">
  <div class="login-box">
    <div class="login-logo"><a style="color:#fff" href="">ABCD</a>
    </div>

    <div class="login-box-body">
      <p class="login-box-msg">
        <span style="color:red;font-weight:bold"></span>
        <br>Please Login
      </p>

      <form action="login" method="post" id="login">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="username / email" name="username">
        </div>
        <div class="input-group has-feedback" id="show_hide_password">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-addon">
            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
          </div>
        </div>
        <div class="form-group has-feedback">
          <div id="q"><br>Add together eight and three</div>
          <input type="password" class="form-control" placeholder="?" name="date">
        </div>
        <center>
          <button class="btn btn-warning btn-block btn-flat" type="submit">Sign In</button>
        </center>
      </form>

      <br />
      <form action="login/forgot" method="post" id="forgot">
        <center>
          <div class="row">
            <div class="">
              <input type="submit" class="btn btn-default btn-flat" value="I Forgot My Password">
            </div>
          </div>
        </center>
      </form>

    </div>
  </div>

  <script>
    $(document).ready(function() {
      $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
          $('#show_hide_password input').attr('type', 'password');
          $('#show_hide_password i').addClass("fa-eye-slash");
          $('#show_hide_password i').removeClass("fa-eye");
        } else if ($('#show_hide_password input').attr("type") == "password") {
          $('#show_hide_password input').attr('type', 'text');
          $('#show_hide_password i').removeClass("fa-eye-slash");
          $('#show_hide_password i').addClass("fa-eye");
        }
      });
    });
  </script>


  <!-- jQuery 2.2.3 -->
  <!--script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script-->
  <!-- jQuery UI 1.11.4 -->
  <!--script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script-->
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <!--script>
  $.widget.bridge('uibutton', $.ui.button);
</script-->

  <!-- jQuery 2.1.4 -->
  <!--script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script-->
  <!--script>
	$.widget.bridge('uibutton', $.ui.button);
</script-->

  <!-- Bootstrap 3.3.6 -->
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <!-- Morris.js charts -->
  <!--script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script-->
  <script src="assets/plugins/morris/morris.min.js"></script>
  <!-- Sparkline -->
  <script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
  <!-- jvectormap -->
  <!--script src="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script-->
  <!--script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script-->
  <!-- jQuery Knob Chart -->
  <script src="assets/plugins/knob/jquery.knob.js"></script>
  <!-- daterangepicker -->
  <!--script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script-->
  <script src="assets/plugins/daterangepicker/moment.min.js"></script>
  <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <!--script src="assets/plugins/datepicker/bootstrap-datepicker.js"></script-->
  <!-- Bootstrap WYSIHTML5 -->
  <script src="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <script src="assets/plugins/fastclick/fastclick.js"></script>

  <!-- AdminLTE App -->
  <script src="assets/dist/js/app.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <!--script src="assets/dist/js/demo.js"></script-->



  <script>
    $(document).ready(function() {

      $('.data-table').DataTable();


    });
  </script>

  <script src="assets/plugins/toastr/toastr.min.js"></script>
  <script>
    toastr.options = {
      "closeButton": true,
      "progressBar": true,
      "positionClass": "toast-bottom-right",
      "showDuration": "400",
      "hideDuration": "1000",
      "timeOut": "7000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  </script>

</body>

</html>