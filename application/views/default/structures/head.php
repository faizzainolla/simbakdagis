<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta charset="utf-8">
	<link rel="shortcut icon" href="<?php echo base_url('assets/default/img/logo-mksr.jpg'); ?>">
	<?php
	$title = isset($kelurahan_data)?'PPU Kelurahan '.$kelurahan_data['kelurahan_nama'].' - '.$kelurahan_data['kecamatan_nama']:'GIS ASET';
	?>
	<title><?php echo $title; ?></title>
	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
	<!--
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/default/css/bootmetro.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/default/css/bootmetro-responsive.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/default/css/bootmetro-icons.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/default/css/bootmetro-ui-light.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/default/css/datepicker.css">
    -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/default/css/style.css">
    <?php  	      
		 //  $PapuaProv = file_get_contents("./peta/kab-papua.geojson"); 
		 //  $PapuaAsmatDistrik = file_get_contents("./peta/papua-per-distrik-asmat.geojson"); 
           $makasar = file_get_contents("./peta/makasar.geojson");
	?>
	
	<script type="text/javascript">
	var base_url = '<?php echo base_url(); ?>';
    makasar = <?php  $makasar=str_replace(array("\r", "\n"), '', $makasar); echo($makasar); ?>;
	
	</script>

	<script src="<?php echo base_url(); ?>assets/default/js/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/default/js/numeric.js" type="text/javascript"></script>
	<!--load geoJson -->
	<script src="<?php echo base_url(); ?>assets/default/js/GeoJSON.js" type="text/javascript"></script>
	<!--load Json2 utk ubah overlay to json -->
	<script src="<?php echo base_url(); ?>assets/default/js/json2.js" type="text/javascript"></script>
	<!--load js colour -->
	<script src="<?php echo base_url(); ?>assets/default/js/jscolor/jscolor.js" type="text/javascript"></script>
	
	<!--style metro ui -->
	<link href="<?php echo base_url(); ?>metroui/css/metro-bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>metroui/css/metro-bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>metroui/css/metro-icons.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>metroui/css/docs.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>metroui/js/prettify/prettify.css" rel="stylesheet">

    <!-- Load JavaScript Libraries -->
	<!-- 
    <script src="<?php echo base_url(); ?>metroui/js/jquery/jquery.min.js"></script>
	-->
    <script src="<?php echo base_url(); ?>metroui/js/jquery/jquery.widget.min.js"></script>
    <script src="<?php echo base_url(); ?>metroui/js/jquery/jquery.mousewheel.js"></script>
    <script src="<?php echo base_url(); ?>metroui/js/prettify/prettify.js"></script>

    <!-- Metro UI CSS JavaScript plugins -->
    <script src="<?php echo base_url(); ?>metroui/js/load-metro.js"></script>

    <!-- Local JavaScript -->
    <script src="<?php echo base_url(); ?>metroui/js/docs.js"></script>

</head>
<body class="metro" >