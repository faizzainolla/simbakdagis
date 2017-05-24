<style type="text/css">
	.abahsoft_add_responden_map {
		width: 100%-4px;
		height: 300px;
		overflow: hidden;
		border: 2px solid #ccc;
		border-top: 0px;
	}
	#abahsoft_add_responden_map {
		width: 100%;
		height: 330px;
	}
</style>
<table class="table table-striped">
	<tr>
		<td width="250px">NIK</td>
		<td width="5px">:</td>
		<td width="*">
			<input type="text" id="radd_nik" value="">
		</td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td>
			<input type="text" id="radd_nama" value="">
		</td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td>:</td>
		<td>
			<textarea rows="3" id="radd_alamat"></textarea>
		</td>
	</tr>
	<tr>
		<td>RT/RW</td>
		<td>:</td>
		<td>
			<input type="number" min="1" max="99" id="radd_rt" class="span1" value="1"> /
			<input type="number" min="1" max="99" id="radd_rw" class="span1" value="1">
		</td>
	</tr>
	<tr>
		<td>Lokasi Map</td>
		<td>:</td>
		<td>
			<input type="text" id="radd_lookup_location" value="" style="width:100%;margin-bottom:0;" placeholder="Cari Lokasi">
			<div class="abahsoft_add_responden_map">
				<div id="abahsoft_add_responden_map"></div>
			</div>
			<input type="hidden" id="radd_location" value="|">
			<small id="abahsoft_display_latlng_add"></small>
		</td>
	</tr>
	<tr>
		<td>Telepon</td>
		<td>:</td>
		<td>
			<input type="text" id="radd_telp" value="">
		</td>
	</tr>
	<tr>
		<td>Jumlah Kepala Keluarga</td>
		<td>:</td>
		<td>
			<input type="number" min="1" max="100" id="radd_jumlah_kk" class="span1" value="1">
		</td>
	</tr>
	<tr>
		<td>Jumlah Jiwa</td>
		<td>:</td>
		<td>
			<input type="number" min="1" max="99" id="radd_jumlah_jiwa" class="span1" value="1">
		</td>
	</tr>
