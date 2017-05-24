<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta charset="utf-8">
	<title>404 PPU</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/default/css/bootmetro.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/default/css/bootmetro-responsive.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/default/css/bootmetro-icons.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/default/css/bootmetro-ui-light.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/default/css/datepicker.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/default/css/style.css">

	<script type="text/javascript">
	var base_url = '<?php echo base_url(); ?>';
	</script>

	<script src="<?php echo base_url(); ?>assets/default/js/jquery-1.10.2.min.js" type="text/javascript"></script>

</head>
<body><script src="<?php echo base_url(); ?>assets/default/js/default.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/default/js/login.js" type="text/javascript"></script>
<style type="text/css">
	.abahsoft_layer {
		background-color: #f5f5f5;
	}
	.abahsoft_status_layer {
		background-color: #222;
		position: absolute;
		width: 100%;
		border-top: 8px solid #aaa;
		border-bottom: 8px solid #aaa;
		text-align: center;
		color: #eee;
		padding: 20px 0;
	}
</style>
<div class="abahsoft_layer">
	<div class="abahsoft_status_layer">
		<h1><?php echo $heading; ?></h1>
		<?php echo $message; ?>
	</div>
</div></body>
</html>