<?php
if(count($unit)>0) {
	?>	
	<tr><td width="250px">Kode Unit SKPD</td><td width="5px">:</td><td width="*"><?php echo $unit['kd_uskpd']; ?></td></tr>
	<tr><td width="250px">Nama Unit SKPD</td><td width="5px">:</td><td width="*"><?php echo $unit['nm_uskpd']; ?></td></tr>
	<tr><td>Kode Bidang</td><td>:</td><td><?php echo $unit['kd_bidskpd']; ?></td></tr>
	<tr><td>Alamat</td><td>:</td><td><?php echo $unit['alamat']; ?></td></tr>
	<tr><td>Lokasi Map</td><td>:</td><td><i class="icon-target-2" style="font-size:12px;cursor:pointer;" onClick="showunitMap(<?php echo $unit['kd_uskpd']; ?>)"></i> (lat: <?php echo $unit['data_map_latitude'].', lon: '.$unit['data_map_longitude']; ?>)</td></tr>
	<tr><td colspan=3>
		<table class="table table-striped" style="width:98%">
			<thead>
			  <tr>
				 <th>#</th>
				 <th>No. Reg</th>
				 <th>No. Dokumen</th>
				 <th>Nama Barang</th>
				 <th>Detail</th>
			  </tr>
			</thead>
		<?php $i=1; foreach($asset as $a):?>
			<tr>
			<td style='text-align:center'><?php echo $i.'. ';?></td>
			<td style='text-align:center'><?php echo $a['no_reg'];?></td>
			<td style='text-align:center'><?php echo $a['no_dokumen'];?></td>
			<td style='text-align:center'><?php echo $a['nm_brg'];?></td>
			<td style='text-align:center'><a href="#" onclick="#">Detail</a></td>
			<tr>
			<?php $i++;?>
		<?php endforeach;?>
		</table>
	</td></tr>
	<?php
}
?>