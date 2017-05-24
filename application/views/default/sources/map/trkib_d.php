<?php
//echo"yyyyy";exit;
$Get_url = "http://" . $_SERVER['HTTP_HOST'];
if(count($responden)>0) {
     $noregteks = "'".$responden['no_reg'] ."'";
	 //echo $noregteks;exit;
	?>	
	<tr><td width="250px">No. SKPD</td><td width="5px">:</td><td width="*"><?php echo $responden['kd_skpd']; ?> &nbsp | <?php echo $responden['nm_skpd']; ?> </td></tr>
	<tr><td width="250px">No. Register</td><td width="5px">:</td><td width="*"><?php echo $responden['no_reg']; ?></td></tr>
	<tr><td width="250px">Kode Barang</td><td width="5px">:</td><td width="*"><?php echo $responden['kd_brg']; ?></td></tr>
	<tr><td>Nama Barang</td><td>:</td><td><?php echo $responden['nm_brg']; ?></td></tr>	 
	<tr><td>Nama Jalan</td><td>:</td><td><?php echo $responden['alamat1']; ?></td></tr>	
	<!--<tr><td>Koordinat</td><td>:</td><td>Lat:<?php echo $responden['lat']; ?> &nbsp | Lon:<?php echo $responden['lon']; ?></td></tr>-->
	<tr><td>Panjang</td><td>:</td><td><?php echo $responden['panjang']; ?> KM</td></tr>	
	<tr><td>Kondisi</td><td>:</td><td>
	<?php 
	    if ($responden['kondisi']=='B') {echo "Baik" ;}
		else if ($responden['kondisi']=='RR') {echo "Rusak Ringan" ;}
		else echo "Rusak Berat"; 
	
	?>  </td></tr>	
	<!--
	  <tr><td>Lokasi Map</td><td>:</td><td><i class="icon-target-2" style="font-size:12px;cursor:pointer;" onClick="showRespondenMap(<?php echo $noregteks;?>)"></i> (lat: <?php echo $responden['lat'].', lon: '.$responden['lon']; ?>)</td></tr>
	-->
	<tr><td>No. Dokumen</td><td>:</td><td><?php echo $responden['no_dokumen']; ?></td></tr>
	<tr><td> Foto</td><td>:</td><td></td></tr>
	<!--<tr><td> </td><td> </td><td><?php if ($responden['foto']) { echo "<img src ='" . $Get_url."/simbakdagis/foto/".$responden['foto']."'>";} else { echo "<img src ='" . $Get_url."/simbakdagis/foto/noimage.jpg"."'>";} ?></td></tr>-->
	<tr><td> </td><td> </td><td><?php if ($responden['foto']) { echo "<img src ='" . $Get_url."/simbakda/data/".$responden['foto']."'>";} else { echo "<img src ='" . $Get_url."/simbakdagis/foto/noimage.jpg"."'>";} ?></td></tr>
	<tr><td> Video</td><td>:</td><td></td></tr>
	<tr><td> </td><td> </td><td>
	<video width="320" height="240" controls>
	<source src = <?php if ($responden['video']!="") echo(base_url()."/foto/" .$responden['video']); else echo(base_url()."/foto/noimage.jpg"); ?> >
	Your browser does not support the video tag.
    </video> 
	</td></tr>

	<?php
}
?>
 
</video> 