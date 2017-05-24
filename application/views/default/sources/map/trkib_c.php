<?php
//echo"yyyyy";exit;
$Get_url = "http://" . $_SERVER['HTTP_HOST'];
if(count($responden)>0) {
     $noregteks = "'".$responden['no_reg'] ."'";
	 //echo $noregteks;exit;
	?>
	<tr><td width="250px">No. SKPD</td><td width="5px">:</td><td width="*"><?php echo $responden['kd_skpd']; ?> &nbsp | <?php echo $responden['nm_skpd']; ?> </td></tr>	
	<tr><td width="250px">No. Register</td><td width="5px">:</td><td width="*"><?php echo $responden['no_reg']; ?></td></tr>
	<tr><td width="250px">Id. Barang</td><td width="5px">:</td><td width="*"><?php echo $responden['id_barang']; ?></td></tr>
	<tr><td width="250px">Kode Barang</td><td width="5px">:</td><td width="*"><?php echo $responden['kd_brg']; ?></td></tr>
	<tr><td>Nama Barang</td><td>:</td><td><?php echo $responden['nm_brg']; ?></td></tr>
	<tr><td width="250px">Detail Barang</td><td width="5px">:</td><td width="*"><?php echo $responden['detail_brg']; ?></td></tr>
	<tr><td>Alamat</td><td>:</td><td><?php echo $responden['alamat1']; echo $responden['alamat2']; ?></td></tr>
	<tr><td>Lokasi Map</td><td>:</td><td><i class="icon-target-2" style="font-size:12px;cursor:pointer;" onClick="showRespondenMap(<?php echo $noregteks;?>)"></i> (lat: <?php echo $responden['lat'].', lon: '.$responden['lon']; ?>)</td></tr>
	<tr><td>No. Dokumen</td><td>:</td><td><?php echo $responden['no_dokumen']; ?></td></tr>
	<tr><td> Foto</td><td>:</td><td></td></tr>
		<tr><td> </td><td> </td><td><?php if ($responden['foto1']) { echo "<img src ='" . $Get_url."/simbakda/data/".$responden['foto1']."'>";} else { echo "<img src ='" . $Get_url."/simbakdagis/foto/noimage.jpg"."'>";} ?> </td></tr>
		<tr><td> </td><td> </td><td><?php if ($responden['foto2']) { echo "<img src ='" . $Get_url."/simbakda/data/".$responden['foto2']."'>";} else { echo "<img src ='" . $Get_url."/simbakdagis/foto/noimage.jpg"."'>";} ?> </td></tr>
		<tr><td> </td><td> </td><td><?php if ($responden['foto3']) { echo "<img src ='" . $Get_url."/simbakda/data/".$responden['foto3']."'>";} else { echo "<img src ='" . $Get_url."/simbakdagis/foto/noimage.jpg"."'>";} ?> </td></tr>
		<tr><td> </td><td> </td><td><?php if ($responden['foto4']) { echo "<img src ='" . $Get_url."/simbakda/data/".$responden['foto4']."'>";} else { echo "<img src ='" . $Get_url."/simbakdagis/foto/noimage.jpg"."'>";} ?> </td></tr>
	<?php
}
?>