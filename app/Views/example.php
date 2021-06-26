<?php if (session_status() == PHP_SESSION_NONE) {session_start();} ?>
<!DOCTYPE html><html lang="en">
<head>
	<meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SmartCity Rank</title>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url("assets/_ico.png"); ?>">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= (defined('USE_CDN') && USE_CDN == 1) ? 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css' : base_url("assets/bootstrap/css/font-awesome.min.css") ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/css/ionicons.min.css"); ?>">
	<?php //required by jquery/bootstrap : ?>
	<script src="<?php echo base_url('assets/plugins/popper.min.js');?>"></script>	
  <link rel="stylesheet" href="<?php echo base_url("assets/dist/css/AdminLTE.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/dist/css/skins/skin-red.min.css"); ?>">
  <?php //for groceryCrud:
	foreach($css_files as $f){echo '<link type="text/css" rel="stylesheet" href="'.$f.'" />';} foreach($js_files  as $f){echo '<script src="'.$f.'"></script>';} ?>
	<?php //for forms: ?>
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/iCheck/square/blue.css"); ?>">
	<?php //for popup notification at bottom right: ?>
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/toastr/toastr.min.css"); ?>">
	<style> <?php //for coexistence between adminLTE's bootstrap and groceryCrud: ?>
		.navbar{padding:0 !important}
		.sidebar-toggle{left:0 !important;position:absolute !important}
		.navbar-custom-menu{right:0 !important;position:absolute !important}
		.gc-grid-container{border:none !important}
		.main-sidebar{min-height:fit-content !important}
		.gc-visible-but-hidden{height:auto !important}
	</style>
	<?php if(isset($_SESSION['hideSide'])){ if($_SESSION['hideSide']==1){$hideSide=true;} } //for saving sidebar visibility's status to session variable ?>
</head>

<body class="hold-transition skin-red sidebar-mini <?=isset($hideSide)?'sidebar-collapse':''?>" >
  <div class="wrapper">
    <header class="main-header">
      <a href="" class="logo">
        <span class="logo-mini" aria-info="50x50px"><b>SC</b>R </span>
        <span class="logo-lg"><b>SmartCity</b> Rank </span>
			</a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php
									if ($_SESSION['DATA_SESSION']['photo'] != "") {
										$parts = explode(".", $_SESSION['DATA_SESSION']['photo']);
										$ext = array_pop($parts);
										$filename = implode('.', $parts);
									} else {
										$filename = 'o';
										$ext = 'png';
									}
									echo base_url('assets/uploads/user_photo/' . $filename . '_thumb.' . $ext);
									?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $_SESSION['DATA_SESSION']['name']; ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src="<?php echo base_url('assets/uploads/user_photo/' . $filename . '_thumb.' . $ext); ?>" class="img-circle" alt="User Image">
                  <p>
                    <?php echo $_SESSION['DATA_SESSION']['name']; ?> <br>
                    <small><?php echo $_SESSION['DATA_SESSION']['email']; ?></small>
                    <small class="label"><?php echo $_SESSION['DATA_SESSION']['role']; ?></small>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo base_url('users/index/edit'); ?><?php echo "/" . $_SESSION['DATA_SESSION']['id']; ?>" class="btn btn-default btn-flat">Edit Profile & Password</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url('logout'); ?>" style="border-right:none" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">
      <section class="sidebar"><?php echo view('parts/menu'); ?></section>
    </aside>

		
		
		
	<div class="content-wrapper">
		<?php if(isset($startOfContentWrapper)){ echo $startOfContentWrapper; } ?>
		<section class="content-header">
			<h1><?=isset($title)?$title:''?><small><?=isset($title2)?$title2:''?></small></h1>
		</section>
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box">
						<div class="box-body">
							<?php echo $output; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php if(isset($endOfContentWrapper)){ echo $endOfContentWrapper; } ?>
		<div style="padding: 0 20px 20px 20px;font-size:small;color:#999;margin-top: -20px;">
			<span id="txt"> Tes</span>
			<div class="pull-right hidden-xs">
				<strong>&copy;2020 Pajon.co.id</strong> Ver. 0.2
			</div>
		</div>
	</div>
	
</div>

<script>
	// $(document).ready( function () { $('.dataTable').addClass("table table-striped table-bordered"); } );
	function commonConfirm(){return confirm('Are you sure?');} //show confirmation box
	$('.sidebar-toggle').click(function(){ //remember sidebar collapse state
		hideSide=1;
		if($('body').hasClass('sidebar-collapse')){hideSide=0;} //status just before the toggle is clicked
		$.ajax({type: "POST",url: "<?=base_url('users/setSesData/hideSide')?>/"+hideSide});
	});
</script>

<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>

<!--script src="<?php echo base_url('assets/plugins/sparkline/jquery.sparkline.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/knob/jquery.knob.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/daterangepicker/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');?>"></script>
<script src="<?php echo base_url('assets/grocery_crud/themes/datatables/js/jquery.dataTables.min.js');?>"></script> 
<script src="<?php echo base_url('assets/grocery_crud/themes/datatables/js/dataTables.bootstrap.min.js');?>"></script-->

<script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/fastclick/fastclick.js');?>"></script>

<script src="<?php echo base_url('assets/dist/js/app.js');?>"></script>

</body>
</html>