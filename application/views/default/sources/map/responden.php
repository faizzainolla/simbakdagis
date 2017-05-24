<?php
//echo"yyyyy";exit;
if(count($responden)>0) {
     $noregteks = "'".$responden['no_reg'] ."'";
	 //echo $noregteks;exit;
	?>	
	<tr><td width="250px">No. Register</td><td width="5px">:</td><td width="*"><?php echo $responden['no_reg']; ?></td></tr>
	<tr><td width="250px">Kode Barang</td><td width="5px">:</td><td width="*"><?php echo $responden['kd_brg']; ?></td></tr>
	<tr><td>Nama Barang</td><td>:</td><td><?php echo $responden['nm_brg']; ?></td></tr>
	<tr><td>Alamat</td><td>:</td><td><?php echo $responden['alamat1']; echo $responden['alamat2']; ?></td></tr>
	<tr><td>Lokasi Map</td><td>:</td><td><i class="icon-target-2" style="font-size:12px;cursor:pointer;" onClick="showRespondenMap(<?php echo $noregteks;?>)"></i> (lat: <?php echo $responden['data_map_latitude'].', lon: '.$responden['data_map_longitude']; ?>)</td></tr>
	<tr><td>No. Dokumen</td><td>:</td><td><?php echo $responden['no_dokumen']; ?></td></tr>
	<tr><td>No. Sertifikat</td><td>:</td><td><?php echo $responden['no_sertifikat']; ?></td></tr>
	<tr><td> Tgl. sertifikat</td><td>:</td><td><?php echo $responden['tgl_sertifikat']; ?></td></tr>
	<?php
}
?>