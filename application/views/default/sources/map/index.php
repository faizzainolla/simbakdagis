	<div class="abahsoft_left_content" id="abahsoft_content_pengaturan">
		<div class="abahsoft_left_content_data">
			<h2><i class="icon-users"></i> Daftar Pengguna</h2>
			<div class="aLignRight" style="padding-bottom: 10px;">
				<div class="btn btn-info" onClick="showPenggunaAdd();">Tambah Pengguna</div>
			</div>
			<table class="table table-bordered table-striped" id="abahsoft_users">
				<thead>
					<tr>
						<th width="10%">No.</th>
						<th width="40%">Nama Pegawai</th>
						<th width="40%">Pengguna</th>
						<th width="20%">Akses Login</th>
						<th width="20%">Status</th>
						<th width="10%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="5"></td>
					</tr>
				</tbody>
			</table>
			<br/>
		</div>
	</div>
	<div class="abahsoft_left_content" id="abahsoft_content_responden">
		<div class="abahsoft_left_content_data">
			<h2><i class="icon-users"></i> Daftar Responden</h2>
			<div style="position:absolute;top:80px;">
				<div class="button bg-active-darkblue fg-white" onClick="showRespondenAdd();">Tambah Responden</div>
			</div>
			<table class="table table-bordered table-striped" id="abahsoft_respondens">
				<thead>
					<tr>
						<th width="18%">No.</th>
						<th width="18%">No. Identitas</th>
						<th width="18%">NIK</th>
						<th width="30%">Nama</th>
						<th width="40%">Alamat</th>
						<th width="6%">RT</th>
						<th width="6%">RW</th>
						<th width="6%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="8"></td>
					</tr>
				</tbody>
			</table>
			<br/>
		</div>
	</div>
	<div class="abahsoft_left_content" id="abahsoft_content_responden_detail" style="z-index:41;">
		<div class="abahsoft_left_content_data">
			<div id="abahsoft_preload_responden_detail">
				<div class="progress progress-indeterminate">
					<div class="win-ring small"></div>Mengambil data aset...
				</div>
			</div>
			<div id="abahsoft_loaded_responden_detail">
				<a id="abahsoft_close_responden_detail" class="" href="javascript:void(0);">
				 <i class="icon-cancel fg-red on-left"></i>
				</a> Kembali
				<br/><br/>
				<table class="table table-striped" id="abahsoft_table_responden_detail">
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	
	<div class="abahsoft_left_content" id="abahsoft_content_aset_detail" style="z-index:42;">
		<div class="abahsoft_left_content_data">
			<div id="abahsoft_preload_aset_detail">
				<div class="progress progress-indeterminate">
					<div class="win-ring small"></div>Mengambil data aset...
				</div>
			</div>
			<div id="abahsoft_loaded_aset_detail">
				<a id="abahsoft_close_aset_detail" class="" href="javascript:void(0);">
				 <i class="icon-cancel fg-red on-left"></i>
				</a> Kembali
				<br/><br/>
				<table class="table table-striped" id="abahsoft_table_aset_detail">
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<div class="abahsoft_left_content" id="abahsoft_content_responden_edit" style="z-index:42;">
		<div class="abahsoft_left_content_data">
			<div id="abahsoft_preload_responden_edit">
				<div class="progress progress-indeterminate">
					<div class="win-ring small"></div>Mengambil data responden...
				</div>
			</div>
			<div id="abahsoft_loaded_responden_edit">
				<a id="abahsoft_close_responden_edit" class="win-backbutton" href="javascript:void(0);"></a> Kembali
				<br/><br/>
				<div id="abahsoft_table_responden_edit"></div>
			</div>
		</div>
	</div>


	<div class="abahsoft_left_content" id="abahsoft_content_petatematik">
		<div class="abahsoft_left_content_data">
			<div id="abahsoft_loaded_petatematik">
				<div id="abahsoft_left_content_data_tematik"></div>
			</div>
		</div>
	</div>

	<div class="abahsoft_left_content" id="abahsoft_content_add_pengguna">
		<div class="abahsoft_left_content_data">
			<div id="abahsoft_preload_adduser">
				<div class="progress progress-indeterminate">
					<div class="win-ring small"></div> Menyiapkan data...
				</div>
			</div>
			<div id="abahsoft_loaded_adduser">
				<a id="abahsoft_close_pengguna_add" class="win-backbutton" href="javascript:void(0);"></a> Kembali
				<br/><br/>
				<div id="abahsoft_left_content_adduser_html"></div>
			</div>
		</div>
	</div>

	<div class="abahsoft_left_content" id="abahsoft_content_add_responden">
		<div class="abahsoft_left_content_data">
			<div id="abahsoft_preload_add_responden">
				<div class="progress progress-indeterminate">
					<div class="win-ring small"></div> Menyiapkan data...
				</div>
			</div>
			<div id="abahsoft_loaded_add_responden">
				<a id="abahsoft_close_responden_add" class="win-backbutton" href="javascript:void(0);"></a> Kembali
				<br/><br/>
				<div id="abahsoft_left_content_add_responden_html"></div>
			</div>
		</div>
	</div>
	
	<!-- start abahsoft right content -->
	<div class="abahsoft_right_content">
	
		<input type="hidden" id="abahsoft_active_right">
		<!-- start pemetaan -->
		<div class="sidebar-container abahsoft_right_content_data" id="abahsoft_right_content_pemetaan">
		<div class="title text-bold"> <i class="icon-search on-left"></i>Pencarian Data Aset </div><br>
			<div id="abahsoft_form_quick_search" class="input-control select" style="text-align:left">
				<!--div id="daftarskpd" class="input-control select"></div-->
				<div id="filterskpd" class="input-control select">
				  <select class="cskpd" style="width:260px" id="filterskpdx" onchange="showQuickSearch();">
					<option id="filterskpdx" value="nol" font-size="12px">-- Pilih Satuan Kerja --</option>
					<?php foreach($skpd as $row) { ?>
					<option id="filterskpd" value="<?php echo $row['kd_skpd']; ?>"><?php echo $row['kd_skpd']; ?>|<?php echo $row['nm_skpd']; ?></option>
					<?php } ?>
				  </select>
				</div>
				<div id="abahsoft_search_gol" class="input-control select">
				  <select class="cgol" style="width:260px" id="abahsoft_quick_search_rw" onchange="showQuickSearch();">
					<option id="abahsoft_quick_search_gol_nol" value="nol" font-size="12px">-- Golongan Aset --</option>
					<?php foreach($golongan as $gol) { ?>
					<option id="abahsoft_quick_search_gol_<?php echo $gol['golongan']; ?>" value="<?php echo $gol['golongan']; ?>"> <?php echo $gol['name']; ?></option>
					<?php } ?>
				  </select>
				</div>
				<!-----------faiz 05/05/2017------------>
				<div id="sebaran_kecamatan" class="input-control select">
				  <select class="csebaran_kecamatan" style="width:260px" id="csebaran_kecamatan" onchange="showQuickSearch();showkelurahan();">
					<option id="csebaran_kecamatan" value="" font-size="12px">-- Kecamatan --</option>
					<?php foreach($kecamatan as $kec) { ?>
					<option id="csebaran_kecamatan" value="<?php echo $kec['kd_skpd']; ?>"> <?php echo $kec['nm_skpd']; ?></option>
					<?php } ?>
				  </select>
				</div>
				
				<div id="sebaran_kelurahan" class="input-control select">
					<select class="csebaran_kelurahan" style="width:260px" name="csebaran_kelurahan" id="csebaran_kelurahan" onchange="showQuickSearch();">
						<input type='text' class='csebaran_kelurahan hide' id='csebaran_kelurahan' name='csebaran_kelurahan' />
					</select>
				</div>
				<!-----------end------------>
				
				<!--div id="abahsoft_search_bid" class="input-control select">
					<select style="width:260px" id="abahsoft_quick_search_bid">
						<option id="abahsoft_quick_search_bid_nol" value="nol">-- Bidang Aset <?php //echo $kelurahan_data['kelurahan_nama']; ?> --</option>
					</select>
				</div>
				<div id="abahsoft_search_kel" class="input-control select">
					<select style="width:260px" id="abahsoft_quick_search_kel">
						<option id="abahsoft_quick_search_kel_nol" value="nol">-- Kelompok Aset <?php //echo $kelurahan_data['kelurahan_nama']; ?> --</option>
					</select>
				</div-->
				<!--------------------->
				<!--<div id="abahsoft_search_sub" class="input-control select">
					<select style="width:260px" id="abahsoft_quick_search_sub">
						<option id="abahsoft_quick_search_su_nol" value="nol">-- Sub-Kelompok Aset <?php //echo $kelurahan_data['kelurahan_nama']; ?> --</option>
					</select>
				</div>
				<div id="abahsoft_search_brg" class="input-control select">
					<select style="width:260px" id="abahsoft_quick_search_brg">
						<option id="abahsoft_quick_search_brg_nol" value="nol">-- Barang Aset <?php //echo $kelurahan_data['kelurahan_nama']; ?> --</option>
					</select>
				</div>-->
				<div  class="input-control text" data-role="input-control">
				   <input type="text" style="width:300px;" id="abahsoft_quick_search" placeholder="*detail brg/alamat/Keterangan" value="">
				   <button class="btn-clear" type="button" tabindex="1"></button>
				</div>
				<br>
		
				<div id="abahsoft_close_quick_search" style="display:none;height:16px;">
				<i class="icon-cancel fg-red on-left"></i><b>Hasil Pencarian Data Aset:</b></div>
					
			</div>
			<div class="ckwx" id="abahsoft_quick_search_result" style="height:250px;overflow:auto"></div><br/>
			<div class="markcol">Keterangan:<br/>
				<img src='./markers/7.png'/>  : </a>Fasum/Fasos</a><br/>
				<img src='./markers/9.png'/>  : </a>Bersertifikat</a><br/>
				<img src='./markers/10.png'/>  : </a>Belum Bersertifikat</a><br/>
				<img src='./markers/26.png'/>  : </a>Bersertifikat Sengketa</a><br/>
				<img src='./markers/8.png'/>  : </a>Belum Bersetifikat Sengketa</a><br/>
			</div>
		</div>
		<!-- end pemetaan -->
		
		<!-- start add point -->
		<div class="sidebar-container abahsoft_right_content_data" id="abahsoft_right_content_addpoint">
		<div class="title text-bold"> <i class="icon-search on-left"></i>Penambahan Lokasi Aset </div><br>
			<div id="abahsoft_form_add_search" class="input-control select">
               <div id="daftarskpdadd" class="input-control select"></div>
				<div id="abahsoft_addsearch_gol" class="input-control select">
				  <select style="width:260px" id="abahsoft_add_search_rw">
					<option id="abahsoft_add_search_gol_nol" value="nol" font-size="12px">-- Golongan Aset <?php //echo $kelurahan_data['kelurahan_nama']; ?> --</option>
					<?php foreach($golongan as $gol) { ?>
					<option id="abahsoft_add_search_gol_<?php echo $gol['golongan']; ?>" value="<?php echo $gol['golongan']; ?>"> <?php echo $gol['name']; ?> <?php //echo $kelurahan_data['kelurahan_nama']; ?></option>
					<?php } ?>
				  </select>
				</div>
				<div id="abahsoft_addsearch_bid" class="input-control select">
					<select style="width:260px" id="abahsoft_add_search_bid">
						<option id="abahsoft_add_search_bid_nol" value="nol">-- Bidang Aset <?php //echo $kelurahan_data['kelurahan_nama']; ?> --</option>
					</select>
				</div>
				<div id="abahsoft_addsearch_kel" class="input-control select">
					<select style="width:260px" id="abahsoft_add_search_kel">
						<option id="abahsoft_add_search_kel_nol" value="nol">-- Kelompok Aset <?php //echo $kelurahan_data['kelurahan_nama']; ?> --</option>
					</select>
				</div>
				<!--<div id="abahsoft_addsearch_sub" class="input-control select">
					<select style="width:260px" id="abahsoft_add_search_sub">
						<option id="abahsoft_add_search_su_nol" value="nol">-- Sub-Kelompok Aset <?php //echo $kelurahan_data['kelurahan_nama']; ?> --</option>
					</select>
				</div>
				<div id="abahsoft_addsearch_brg" class="input-control select">
					<select style="width:260px" id="abahsoft_add_search_brg">
						<option id="abahsoft_add_search_brg_nol" value="nol">-- Barang Aset <?php //echo $kelurahan_data['kelurahan_nama']; ?> --</option>
					</select>
				</div>-->
				<div  class="input-control text" data-role="input-control">
				   <input type="text" style="width:260px;" id="abahsoft_add_search" placeholder="Id Barang" value="">
				   <button class="btn-clear" type="button" tabindex="1"></button>
				</div>
				<br>
				  
				<div id="abahsoft_close_add_search" style="display:none;height:16px;">
				<i class="icon-cancel fg-red on-left"></i><b>Hasil Pencarian Data Aset: </b></div>
			</div>
			<div id="abahsoft_add_search_result" style="height:250px;overflow:auto"></div>
		</div>
		<!-- end add point -->
		
		<!-- start add id barang -->
		<div class="sidebar-container abahsoft_right_content_data" id="abahsoft_right_content_add_barang">
		<div class="item-title"> <i class="icon-search on-left"></i>Pencarian Id Barang berdasarkan Aset </div><br>
			<div id="abahsoft_form_barang_search" class="input-control select" style="text-align:center">
				<div id="abahsoft_barang_search_gol" class="input-control select">
				  <select style="width:260px" id="abahsoft_barang_search_rw">
					<option id="abahsoft_barang_search_gol_nol" value="nol" font-size="12px">-- Golongan Aset <?php //echo $kelurahan_data['kelurahan_nama']; ?> --</option>
					<?php foreach($golongan as $gol) { ?>
					<option id="abahsoft_barang_search_gol_<?php echo $gol['golongan']; ?>" value="<?php echo $gol['golongan']; ?>"> <?php echo $gol['name']; ?> <?php //echo $kelurahan_data['kelurahan_nama']; ?></option>
					<?php } ?>
				  </select>
				</div>
				<div id="abahsoft_barang_search_bid" class="input-control select">
					<select style="width:260px" id="abahsoft_barang_search_bid">
						<option id="abahsoft_barang_search_bid_nol" value="nol">-- Bidang Aset <?php //echo $kelurahan_data['kelurahan_nama']; ?> --</option>
					</select>
				</div>
				<div id="abahsoft_barang_search_kel" class="input-control select">
					<select style="width:260px" id="abahsoft_barang_search_kel">
						<option id="abahsoft_barang_search_kel_nol" value="nol">-- Kelompok Aset <?php //echo $kelurahan_data['kelurahan_nama']; ?> --</option>
					</select>
				</div>
				<div id="abahsoft_barang_search_sub" class="input-control select">
					<select style="width:260px" id="abahsoft_barang_search_sub">
						<option id="abahsoft_barang_search_su_nol" value="nol">-- Sub-Kelompok Aset <?php //echo $kelurahan_data['kelurahan_nama']; ?> --</option>
					</select>
				</div>
				<div id="abahsoft_barang_search_brg" class="input-control select">
					<select style="width:260px" id="abahsoft_barang_search_brg">
						<option id="abahsoft_barang_search_brg_nol" value="nol">-- Barang Aset <?php //echo $kelurahan_data['kelurahan_nama']; ?> --</option>
					</select>
				</div>
				<div  class="input-control text" data-role="input-control">
				   <input type="text" style="width:260px;" id="abahsoft_barang_search" placeholder="No. Id Barang Aset" value="">
				   <button class="btn-clear" type="button" tabindex="-1"></button>
				</div>
				<br><br>
				<div class="item-title "> <i class="icon-share-3 on-left"></i>  Hasil Pencarian Data Aset: </div><br>
				<div id="abahsoft_close_barang_search" style="display:none;height:16px;margin-top:-10px;"><i class="icon-cancel fg-red on-left"></i></div>
			</div>
			<div id="abahsoft_barang_search_result" style="height:250px;overflow:auto"></div>
		</div>

		<!-- end add point -->
		
		
		
		
		<div class="abahsoft_right_content_data" id="abahsoft_right_content_responden"><!--<h3>Petunjuk Aksi</h3>!--></div>
		<div class="abahsoft_right_content_data" id="abahsoft_right_content_datakuisoner"><h3><b>Data Kuisoner</b></h3>
			<div class="abahsoft_right_list_menu_kuisoner abahsoft_right_list_menu_data_kuisoner">
				<ul>
					<li id="abahsoft_list_datakuisoner_group" class="abahsoft_list_datakuisoner">Data Group Kuisoner</li>
					<li id="abahsoft_list_datakuisoner_option" class="abahsoft_list_datakuisoner">Data Kuisoner</li>
					<li id="abahsoft_list_datakuisoner_print" class="abahsoft_list_datakuisoner">Unduh Kuisoner</li>
				</ul>
			</div>
		</div>
		<div class="abahsoft_right_content_data" id="abahsoft_right_content_pengaturan">
			<!-- <h3><b>Daftar Menu Pengaturan</b></h3>
			<div class="abahsoft_right_list_menu">
				<ul>
					<li>Pengguna</li>
				</ul>
			</div> -->
		</div>

		
		<!--Start Blok menu peta tematik -->
		
		<div class="sidebar-container" id="abahsoft_right_content_petatematik">	
		   <div class="abahsoft_right_petatematik_menu" style="margin-top:0px;">
			  <nav class="sidebar light">
			  	<ul>
				<li class="title">Kelompok Aset</li>
								
				<?php $firstshow = 0; foreach($golongan as $kg => $vg) { ?>
					<?php if ($kg=='01'){ ?>
					  <li class="stick bg-red">
					  <a class="dropdown-toggle bg-hover-red" href=""><i class="icon-layers"></i>										
					<?php } ?>
					
		
					    <?php echo $vg['name']; ?>
					</a>
					
					<ul id="dropdown_menu_<?php echo $kg;?>" class="dropdown-menu" data-role="dropdown">
					<?php foreach ($vg['bidang'] as $kq => $vq) {
						$kq = str_replace(".","_",$kq) ;
						if($firstshow==0) { ?>
							<input type="hidden" id="abahsoft_right_petatematik_menu_inload" value="<?php echo $kq; ?>">
							<?php $firstshow = 1; 
						} ?>
						     <li id="abahsoft_tematik_<?php echo $kq;?>" > <a> <?php echo $vq['name']; ?> </a></li>
					<?php } ?>
					</ul>
					</li>
				<?php } ?>
				
				</ul><br>
				<b>Info Tanah:</b><br>
				<?php 
				foreach($st_tanah as $row){?>
					<table border="0">
						<tr><td><?php echo $row['st'];?></td> <td> : Bersertifikat</td></tr>
						<tr><td><?php echo $row['bst'];?></td> <td>  : Belum Bersertifikat</td></tr>
						<tr><td><?php echo $row['bs'];?></td> <td>  : Bersertifikat Sengketa</td></tr>
						<tr><td><?php echo $row['bbs'];?></td> <td>  : Belum Bersertifikat Sengketa</td></tr>
						<?php }?>
					</table>
			 </nav>	
		 </div>
		</div>
		<!--Start end menu peta tematik -->
		
		<!--Peta Kawasan -->
		<div class="sidebar-container" id="abahsoft_right_content_editpetakawasan">
			<div class="item-title"> <i class="icon-search on-left"></i>Data Kawasan </div>
		</div>
		
		<div class="sidebar-container" id="abahsoft_right_content_petakawasan">			 		
			<div  class="abahsoft_right_petakawasan_menu" style="margin-top:0px;">	           
			    		                 
				 <div id="daftar_kawasan"></div>
				 <div id="daftar_jalan"></div>
				 <div id="daftar_drainase"></div>
		

		
		    
			</div>		
			 
		</div>
		<!-- End of Peta Kawasan -->
		
		
		
		
		
	<!-- end abahsoft right content -->
	</div>	