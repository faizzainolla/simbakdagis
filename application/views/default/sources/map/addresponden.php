	
	<tr><td width="250px">No. Register</td><td width="5px">:</td><td width="*">
		<input type="text" style="width:300px;" id="add_noreg_brg" placeholder="##.##.##.##.##.####" value="<?php echo $noreg; ?>"></td></tr>
	<tr><td width="250px">Kode Barang</td><td width="5px">:</td><td width="*">
		<input type="text" style="width:300px;" id="add_kd_brg" placeholder="##.##.##.##.##" value="<?php echo $kdbrg; ?>"></td></tr>
	<!--
	<tr><td>Alamat</td><td>:</td><td>
		<input type="text" style="width:200px;" id="add_alamat_brg" placeholder="Alamat" value="">
		<input type="text" style="width:100px;" id="add_alamat2_brg" placeholder="Kabupaten" value=""></td></tr>
		-->
	<tr><td>Lokasi Map</td><td>:</td><td>
		<i class="icon-target-2" style="font-size:12px;cursor:pointer;"></i> (lat: <?php echo $lat.', lon: '.$long; ?>)
		<input type="hidden" id="add_lat" value="<?php echo $lat;?>">
		<input type="hidden" id="add_lon" value="<?php echo $long;?>"></td></tr>
	<!--	
	<tr><td>No. Dokumen</td><td>:</td><td>
		<input type="text" style="width:300px;" id="add_nodok_brg" placeholder="Nomor Dokumen" value=""></td></tr>
	<tr><td>No. Sertifikat</td><td>:</td><td>
		<input type="text" style="width:300px;" id="add_noser_brg" placeholder="Nomor Sertifikat" value=""></td></tr>
	<tr><td> Tgl. sertifikat</td><td>:</td><td>
		<input type="date" style="width:300px;" id="add_tglser_brg" placeholder="##/##/####" name="add_tglser_brg"></td></tr>
	-->	
	<tr><td colspan="3" align="center"><input type='button' value='Save Data' onclick='saveResponden()'/></td></tr>