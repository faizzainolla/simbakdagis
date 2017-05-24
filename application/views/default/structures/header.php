	<script type="text/javascript">
		//var lat = <?php echo $this->session->userdata['user_data']['coordinate']['lat']; ?>;
		//var lon = <?php echo $this->session->userdata['user_data']['coordinate']['lon']; ?>;
	</script>
	<script src="<?php echo base_url(); ?>assets/default/js/maps.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/default/js/script.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/default/js/highcharts/highcharts.js"></script>
	<script src="<?php echo base_url(); ?>assets/default/js/highcharts/modules/data.js"></script>
	<script src="<?php echo base_url(); ?>assets/default/js/highcharts/modules/drilldown.js"></script>
	<script src="<?php echo base_url(); ?>assets/default/js/datatable.js"></script>
	 
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgbbJbVGcVxFB3jmsSs3OI9paI7uOv7Yw&sensor=false&libraries=places,drawing"></script>
	<!--22082015: add drawing library --> 
	<!--
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=drawing"></script>
	-->
	
	
	<div class="abahsoft_header_back"></div>
	<div class="abahsoft_header_front">
		<div class="abahsoft_menu_header">
			<div class="abahsoft_menu_current">
				<div class="abahsoft_menu_current_icon"><i class="icon-layers"></i></div>
				<div class="abahsoft_menu_current_name">Peta Tematik</div>
				<div class="abahsoft_clearfix"></div>
			</div>
			<div class="abahsoft_menu_arrow"></div>
		</div>
		<div class="abahsoft_site_logo"></div>
		<div class="abahsoft_site-tag">
			<div class="mk_site_tag_parrent">GIS ASET</div>
			<div class="mk_site_tag_child">Kota Makassar</div>
		</div>
		<div class="abahsoft_site-title"></div>
		<div class="abahsoft_clearfix"></div>
	</div>
	<div class="abahsoft_app_name">Makassar </div>
	<div class="abahsoft_app_logout" title="Keluar"><i class="icon-exit"></i></div>
	
	<div class="abahsoft_map_area">
		<div id="abahsoft_map_view"></div>
	</div>
 
	<div class="abahsoft_app_menu">
		<ul>			 
			<li ref="petatematik"  class="abahsoft_app_menu_selected" id="abahsoft_menu_petatematik"><i class="abahsoft_menu_icon icon-layers"></i><span class="abahsoft_menu_text">Peta Sebaran Aset</span></li>
			<li ref="petakawasan"> <i class="abahsoft_menu_icon icon-layers"></i><span class="abahsoft_menu_text">Peta Kawasan</span></li>
			<li ref="petajalan" > <i class="abahsoft_menu_icon icon-layers"></i></span><span class="abahsoft_menu_text">Peta Jalan</span></li>			
			<li ref="petadrainase" > <i class="abahsoft_menu_icon icon-layers"></i></span><span class="abahsoft_menu_text">Peta Drainase</span></li>	
			<li ref="pemetaan" ><i class="abahsoft_menu_icon icon-search"></i><span class="abahsoft_menu_text">Pencarian</span></li>			 
			<li ref="penambahan" ><i class="abahsoft_menu_icon icon-location"></i><span class="abahsoft_menu_text">Penambahan Titik</span></li>			 
			<li ref="pencetakan"><i class="abahsoft_menu_icon icon-printer"></i><span class="abahsoft_menu_text">Pencetakan</span></li>
		    <li ref="editpetakawasan"><i class="abahsoft_menu_icon icon-pencil"></i><span class="abahsoft_menu_text">Edit Peta Kawasan</span></li>	
		</ul>
	</div>
	
	<!-- fluid side -->
	
	<div class="fluid-sides" id="map_legend">

	</div>
	<a href="#" id="fluid-button" class="fluid-button"><i class="icon-compass-3"></i></a>
 