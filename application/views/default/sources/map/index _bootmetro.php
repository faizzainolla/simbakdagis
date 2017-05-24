
	<div class="abahsoft_left_content" id="abahsoft_content_dashboard">
		<div class="abahsoft_left_content_data">
			<div id="abahsoft_preload_dashboard_content">
				<div class="progress progress-indeterminate">
					<div class="win-ring small"></div>Mengumpulkan data...
				</div>
			</div>
			<div id="abahsoft_loaded_dashboard_content">
				<div id="abahsoft_table_dashboard_content"></div>
			</div>
		</div>
	</div>
	<div class="abahsoft_left_content" id="abahsoft_content_datakuisoner">
		<div class="abahsoft_left_content_data">
			<div id="abahsoft_preload_kuisoner_content">
				<div class="progress progress-indeterminate">
					<div class="win-ring small"></div>Mengambil data kusioner...
				</div>
			</div>
			<div id="abahsoft_loaded_kuisoner_content">
				<div id="abahsoft_table_kuisoner_content"></div>
			</div>
		</div>
	</div>
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
				<div class="btn btn-info" onClick="showRespondenAdd();">Tambah Responden</div>
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
					<div class="win-ring small"></div>Mengambil data responden...
				</div>
			</div>
			<div id="abahsoft_loaded_responden_detail">
				<a id="abahsoft_close_responden_detail" class="win-backbutton" href="javascript:void(0);"></a> Kembali
				<br/><br/>
				<table class="table table-striped" id="abahsoft_table_responden_detail">
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
	<div class="abahsoft_left_content" id="abahsoft_content_survey_edit" style="z-index:42;">
		<div class="abahsoft_left_content_data">
			<div id="abahsoft_preload_survey_edit">
				<div class="progress progress-indeterminate">
					<div class="win-ring small"></div>Mengambil data survey...
				</div>
			</div>
			<div id="abahsoft_loaded_survey_edit">
				<a id="abahsoft_close_survey_edit" class="win-backbutton" href="javascript:void(0);"></a> Kembali
				<br/><br/>
				<div id="abahsoft_table_survey_edit"></div>
			</div>
		</div>
	</div>
	<div class="abahsoft_left_content" id="abahsoft_content_rekapitulasi">
		<div class="abahsoft_left_content_data">
			<div id="abahsoft_preload_rekap">
				<div class="progress progress-indeterminate">
					<div class="win-ring small"></div> Menghitung data...
				</div>
			</div>
			<div id="abahsoft_loaded_rekap">
				<div id="abahsoft_left_content_data_html"></div>
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
	
	<div class="abahsoft_left_content" id="abahsoft_content_kuisoner_option_add">
		<div class="abahsoft_left_content_data">
			<div id="abahsoft_preload_option_add">
				<div class="progress progress-indeterminate">
					<div class="win-ring small"></div> Menyiapkan data...
				</div>
			</div>
			<div id="abahsoft_loaded_option_add">
				<a id="abahsoft_close_option_add" class="win-backbutton" href="javascript:void(0);"></a> Kembali
				<br/><br/>
				<div id="abahsoft_kuisoner_option_add_html">
					<table class="table table-striped" width="100%">
						<tr>
							<td width="120px">Group Kuisoner</td>
							<td width="5px">:</td>
							<td width="*">
								<input type="text" id="kadd_id" value="">
								<select id="kadd_group">
									<option value="">-- pilih group --</option>
								<?php foreach($groups as $kg => $vg) { ?>
									<option id="abahsoft_add_kuisoner_group_<?php echo $vg['kuisoner_group_id']; ?>" value="<?php echo $vg['kuisoner_group_id']; ?>" <?php echo $vg['kuisoner_group_status']==1?'':'disabled'; ?>><?php echo $vg['kuisoner_group_nama']; ?></option>
								<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Pertanyaan</td>
							<td>:</td>
							<td>
								<textarea id="kadd_pertanyaan" style="width:100%;"></textarea>
								<label class="checkbox">
									<input type="checkbox" id="kadd_isrekap"><span class="metro-checkbox" style="width:200px;">tampilkan dalam rekap</span>
								</label>
								<div id="kadd_box_rekap_nama" style="display:none;">Nama Rekap <input type="text" id="kadd_rekap_nama" value=""></div>
							</td>
						</tr>
						<tr id="abahsoft_kadd_pilihan">
							<td>Pilihan</td>
							<td>:</td>
							<td id="abahsoft_option_elem">
								<div class="abahsoft_form_option abahsoft_form_option_add_elem" id="abahsoft_form_option_add_elem_parent" ref="parent">
									<span class="abahsoft_form_option_number"></span>
									<input type="text" value="" disabled="disabled">
								</div>
							</td>
						</tr>
						<tr id="abahsoft_kadd_tr_urutan">
							<td>Urutan</td>
							<td>:</td>
							<td>
								<select id="kadd_insert_in">
									<option value="0">-- pilih urutan --</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>
								<div class="btn btn-info" id="abahsoft_kuisoner_kuisoner_editbtn">Ubah</div>
								<div class="btn btn-info" id="abahsoft_kuisoner_kuisoner_savebtn">Tambahkan</div>
								<div class="btn btn-warning" id="abahsoft_kuisoner_kuisoner_reset">Bersihkan</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="abahsoft_right_content">
		<input type="hidden" id="abahsoft_active_right">
		<div class="abahsoft_right_content_data" id="abahsoft_right_content_pemetaan">
			<div id="abahsoft_form_quick_search">
				<select style="width:280px" id="abahsoft_quick_search_rw">
					<option id="abahsoft_quick_search_gol_nol" value="nol">-- Golongan Aset <?php //echo $kelurahan_data['kelurahan_nama']; ?> --</option>
					<?php foreach($golongan as $gol) { ?>
					<option id="abahsoft_quick_search_gol_<?php echo $gol['golongan']; ?>" value="<?php echo $gol['golongan']; ?>"> <?php echo $gol['name']; ?> <?php //echo $kelurahan_data['kelurahan_nama']; ?></option>
					<?php } ?>
				</select>
				<div id="abahsoft_search_bid">
					<select style="width:280px" id="abahsoft_quick_search_bid">
						<option id="abahsoft_quick_search_bid_nol" value="nol">-- Bidang Aset <?php //echo $kelurahan_data['kelurahan_nama']; ?> --</option>
					</select>
				</div>
				<div id="abahsoft_search_kel">
					<select style="width:280px" id="abahsoft_quick_search_kel">
						<option id="abahsoft_quick_search_kel_nol" value="nol">-- Kelompok Aset <?php //echo $kelurahan_data['kelurahan_nama']; ?> --</option>
					</select>
				</div>
				<div id="abahsoft_search_sub">
					<select style="width:280px" id="abahsoft_quick_search_sub">
						<option id="abahsoft_quick_search_su_nol" value="nol">-- Sub-Kelompok Aset <?php //echo $kelurahan_data['kelurahan_nama']; ?> --</option>
					</select>
				</div>
				<div id="abahsoft_search_brg">
					<select style="width:280px" id="abahsoft_quick_search_brg">
						<option id="abahsoft_quick_search_brg_nol" value="nol">-- Barang Aset <?php //echo $kelurahan_data['kelurahan_nama']; ?> --</option>
					</select>
				</div>
				<input type="text" style="width:280px;" id="abahsoft_quick_search" placeholder="No. Reg Aset" value="">
				<div class="btn btn-danger" id="abahsoft_close_quick_search" style="display:none;height:16px;margin-top:-10px;"><b>X</b></div>
			</div>
			<div id="abahsoft_quick_search_result" style="height:250px;overflow:auto"></div>
		</div>
		
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
		<div class="abahsoft_right_content_data" id="abahsoft_right_content_rekapitulasi">
			<h3><b>Pilih Area Rekap</b></h3>
			<select style="width:280px" id="abahsoft_filter_rw">
				<option id="rw_nol" value="nol">-- Kelurahan <?php echo $kelurahan_data['kelurahan_nama']; ?> --</option>
				<?php foreach($rw_data as $rw) { ?>
				<option id="rw_<?php echo $rw['rw']; ?>" value="<?php echo $rw['rw']; ?>">RW <?php echo $rw['rw']; ?> <?php echo $kelurahan_data['kelurahan_nama']; ?></option>
				<?php } ?>
			</select>
			<div class="abahsoft_right_custom_recap_box">
				<div id="abahsoft_right_custom_recap">
					<input type="hidden" id="abahsoft_custom_item_isrecap" value="0">
					<input type="hidden" id="abahsoft_custom_item_active" value="0">
					<input type="hidden" id="abahsoft_custom_item" value="-">
					<div id="abahsoft_right_custom_recap_list" style="padding-bottom:5px;"></div>
					<select style="width:280px;" id="abahsoft_filter_quiz">
						<option value="">-- Pilihan Rekap --</option>
						<?php foreach($questioners as $k => $v) { ?>
							<?php foreach ($v['questions'] as $kq => $vq) { ?>
							<optgroup label="<?php echo $vq['name']; ?>">
								<?php foreach ($vq['options'] as $ki => $vi) { ?>
								<option class="abahsoft_filter_quiz_item abahsoft_filter_quiz_item_group_<?php echo $vq['id']; ?>" ref="<?php echo $vq['id']; ?>" id="abahsoft_filter_quiz_<?php echo $ki; ?>" value="<?php echo $ki; ?>"><?php echo $vi; ?></option>
								<?php } ?>
							</optgroup>
							<?php } ?>
						<?php } ?>
					</select>
				</div>
				<div class="btn btn-success" id="abahsoft_btn_custom_recap">Setelan Rekap</div>
				<div class="btn btn-info" id="abahsoft_btn_summary_recap">Summary Rekap</div>
				<div class="btn btn-danger" id="abahsoft_btn_custom_recap_clear" style="display:none;"><b>X</b></div>
			</div>
			
			
			<div class="abahsoft_right_list_menu" style="margin-top:-10px;">
				<?php $firstshow = 0; foreach($questioners as $kg => $vg) { ?>
					<br/><br/><b><i class="icon-notebook"></i> <?php echo $vg['name']; ?></b>
					<ul>
					<?php foreach ($vg['questions'] as $kq => $vq) {
						if($firstshow==0) { ?>
							<input type="hidden" id="abahsoft_right_list_menu_inload" value="<?php echo $kq; ?>">
							<?php $firstshow = 1; 
						} ?>
						<li class="abahsoft_rekap_list_menu" id="abahsoft_rekap_<?php echo $kq; ?>"><?php echo $vq['name']; ?></li>
					<?php } ?>
					</ul>
				<?php } ?>
			</div>
		</div>
		<div class="abahsoft_right_content_data" id="abahsoft_right_content_petatematik">
			<h3><b>Pilih Kelompok Aset</b></h3>
			
			<div class="abahsoft_right_petatematik_menu" style="margin-top:0px;">
				<?php $firstshow = 0; foreach($golongan as $kg => $vg) { ?>
					<br/><br/><b><i class="icon-notebook"></i> <?php echo $vg['name']; ?></b>
					<ul>
					<?php foreach ($vg['bidang'] as $kq => $vq) {
						if($firstshow==0) { ?>
							<input type="hidden" id="abahsoft_right_petatematik_menu_inload" value="<?php echo $kq; ?>">
							<?php $firstshow = 1; 
						} ?>
						<li class="abahsoft_petatematik_menu" id="abahsoft_tematik_<?php echo $kq; ?>"><?php echo $vq['name']; ?></li>
					<?php } ?>
					</ul>
				<?php } ?>
			</div>
		</div>