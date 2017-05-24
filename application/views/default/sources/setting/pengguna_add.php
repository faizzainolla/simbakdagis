<style type="text/css">
	.abahsoft_form_error_display {
		color: #f00;
		font-size: 11px;
	}
</style>
<table class="table table-striped" width="100%">
	<input type="hidden" id="uadd_id">
	<tr>
		<td width="250px">Nama Pegawai</td>
		<td width="5px">:</td>
		<td width="*"><input type="text" id="uadd_name" error="1">&nbsp;&nbsp;<span id="error_uadd_name" class="abahsoft_form_error_display"></span></td>
	</tr>
	<tr>
		<td>Pengguna</td>
		<td>:</td>
		<td><input type="text" id="uadd_username" error="1" lastdata="">&nbsp;&nbsp;<span id="error_uadd_username" class="abahsoft_form_error_display"></span></td>
	</tr>
	<tr>
		<td>Kata Sandi</td>
		<td>:</td>
		<td><input type="password" id="uadd_password_1" error="1">&nbsp;&nbsp;<span id="error_uadd_passwd1" class="abahsoft_form_error_display"></span></td>
	</tr>
	<tr>
		<td>Konfirmasi Sandi</td>
		<td>:</td>
		<td><input type="password" id="uadd_password_2" error="1">&nbsp;&nbsp;<span id="error_uadd_passwd2" class="abahsoft_form_error_display"></span></td>
	</tr>
	<tr>
		<td>Kelurahan</td>
		<td>:</td>
		<td>
			<select id="uadd_kelurahan" error="1">
				<option value="">-- pilih kelurahan pengguna --</option>
				<?php
				foreach($kelurahans as $kk => $kv) {
					echo '<option value="'.$kv['kelurahan_id'].'">'.$kv['kelurahan_nama'].'</option>';
				}
				?>
			</select>
			&nbsp;&nbsp;<span id="error_uadd_kelurahan" class="abahsoft_form_error_display"></span>
		</td>
	</tr>
	<tr>
		<td colspan="2"></td>
		<td>
			<div class="btn btn-info" id="abahsoft_setting_pengguna_savebtn">Tambahkan</div>
		</td>
	</tr>
</table>

<script type="text/javascript">
	$(function() {
		$('#uadd_kelurahan').change(function() {
			var thisval = $(this).val();
			if(thisval!='') {
				$('#error_uadd_kelurahan').html('');
				$(this).attr({error:0});
			} else {
				$('#error_uadd_kelurahan').html('kolom ini harus dipilih!');
				$(this).attr({error:1});
			}
		});
		$('#uadd_name').keyup(function() {
			var thisval = $(this).val();
			if(thisval!='') {
				$('#error_uadd_name').html('');
				$(this).attr({error:0});
			} else {
				$('#error_uadd_name').html('kolom ini harus diisi!');
				$(this).attr({error:1});
			}
		});
		$('#uadd_password_1').keyup(function() {
			var thisval = $(this).val();
			if(thisval!='') {
				if(thisval.length > 16 || thisval.length < 6) {
					$('#error_uadd_passwd1').html('kata sandi terdiri antara 6 sampai 14 karakter!');
					$(this).attr({error:1});
				} else {
					$('#error_uadd_passwd1').html('');
					$(this).attr({error:0});
				}
			} else {
				$('#error_uadd_passwd1').html('kolom ini harus diisi!');
				$(this).attr({error:1});
			}
			$('#uadd_password_2').keyup();
		});
		$('#uadd_password_2').keyup(function() {
			var thisval = $(this).val();
			if(thisval!='') {
				if(thisval!=$('#uadd_password_1').val()) {
					$('#error_uadd_passwd2').html('tidak sesuai dengan sandi pertama.');
					$(this).attr({error:1});
				} else {
					$('#error_uadd_passwd2').html('');
					$(this).attr({error:0});
				}
			} else {
				$('#error_uadd_passwd2').html('kolom ini harus diisi!');
				$(this).attr({error:1});
			}
		});
		$('#uadd_username').keyup(function() {
			var thisval = $(this).val();
			if(thisval!='') {
				if(thisval!=$(this).attr('lastdata')) {
					$.ajax({
						type  : 'post',
						url   : base_url+'setting/check_pengguna',
						data  : 'uname='+thisval,
						cache : false,
						success: function(html) {
							if(html!=0) {
								$('#error_uadd_username').html('maaf, pengguna sudah digunakan.');
								$('#uadd_username').attr({error:1});
							} else {
								$('#error_uadd_username').html('');
								$('#uadd_username').attr({error:0});
							}
						}
					});
				}
			} else {
				$('#error_uadd_username').html('kolom ini harus diisi!');
				$('#uadd_username').attr({error:1});
			}
		});

		$('#abahsoft_setting_pengguna_savebtn').click(function() {

			var iserror = false;
			if($('#uadd_name').attr('error')==1) {
				$('#uadd_name').keyup();
				iserror = true;
			}
			if($('#uadd_username').attr('error')==1) {
				$('#uadd_username').keyup();
				iserror = true;
			}

			if($('#uadd_kelurahan').attr('error')==1) {
				$('#uadd_kelurahan').change();
				iserror = true;
			}

			if($('#uadd_id').val()=='') {

				if($('#uadd_password_1').attr('error')==1) {
					$('#uadd_password_1').keyup();
					iserror = true;
				}
				if($('#uadd_password_2').attr('error')==1) {
					$('#uadd_password_2').keyup();
					iserror = true;
				}

				var url = base_url+'setting/pengguna/add';
				var cdata = '';
			} else {

				if($('#uadd_password_1').val()!='' || $('#uadd_password_2').val()!='') {
					if($('#uadd_password_1').attr('error')==1) {
						$('#uadd_password_1').keyup();
						iserror = true;
					}
					if($('#uadd_password_2').attr('error')==1) {
						$('#uadd_password_2').keyup();
						iserror = true;
					}
				}

				var url = base_url+'setting/pengguna/edit';
				var cdata = 'pid='+$('#uadd_id').val()+'&';
			}

			if(!iserror) {
				var data = cdata+'pegawai='+$('#uadd_name').val()+'&uname='+$('#uadd_username').val()+'&passwd='+$('#uadd_password_1').val()+'&kel='+$('#uadd_kelurahan').val();
				$.ajax({
					type  : 'post',
					url   : url,
					data  : data,
					cache : false,
					success: function(html) {
						if(html==1) {
							refreshTable();
							closeUserAdd();
						}
					}
				});
			}
		});
	});
</script>