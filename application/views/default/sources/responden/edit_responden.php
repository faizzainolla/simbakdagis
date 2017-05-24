<?php
if(count($responden)>0) {
?>
<style type="text/css">
	.abahsoft_edit_responden_map {
		width: 100%-4px;
		height: 300px;
		overflow: hidden;
		border: 2px solid #ccc;
		border-top: 0px;
	}
	#abahsoft_edit_responden_map {
		width: 100%;
		height: 330px;
	}
</style>
<table class="table table-striped">
	<tr>
		<td width="250px">NIK</td>
		<td width="5px">:</td>
		<td width="*">
			<input type="text" id="redit_nik" value="<?php echo $responden['data_responden_nik']; ?>">
		</td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td>
			<input type="text" id="redit_nama" value="<?php echo $responden['data_responden_nama']; ?>">
		</td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td>:</td>
		<td>
			<textarea rows="3" id="redit_alamat"><?php echo $responden['data_responden_alamat']; ?></textarea>
		</td>
	</tr>
	<tr>
		<td>RT/RW</td>
		<td>:</td>
		<td>
			<input type="number" min="1" max="99" id="redit_rt" class="span1" value="<?php echo $responden['data_responden_rt']; ?>"> /
			<input type="number" min="1" max="99" id="redit_rw" class="span1" value="<?php echo $responden['data_responden_rw']; ?>">
		</td>
	</tr>
	<tr>
		<td>Lokasi Map</td>
		<td>:</td>
		<td>
			<input type="text" id="redit_lookup_location" value="" style="width:100%;margin-bottom:0;" placeholder="Cari Lokasi">
			<div class="abahsoft_edit_responden_map">
				<div id="abahsoft_edit_responden_map"></div>
			</div>
			<input type="hidden" id="redit_location" value="<?php echo $responden['data_map_latitude'].'|'.$responden['data_map_longitude']; ?>">
			<small id="abahsoft_display_latlng">Lat: <?php echo $responden['data_map_latitude']; ?>, Lng: <?php echo $responden['data_map_longitude']; ?></small>
		</td>
	</tr>
	<tr>
		<td>Telepon</td>
		<td>:</td>
		<td>
			<input type="text" id="redit_telp" value="<?php echo $responden['data_responden_telepon']; ?>">
		</td>
	</tr>
	<tr>
		<td>Jumlah Kepala Keluarga</td>
		<td>:</td>
		<td>
			<input type="number" min="1" max="100" id="redit_jumlah_kk" class="span1" value="<?php echo $responden['data_responden_jumlah_kk']; ?>">
		</td>
	</tr>
	<tr>
		<td>Jumlah Jiwa</td>
		<td>:</td>
		<td>
			<input type="number" min="1" max="99" id="redit_jumlah_jiwa" class="span1" value="<?php echo $responden['data_responden_jumlah_jiwa']; ?>">
		</td>
	</tr>
	<tr>
		<td colspan="2"></td>
		<td>
			<div class="btn btn-info" id="redit_save">Simpan</div> <div class="btn btn-danger" onClick="closeRespondenEdit();">Batal</div>
		</td>
	</tr>
</table>

<script type="text/javascript">
<?php
$lat = $responden['data_map_latitude']!=''?$responden['data_map_latitude']:$this->session->userdata['user_data']['coordinate']['lat'];
$lng = $responden['data_map_longitude']!=''?$responden['data_map_longitude']:$this->session->userdata['user_data']['coordinate']['lon'];
?>
var ermap;
var marker_rekap_select;

function ermap() {
	ermap = new google.maps.Map(document.getElementById('abahsoft_edit_responden_map'), {
		zoom: 18,
		center: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>),
		mapTypeId: google.maps.MapTypeId.HYBRID,
		disableDefaultUI: true
	});
}

$(function() {

	ermap();

	<?php if($responden['data_map_latitude']!='') { ?>
	var image = new google.maps.MarkerImage(
		'markers/point.png',
		new google.maps.Size(18,18),	// size
		new google.maps.Point(0,0),		// origin
		new google.maps.Point(9,9),		// anchor
		new google.maps.Size(18,18)		// scale
	);

	var marker_rekaps = new google.maps.Marker({
		position: new google.maps.LatLng(<?php echo $responden['data_map_latitude']; ?>, <?php echo $responden['data_map_longitude']; ?>),
		map: ermap,
		html: false,
		icon: image
	});
	<?php } ?>

	var input = document.getElementById('redit_lookup_location');
	var searchBox = new google.maps.places.SearchBox(input);


	google.maps.event.addListener(searchBox, 'places_changed', function() {
		var places = searchBox.getPlaces();

		var bounds = new google.maps.LatLngBounds();
		bounds.extend(places[0].geometry.location);

		ermap.fitBounds(bounds);
	});

	google.maps.event.addListener(ermap, 'bounds_changed', function() {
		var bounds = ermap.getBounds();
		searchBox.setBounds(bounds);
	});

	
	google.maps.event.addListener(ermap, 'click', function (e) {
		/*var latlng = e.latLng;
		alert(latlng.nb+' '+latlng.ob);*/

			var latlng = e.latLng;
			var image = new google.maps.MarkerImage(
				'markers/point2.png',
		          new google.maps.Size(16,16),    // size
		          new google.maps.Point(0,0),     // origin
		          new google.maps.Point(8,8),   // anchor
		          new google.maps.Size(16,16)     // scale
		          );
			var myLatLng = new google.maps.LatLng(latlng.nb, latlng.ob);
			if (typeof marker_rekap_select != "undefined") {
				marker_rekap_select.setMap(null);
			}
			marker_rekap_select = new google.maps.Marker({
				position: myLatLng,
				map: ermap,
				icon: image
			});
			
			$('#abahsoft_display_latlng').html('Lat: '+latlng.nb+', Lng: '+latlng.ob);
			$('#redit_location').val(latlng.nb+'|'+latlng.ob);

	});


	$('#redit_lookup_location').focus(function() {
		$('.abahsoft_edit_responden_map').css({'border-color':'#666666'});
	});
	$('#redit_lookup_location').blur(function() {
		$('.abahsoft_edit_responden_map').css({'border-color':'#cccccc'});
	});

	$('#redit_nik, #redit_rt, #redit_rw, #redit_jumlah_kk, #redit_jumlah_jiwa, #redit_telp').numeric();

	$('#redit_save').click(function() {
		var data = 'nik='+$('#redit_nik').val()+'&nama='+$('#redit_nama').val()+'&alamat='+$('#redit_alamat').val()+'&rt='+$('#redit_rt').val()+'&rw='+$('#redit_rw').val()+'&telp='+$('#redit_telp').val()+'&jumlah_kk='+$('#redit_jumlah_kk').val()+'&jumlah_jiwa='+$('#redit_jumlah_jiwa').val()+'&loc='+$('#redit_location').val();
		$.ajax({
			type  : 'post',
			url   : base_url+'responden/responden_edit/<?php echo $responden['data_id']; ?>',
			data  : data,
			cache : false,
			success: function(status) {
				if(status==1) {
					closeRespondenEdit();
					reload_datatable();
					showRespondenDetil_reload(<?php echo $responden['data_id']; ?>);
				}
			}
		});
	});
});
</script>
<?php } ?>