</table>
<?php if(count($kuisoners)>0) { ?>
	<table width="100%" style="font-size:14px;">
	<?php foreach($kuisoners as $gk => $gv) { ?>
	<tr>
		<td width="30px;" style="padding-top:10px;vertical-align:top;"><b><?php echo romawi($gk+1); ?>.</b></td>
		<td colspan="3" style="padding-top:10px;vertical-align:top;"><b><?php echo strtoupper($gv['nama_group']); ?></b></td>
	</tr>
	<?php foreach($gv['pertanyaan_group'] as $kk => $kv) { ?>
	<tr>
		<td style="padding-top:6px;"></td>
		<td style="padding-top:6px;vertical-align:top;" width="20px;"><b><?php echo $kk+1; ?>.</b></td>
		<td colspan="2" style="padding-top:6px;vertical-align:top;" width="*"><b><?php echo $kv['pertanyaan']; ?></b></td>
	</tr>
	<?php foreach($kv['pilihan'] as $ov) { ?>
	<tr>
		<td colspan="2"></td>
		<td width="15px;" style="vertical-align:top;"><?php echo $ov['nomor_pilihan']; ?>.</td>
		<td>
			<?php echo ($ov['tambahan_pilihan']!='')?'<div class="form-inline">':''; ?>
			<label class="radio">
				<input type="radio" class="radiobutton ansadd_<?php echo $kv['id_pertanyaan']; ?>" ref="<?php echo $kv['id_pertanyaan']; ?>" name="ansadd_<?php echo $kv['id_pertanyaan']; ?>" value="<?php echo $ov['id_pilihan']; ?>">
				<span class="metro-radio">
					<?php echo str_replace('M2', 'M<sup>2</sup>', str_replace('m2', 'm<sup>2</sup>', $ov['nama_pilihan'])); ?>
				</span>
			</label>
			<?php echo ($ov['tambahan_pilihan']!='')?' <input id="othadd_'.$kv['id_pertanyaan'].'" type="text" value="">':''; ?>
			<?php echo ($ov['tambahan_pilihan']!='')?'</div>':''; ?>
			<?php if(count($ov['anak_pilihan'])>0) { ?>
			
			<?php foreach($ov['anak_pilihan'] as $ook => $oov) { ?>
			<div style="float:left;padding-left:40px;">
				<label class="radio">
				<input type="radio" class="radiobutton ansadd_<?php echo $kv['id_pertanyaan']; ?>" ref="<?php echo $kv['id_pertanyaan']; ?>" name="ansadd_<?php echo $kv['id_pertanyaan']; ?>" value="<?php echo $oov['id_pilihan']; ?>">
				<span class="metro-radio"><?php echo str_replace('M2', 'M<sup>2</sup>', str_replace('m2', 'm<sup>2</sup>', $oov['nama_pilihan'])); ?></span>
			</label>
			</div>
			<?php } ?>
			<div style="clear:both;"></div>
			<?php } ?>
		</td>
	</tr>
	<?php } ?>
	<?php } ?>
	<?php } ?>
	</table>
	<div style="padding-top: 30px;">
	<div class="btn btn-info" id="abahsoft_responden_add_btnsave">Simpan</div>
	<div class="btn btn-danger" onClick="closeRespondenAdd();">Batal</div>
	</div>
<?php } ?>
<script type="text/javascript">
	var armap;
	var marker_rekap_add;

	function armap() {
		armap = new google.maps.Map(document.getElementById('abahsoft_add_responden_map'), {
			zoom: 18,
			center: new google.maps.LatLng(<?php echo $this->session->userdata['user_data']['coordinate']['lat']; ?>, <?php echo $this->session->userdata['user_data']['coordinate']['lon']; ?>),
			mapTypeId: google.maps.MapTypeId.HYBRID,
			disableDefaultUI: true
		});
	}
	$(function() {
		armap();
		var input = document.getElementById('radd_lookup_location');
		var searchBox = new google.maps.places.SearchBox(input);


		google.maps.event.addListener(searchBox, 'places_changed', function() {
			var places = searchBox.getPlaces();

			var bounds = new google.maps.LatLngBounds();
			bounds.extend(places[0].geometry.location);

			armap.fitBounds(bounds);
		});

		google.maps.event.addListener(armap, 'bounds_changed', function() {
			var bounds = armap.getBounds();
			searchBox.setBounds(bounds);
		});

		
		google.maps.event.addListener(armap, 'click', function (e) {
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
				if (typeof marker_rekap_add != "undefined") {
					marker_rekap_add.setMap(null);
				}
				marker_rekap_add = new google.maps.Marker({
					position: myLatLng,
					map: armap,
					icon: image
				});
				
				$('#abahsoft_display_latlng_add').html('Lat: '+latlng.nb+', Lng: '+latlng.ob);
				$('#radd_location').val(latlng.nb+'|'+latlng.ob);

		});
		$('#radd_lookup_location').focus(function() {
			$('.abahsoft_add_responden_map').css({'border-color':'#666666'});
		});
		$('#radd_lookup_location').blur(function() {
			$('.abahsoft_add_responden_map').css({'border-color':'#cccccc'});
		});

		$('#radd_nik, #radd_rt, #radd_rw, #radd_jumlah_kk, #radd_jumlah_jiwa, #radd_telp').numeric();

		$('#abahsoft_responden_add_btnsave').click(function() {
			if($('#radd_nama').val()=='') {
				alert('Setidaknya nama responden harus diisi'); return false;
			}
			var data = 'nik='+$('#radd_nik').val()+'&nama='+$('#radd_nama').val()+'&alamat='+$('#radd_alamat').val()+'&rt='+$('#radd_rt').val()+'&rw='+$('#radd_rw').val()+'&telp='+$('#radd_telp').val()+'&jumlah_kk='+$('#radd_jumlah_kk').val()+'&jumlah_jiwa='+$('#radd_jumlah_jiwa').val()+'&loc='+$('#radd_location').val();
			var idused = [];
			$('.radiobutton').each(function() {
				var thisref = $(this).attr('ref');
				if($('input[name=ansadd_'+thisref+']:checked').val() && $.inArray(thisref, idused)<0) {
					var otheres = '';
					if($('#othadd_'+thisref).length>0) {
						otheres = $('#othadd_'+thisref).val();
					}
					data += '&ansadd['+thisref+']='+$('input[name=ansadd_'+thisref+']:checked').val()+'_'+otheres;
					idused.push(thisref);
				}
			});
			if(idused.length==0) {
				alert('Setidaknya satu kuisoner harus dipilih'); return false;
			}
			$.ajax({
				type  : 'post',
				url   : base_url+'responden/responden_add',
				data  : data,
				cache : false,
				success: function(html) {
					if(html>0) {
						closeRespondenAdd();
						showRespondenDetil(html);
					}
				}
			});
		});
	});
</script>
<?php
function romawi($n){
	$hasil = "";
	$iromawi = array("","I","II","III","IV","V","VI","VII","VIII","IX","X",20=>"XX",30=>"XXX",40=>"XL",50=>"L",60=>"LX",70=>"LXX",80=>"LXXX",90=>"XC",100=>"C",200=>"CC",300=>"CCC",400=>"CD",500=>"D",600=>"DC",700=>"DCC",800=>"DCCC",900=>"CM",1000=>"M",2000=>"MM",3000=>"MMM");
	if(array_key_exists($n,$iromawi)){
		$hasil = $iromawi[$n];
	}elseif($n >= 11 && $n <= 99){
		$i = $n % 10;
		$hasil = $iromawi[$n-$i] . Romawi($n % 10);
	}elseif($n >= 101 && $n <= 999){
		$i = $n % 100;
		$hasil = $iromawi[$n-$i] . Romawi($n % 100);
	}else{
		$i = $n % 1000;
		$hasil = $iromawi[$n-$i] . Romawi($n % 1000);
	}
	return $hasil;
}
?>