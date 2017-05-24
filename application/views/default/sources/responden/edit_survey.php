<?php if(count($responden)>0) { ?>
	<?php if(count($kuisoners)>0) { ?>
		<table class="table table-striped" style="font-size:12px;">
			<tr><td width="250px">Nomor Identitas</td><td width="5px">:</td><td width="*"><?php echo $responden['data_nomor_identitas']; ?></td></tr>
			<tr><td width="250px">NIK</td><td width="5px">:</td><td width="*"><?php echo $responden['data_responden_nik']; ?></td></tr>
			<tr><td>Nama</td><td>:</td><td><?php echo $responden['data_responden_nama']; ?></td></tr>
			<tr><td>Alamat</td><td>:</td><td><?php echo $responden['data_responden_alamat']; ?></td></tr>
			<tr><td>RT/RW</td><td>:</td><td><?php echo $responden['data_responden_rt'].'/'.$responden['data_responden_rw']; ?></td></tr>
			<tr><td>Lokasi Map</td><td>:</td><td><i class="icon-target-2" style="font-size:12px;cursor:pointer;" onClick="showRespondenMap(<?php echo $responden['data_id']; ?>)"></i> (lat: <?php echo $responden['data_map_latitude'].', lon: '.$responden['data_map_longitude']; ?>)</td></tr>
			<tr><td>Telepon</td><td>:</td><td><?php echo $responden['data_responden_telepon']; ?></td></tr>
			<tr><td>Jumlah Kepala Keluarga</td><td>:</td><td><?php echo $responden['data_responden_jumlah_kk']; ?></td></tr>
			<tr><td>Jumlah Jiwa</td><td>:</td><td><?php echo $responden['data_responden_jumlah_jiwa']; ?></td></tr>
		</table>
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
					<?php
					$checked = '';
					if(array_key_exists($kv['id_pertanyaan'], $jawaban)) {
						$checked = $jawaban[$kv['id_pertanyaan']]['data_kuisoner_pilihan_id']==$ov['id_pilihan']?'checked':'';
					}
					?>
					<input type="radio" class="radiobutton ans_<?php echo $kv['id_pertanyaan']; ?>" ref="<?php echo $kv['id_pertanyaan']; ?>" name="ans_<?php echo $kv['id_pertanyaan']; ?>" <?php echo $checked; ?> value="<?php echo $ov['id_pilihan']; ?>">
					<span class="metro-radio">
						<?php echo str_replace('M2', 'M<sup>2</sup>', str_replace('m2', 'm<sup>2</sup>', $ov['nama_pilihan'])); ?>
					</span>
				</label>
				<?php echo ($ov['tambahan_pilihan']!='')?' <input id="oth_'.$kv['id_pertanyaan'].'" type="text" value="'.$jawaban[$kv['id_pertanyaan']]['data_kuisoner_pilihan_tambahan'].'">':''; ?>
				<?php echo ($ov['tambahan_pilihan']!='')?'</div>':''; ?>
				<?php if(count($ov['anak_pilihan'])>0) { ?>
				
				<?php foreach($ov['anak_pilihan'] as $ook => $oov) { ?>
				<div style="float:left;padding-left:40px;">
					<label class="radio">
					<?php
					$checked = '';
					if(array_key_exists($kv['id_pertanyaan'], $jawaban)) {
						$checked = $jawaban[$kv['id_pertanyaan']]['data_kuisoner_pilihan_id']==$oov['id_pilihan']?'checked':'';
					}
					?>
					<input type="radio" class="radiobutton ans_<?php echo $kv['id_pertanyaan']; ?>" ref="<?php echo $kv['id_pertanyaan']; ?>" name="ans_<?php echo $kv['id_pertanyaan']; ?>" <?php echo $checked; ?>  value="<?php echo $oov['id_pilihan']; ?>">
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
		<div class="btn btn-info" id="abahsoft_responden_edit_survey_btnsave">Simpan</div>
		<div class="btn btn-danger" onClick="closeSurveyEdit();">Batal</div>
	</div>
	
	<script type="text/javascript">
		$(function() {

			$('#abahsoft_responden_edit_survey_btnsave').click(function() {
				//alert('Untuk sementara data tidak dapat diubah');
				var data = '';
				var idused = [];
				$('.radiobutton').each(function() {
					var thisref = $(this).attr('ref');
					if($('input[name=ans_'+thisref+']:checked').val() && $.inArray(thisref, idused)<0) {
						var otheres = '';
						if($('#oth_'+thisref).length>0) {
							otheres = $('#oth_'+thisref).val();
						}
						data += 'ans['+thisref+']='+$('input[name=ans_'+thisref+']:checked').val()+'_'+otheres+'&';
						idused.push(thisref);
					}
				});

				$.ajax({
					type  : 'post',
					url   : base_url+'responden/survey_edit/<?php echo $data_id; ?>',
					data  : data,
					cache : false,
					success: function(html) {
						if(html==1) {
							closeSurveyEdit();
							showRespondenDetil_reload(<?php echo $data_id; ?>);
						}
					}
				});
			});
		});
	</script>
	<?php } ?>
<?php } ?>

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