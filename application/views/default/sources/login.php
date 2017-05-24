<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link href="<?php echo base_url(); ?>assets/default/css/style-login-fb.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>assets/default/js/default.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/default/js/login.js" type="text/javascript"></script>

  <!--<link rel="stylesheet" href="css/style-login-fb.css">-->
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>

<style>

	body {
	background-image: url(<?php echo base_url(); ?>assets/default/img/background-gis.jpg);
    background-repeat: no-repeat;
    background-attachment: fixed;
	background-size: cover;
	}

	

	.abahsoft_layer {
		background-color: #f5f5f5;
	}
	.abahsoft_status_layer {
		background-color: #4617b4;
		position: absolute;
		width: 100%;
		color: #eee;
		padding: 40px 0;
	}
	.abahsoft_center_layer {
		width: 430px;
		position: relative;
	}
	.abahsoft_td_border_left {
		border-left: 1px solid #444;
		padding-left: 10px;
	}
	.errorfield {
		border-color: #f22 !important;
		background-color: #faa !important;
	}
	p span 
	{
		display: block;
	}

</style>

<section class="about">
  <form class="loginfb">
    <div style="loginfb-judul1"><img width="120px" src="<?php echo base_url(); ?>assets/default/img/logo-makassar.png"></div><br>
	<p><span style="color:white;">GIS ASET</span><span style="color:#333333;">Kota Makassar</span></p>
    <input type="text" id="username" class="loginfb-input" placeholder="Pengguna" autofocus>
    <input type="password" id="password" class="loginfb-input" placeholder="Sandi">
    <!--<input type="submit" value="Login" class="login-submit">-->
	<div id="do_login" class="loginfb-submit"><b>Masuk</b></div>
  </form>
  <p><span style="color:white;"> &copy; 2015</span></p>
</section>

	
</html>