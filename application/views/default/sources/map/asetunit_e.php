	<tr><td width="250px">Kode Unit SKPD</td><td width="5px">:</td><td width="*"><?php echo $aset[0]['kd_uskpd']; ?></td></tr>
	<tr><td width="250px">Nama Unit SKPD</td><td width="5px">:</td><td width="*"><?php echo $aset[0]['nm_uskpd']; ?></td></tr>
	<tr><td>Kode Bidang</td><td>:</td><td><?php echo $aset[0]['kd_bidskpd']; ?></td></tr>
	<tr><td>Alamat</td><td>:</td><td><?php echo $aset[0]['alamat']; ?></td></tr>
	<tr>
	<td>Lokasi</td><td>:</td><td><i class="icon-target-2" style="font-size:12px;cursor:pointer;" onClick="showRespondenMap(<?php echo "'".$aset[0]['no_reg'] ."'";?>)"></i> (lat: <?php echo $aset[0]['data_map_latitude'].', lon: '.$aset[0]['data_map_longitude']; ?>)</td>
	</tr>
 
<?php
//echo"yyyyy";exit;

//var_dump($aset);
//exit;
//echo count($aset);exit;
if(count($aset)>0) {
?>
	<tr><td colspan=3>
		<table class="table table-striped" style="width:98%">
			<thead>
			  <tr align="left">
				 <th>No</th>
				 <th>No. Reg</th>
				 <th>Kode Barang</th>
				 <th>Nama Barang</th>
				 <th>No Dokumen</th>
				 <th>Detail</th>
			  </tr>
			</thead>

<?php 
    //$noregteks = "'".$asetdata['no_reg'] ."'";
	 //echo $noregteks;exit;
	 $i=1;
	 foreach($aset as $asetdata){
	?>	
	<tr>
	    <td width="*"><?php echo $i; ?></td> 
		<td width="*"><?php echo $asetdata['no_reg']; ?></td> 
		<td width="*"><?php echo $asetdata['kd_brg']; ?></td>
		<td><?php echo $asetdata['nm_brg']; ?></td>
		<td><?php echo $asetdata['no_dokumen']; ?></td>
		<td><a href="javascript:void(0);" onClick="showAsetDetail('<?php echo $asetdata['no_reg']; ?>','<?php echo $asetdata['kd_brg']; ?>')" >Detail</td>
	</tr>

	<?php
	    $i++;
	}
	?>
	</table>
	</td></tr>
<?php
}
?>