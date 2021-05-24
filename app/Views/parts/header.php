<?php if (session_status() == PHP_SESSION_NONE) {session_start();} ?>
<!DOCTYPE html><html lang="en">
<head>
	<meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PWA DashBoard</title>
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url("assets/_ico.png"); ?>">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= (defined('USE_CDN') && USE_CDN == 1) ? 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css' : base_url("assets/bootstrap/css/font-awesome.min.css") ?>">
  <link rel="stylesheet" href="<?= base_url("assets/bootstrap/css/ionicons.min.css"); ?>">
	<?php //required by jquery/bootstrap : ?>
	<script src="<?= base_url('assets/plugins/popper.min.js');?>"></script>	
  <link rel="stylesheet" href="<?= base_url("assets/dist/css/AdminLTE.min.css"); ?>">
  <link rel="stylesheet" href="<?= base_url("assets/dist/css/skins/skin-red.min.css"); ?>">
  <?php if(isset($css_files)){ //for groceryCrud:
		foreach($css_files as $f){echo '<link type="text/css" rel="stylesheet" href="'.$f.'" />';} foreach($js_files  as $f){echo '<script src="'.$f.'"></script>';} 
	}else{ echo '
		<link type="text/css" rel="stylesheet" href="'.base_url().'/grocery-crud/css/bootstrap/bootstrap.css" />
		<link type="text/css" rel="stylesheet" href="'.base_url().'/grocery-crud/css/jquery-ui/jquery-ui.css" />
		<script src="'.base_url().'/grocery-crud/js/jquery/jquery.js"></script>
		<script src="'.base_url().'/grocery-crud/js/libraries/jquery-ui.js"></script>';
	} ?>
	<?php //for forms: ?>
  <link rel="stylesheet" href="<?= base_url("assets/plugins/iCheck/square/blue.css"); ?>">
	<?php //for popup notification at bottom right: ?>
  <link rel="stylesheet" href="<?= base_url("assets/plugins/toastr/toastr.min.css"); ?>">
	<?php //for coexistence between adminLTE's bootstrap and groceryCrud: ?>
	
	<?php if(isset($scrollingTabs)){
		echo '<link rel="stylesheet" href="'.base_url("assets/plugins/scrollingTabs/jquery.scrolling-tabs.min.css").'">';
		echo '<script src="'.base_url("assets/plugins/scrollingTabs/jquery.scrolling-tabs.min.js").'"></script>';
	}
	if(isset($popover) && $popover){ ?>
  <style>
		.popovers:hover .popovers-tooltip{display:block}
		.popovers-tooltip {
			display:none;
			position: absolute;
			max-width: 300px;
			color: #333;
			font-size: small;
			text-decoration: none;
			z-index: 1000;
			background-color: #fafafa;
			padding: 10px 15px;
			box-shadow: 0 0 5px #8D8D8D;
			border-radius: 12px;
			border-top-left-radius: 0;
		}
  </style>
	<?php } if(isset($form_editor)){ ?>
  <style>
    .blmDiisi{background:rgba(255,232,232);border-color:red;}
    .ui-state-highlight {
      width: 70px;
      background: #eee;
      height: 100%;
    }

    .nav-tabs {
      height: 41px;

    }

    html {
      height: 100%;
    }

    .portlet-placeholder {
      width: 100%;
      border: 3px dashed #ccc;
      height: 100px;
      margin-bottom: 20px;
      border-radius: 5px;
    }

    .panel-default>.panel-heading {
      color: none;
      background-color: rgba(1, 1, 1, 0);
      border-color: white;
    }

    .panel-body {
      padding-top: 0px;
    }

    .panel-heading { /* fth: .edit .panel-heading */
      /*cursor: move;*/
    }

    .panel-footer {
      display: none;
    }

    .active-panel .panel-footer {
      display: block;
    }

    .form-pertanyaan {
      display: none;
    }

    .active-panel .form-pertanyaan {
      display: block;
    }

    .form-judul {
			font-size:16px;
			margin-bottom:9px;
      /* white-space: nowrap; */
      /* display: inline-flex; */
    }

    .form-judul .form-control {
      border: none;
      margin: none;
      box-shadow: none;
      padding: 0px;
      border-radius: 0px;
      padding: 10px;
    }

    .form-judul a {
      padding: 10px;
    }

    .active-panel .form-judul .form-control {
      display: block;
      border-bottom: 1px solid #ccc;
      padding: 10px 20px;
    }

    .panel-adder {
      color: rgba(1, 1, 1, 0);
      line-height: 30px;
      font-size: 23px;
      text-align: center;
    }

    .panel-adder:hover {
      color: rgba(1, 1, 1, 1);
    }

    .panel {
      margin: 0px;
    }

    .hapus {
      padding: 0px 5px;
    }

    .wajibdiisi {
      color: red;
      /* display: none; */
    }

    /* .wajibdiision .wajibdiisi {
      display: block;
    } */

    /* .active-panel .wajibdiisi {
      display: none;
    } */

    .subgrup .input-lg,
    .subgrupfix .input-lg {
      font-size: 22px;
    }

    .jenis-angka {
      display: none;
    }

    .pilihan-angka .jenis-angka {
      display: block;
    }

    .jenis-enum {
      display: none;
    }

    .pilihan-enum .jenis-enum {
      display: block;
    }

    .pilihan-enum .tambahkan-jawaban {
      opacity: 0.5;
      display: none;
    }

    .pilihan-enum .active-panel .tambahkan-jawaban {
      display: block;
    }

    .tambahkan-jawaban a {
      display: none;
    }

    .hapus-jawaban {
      display: none;
    }

    .active-panel .hapus-jawaban {
      display: block;
    }

    .nav-tabs input {
      border: none;
      border-bottom: 1px solid #eee;
      background: none;
    }

    .container h3 {
      margin:0;
      margin-bottom:20px;
      padding:0;
      font-size: 18px;
    }

    .noneditable .panel-area{
      margin-bottom: 20px;
    }


    @supports (-webkit-appearance: none) or (-moz-appearance: none) {
			input[type="checkbox"],
			input[type="radio"] {
				--active: #275efe;
				--active-inner: #fff;
				--focus: 2px rgba(39, 94, 254, 0.3);
				--border: #bbc1e1;
				--border-hover: #275efe;
				--background: #fff;
				--disabled: #f6f8ff;
				--disabled-inner: #999; /*#d73925  e1e6f9;*/
				-webkit-appearance: none;
				-moz-appearance: none;
				height: 21px;
				outline: none;
				display: inline-block;
				vertical-align: top;
				position: relative;
				margin: 0;
				cursor: pointer;
				border: 1px solid var(--bc, var(--border));
				background: var(--b, var(--background));
				-webkit-transition: background 0.3s, border-color 0.3s, box-shadow 0.2s;
				transition: background 0.3s, border-color 0.3s, box-shadow 0.2s;
			}
			input[type="checkbox"]:after,
			input[type="radio"]:after {
				content: "";
				display: block;
				left: 0;
				top: 0;
				position: absolute;
				-webkit-transition: opacity var(--d-o, 0.2s), -webkit-transform var(--d-t, 0.3s) var(--d-t-e, ease);
				transition: opacity var(--d-o, 0.2s), -webkit-transform var(--d-t, 0.3s) var(--d-t-e, ease);
				transition: transform var(--d-t, 0.3s) var(--d-t-e, ease), opacity var(--d-o, 0.2s);
				transition: transform var(--d-t, 0.3s) var(--d-t-e, ease), opacity var(--d-o, 0.2s), -webkit-transform var(--d-t, 0.3s) var(--d-t-e, ease);
			}
			input[type="checkbox"]:checked,
			input[type="radio"]:checked {
				--b: var(--active);
				--bc: var(--active);
				--d-o: 0.3s;
				--d-t: 0.6s;
				--d-t-e: cubic-bezier(0.2, 0.85, 0.32, 1.2);
			}
			input[type="checkbox"]:disabled,
			input[type="radio"]:disabled {
				--b: var(--disabled);
				cursor: not-allowed;
				opacity: 0.9;
			}
			input[type="checkbox"]:disabled:checked,
			input[type="radio"]:disabled:checked {
				--b: var(--disabled-inner);
				--bc: var(--border);
			}
			input[type="checkbox"]:disabled + label,
			input[type="radio"]:disabled + label {
				cursor: not-allowed;
			}
			input[type="checkbox"]:hover:not(:checked):not(:disabled),
			input[type="radio"]:hover:not(:checked):not(:disabled) {
				--bc: var(--border-hover);
			}
			input[type="checkbox"]:focus,
			input[type="radio"]:focus {
				box-shadow: 0 0 0 var(--focus);
			}
			input[type="checkbox"]:not(.switch),
			input[type="radio"]:not(.switch) {
				width: 21px;
			}
			input[type="checkbox"]:not(.switch):after,
			input[type="radio"]:not(.switch):after {
				opacity: var(--o, 0);
			}
			input[type="checkbox"]:not(.switch):checked,
			input[type="radio"]:not(.switch):checked {
				--o: 1;
			}
			input[type="checkbox"] + label,
			input[type="radio"] + label {
				font-size: 14px;
				line-height: 21px;
				display: inline-block;
				vertical-align: top;
				cursor: pointer;
				margin-left: 8px;
			}

			input[type="checkbox"]:not(.switch) {
				/* border-radius: 7px; */
			}
			input[type="checkbox"]:not(.switch):after {
				width: 5px;
				height: 9px;
				border: 2px solid var(--active-inner);
				border-top: 0;
				border-left: 0;
				left: 7px;
				top: 4px;
				-webkit-transform: rotate(var(--r, 20deg));
								transform: rotate(var(--r, 20deg));
			}
			input[type="checkbox"]:not(.switch):checked {
				--r: 43deg;
			}
			input[type="checkbox"].switch {
				width: 38px;
				border-radius: 11px;
			}
			input[type="checkbox"].switch:after {
				left: 2px;
				top: 2px;
				border-radius: 50%;
				width: 15px;
				height: 15px;
				background: var(--ab, var(--border));
				-webkit-transform: translateX(var(--x, 0));
								transform: translateX(var(--x, 0));
			}
			input[type="checkbox"].switch:checked {
				--ab: var(--active-inner);
				--x: 17px;
			}
			input[type="checkbox"].switch:disabled:not(:checked):after {
				opacity: 0.6;
			}

			input[type="radio"] {
				border-radius: 50%;
			}
			input[type="radio"]:after {
				width: 19px;
				height: 19px;
				border-radius: 50%;
				background: var(--active-inner);
				opacity: 0;
				-webkit-transform: scale(var(--s, 0.7));
								transform: scale(var(--s, 0.7));
			}
			input[type="radio"]:checked {
				--s: 0.5;
			}
		}
		input[type="checkbox"], input[type="radio"] {
			margin-left: 0px !important;
		}
  </style>
  <?php } ?>
	
	<style>
		.navbar{padding:0 !important}
		.sidebar-toggle{left:0 !important;position:absolute !important}
		.navbar-custom-menu{right:0 !important;position:absolute !important}
		.gc-grid-container{border:none !important}
		.main-sidebar{min-height:fit-content !important}
		.gc-visible-but-hidden{height:auto !important}
		.gc-datagrid-table-container{overflow-y:visible !important;padding-bottom:130px;min-height: 370px;}
		.gc-footer-tools{margin-top:-150px !important;height:125px !important;position:relative}
		#kandang{padding:1px 20px 0}
		.jwbReviewer{
			padding: 2px 4px;
			color: #18b713;
			background-color: #e9ffec;
			border-radius: 4px;
		}
		code{color:#888 !important;background-color:#f3f3f3 !important}
		.tx_sm{font-size:smaller;font-family:monospace}
		#rawtable .bg1{background-color:#ccc}
		#rawtable .bg2{background-color:#ddd}
		#rawtable .bg3{background-color:#eee}
	</style>
	<?php if(isset($_SESSION['hideSide'])){ if($_SESSION['hideSide']==1){$hideSide=true;} } //for saving sidebar visibility's status to session variable ?>
</head>

<body class="hold-transition skin-red sidebar-mini <?=isset($hideSide)?'sidebar-collapse':''?>" > <?php //kasih style="overflow-y:scroll" kalo tanpa groceryCrud ?>
  <div class="wrapper">
    <header class="main-header">
      <a href="" class="logo">
        <span class="logo-mini" aria-info="50x50px"><b>PW</b>A </span>
        <span class="logo-lg"><b>PWA</b> DashBoard</span>
			</a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
			  <li class="dropdown notifications-menu">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-bell-o"></i>
					<span class="label labe-warning"></span>
				  </a>
			  </li>
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
                <span class="hidden-xs"><?= $_SESSION['DATA_SESSION']['name']; ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src="<?= base_url('assets/uploads/user_photo/' . $filename . '_thumb.' . $ext); ?>" class="img-circle" alt="User Image">
                  <p>
                    <?= $_SESSION['DATA_SESSION']['name']; ?> <br>
                    <small><?= $_SESSION['DATA_SESSION']['email']; ?></small>
                    <small class="label"><?= $_SESSION['DATA_SESSION']['role']; ?></small>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?= base_url('users#/edit'); ?><?= "/" . $_SESSION['DATA_SESSION']['id']; ?>" class="btn btn-default btn-flat">Edit Profile & Password</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?= base_url('logout'); ?>" style="border-right:none" class="btn btn-default btn-flat">Logout</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">
      <section class="sidebar"><?= view('parts/menu'); ?></section>
    </aside>
		<div class="content-wrapper">


<script src="<?= base_url(); ?>/assets/dist/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url(); ?>/assets/dist/js/myscript.js"></script>