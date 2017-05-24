<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta charset="utf-8">
	<link rel="shortcut icon" href="<?php echo base_url('assets/default/img/logo-asmat.jpg'); ?>">
	<?php
	$title = isset($kelurahan_data)?'PPU Kelurahan '.$kelurahan_data['kelurahan_nama'].' - '.$kelurahan_data['kecamatan_nama']:'GIS ASET';
	?>
	<title><?php echo $title; ?></title>
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
	<script src="<?php echo base_url(); ?>assets/default/js/numeric.js" type="text/javascript"></script>

</head>
<body>