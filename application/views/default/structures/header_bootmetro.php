	<script type="text/javascript">
		var lat = <?php echo $this->session->userdata['user_data']['coordinate']['lat']; ?>;
		var lon = <?php echo $this->session->userdata['user_data']['coordinate']['lon']; ?>;
	</script>
	<script src="<?php echo base_url(); ?>assets/default/js/maps.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/default/js/script.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/default/js/highcharts/highcharts.js"></script>
	<script src="<?php echo base_url(); ?>assets/default/js/highcharts/modules/data.js"></script>
	<script src="<?php echo base_url(); ?>assets/default/js/highcharts/modules/drilldown.js"></script>
	<script src="<?php echo base_url(); ?>assets/default/js/datatable.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
	<div class="abahsoft_header_back"></div>
	<div class="abahsoft_header_front">
		<div class="abahsoft_menu_header">
			<div class="abahsoft_menu_current">
				<div class="abahsoft_menu_current_icon"><i class="abahsoft_menu_icon icon-map"></i></div>
				<div class="abahsoft_menu_current_name">Peta Tematik</div>
				<div class="abahsoft_clearfix"></div>
			</div>
			<div class="abahsoft_menu_arrow"></div>
		</div>
		<div class="abahsoft_site_logo"></div>
		<div class="abahsoft_site-tag">
			<div class="mk_site_tag_parrent">GIS ASET</div>
			<div class="mk_site_tag_child">Kabupaten Asmat</div>
		</div>
		<div class="abahsoft_site-title"></div>
		<div class="abahsoft_clearfix"></div>
	</div>
	<div class="abahsoft_app_name">Asmat </div>
	<div class="abahsoft_app_logout" title="Keluar"><i class="icon-switch-3"></i></div>
	<div class="abahsoft_map_area">
		<div id="panel" class="panel hide-panel">
		   <div id="toggle-button"><<</div><br />
				&nbsp;KETERANGAN
        <hr/>
		<div class="" id="abahsoft_legend_tematik"></div>
			<!-- abah update 08012014: tambah div utk link view fullscreen tematik-->
		<div class="" id="abahsoft_cetak_tematik"></div>
			</div>
		<div id="abahsoft_map_view"></div>
	</div>
	<div class="abahsoft_app_menu">
		<ul>			 
			<li ref="petatematik"  class="abahsoft_app_menu_selected" id="abahsoft_menu_petatematik"><i class="abahsoft_menu_icon icon-map"></i><span class="abahsoft_menu_text">Peta Tematik</span></li>			 
			<li ref="pemetaan" ><i class="abahsoft_menu_icon icon-map-pin-fill"></i><span class="abahsoft_menu_text">Pencarian</span></li>			 
			<li ref="penambahan" ><i class="abahsoft_menu_icon icon-pin"></i><span class="abahsoft_menu_text">Penambahan Titik</span></li>			 
			<li ref="pencetakan"><i class="abahsoft_menu_icon icon-printer"></i><span class="abahsoft_menu_text">Pencetakan</span></li>
		</ul>
	</div>