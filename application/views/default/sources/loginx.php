<!--
<script src="<?php echo base_url(); ?>assets/default/js/default.js" type="text/javascript"></script>
-->
<script src="<?php echo base_url(); ?>assets/default/js/login.js" type="text/javascript"></script>

<style type="text/css">
	.abahsoft_layer {
		background-color: #f5f5f5;
	}
	.abahsoft_status_layer {
		top:185px;
		position: absolute;
		background-color: #f5f5f5;
		width: 100%;
 
	}
	.abahsoft_center_layer {
	    position: absolute;
		width: 430px;
		left:200px;
	}
	.abahsoft_td_border_left {
		border-left: 1px solid #444;
		padding-left: 10px;
	}
	.errorfield {
		border-color: #f22 !important;
		background-color: #faa !important;
	}

	.loginbox {
		width:400px;
		margin:100px auto;
		-webkit-border-radius: 10px;
		border-radius: 10px;
        border:#d2ff52 solid 1px;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
       
	}
	
</style>
 <div id="body1" style="background:="<?php echo base_url(); ?>assets/img/background.jpg">	
	<div class="abahsoft_header_front_login"></div>
	<!--
		<div class="loginseparator">...</div>
    -->
	<div class="abahsoft_status_layer">

		<div class="loginbox">
			<table width="430px">
				<tr>
					<td width="145px" rowspan="5">
						<img width="120px" src="<?php echo base_url(); ?>assets/default/img/Loginred.jpg">
					</td>
					<td class="abahsoft_td_border_left" width="85px"></td>
					<td width="200px"></td>
				</tr>
				<tr>
					<td class="abahsoft_td_border_left">Pengguna</td>
					<td><input type="text" id="username" placeholder="Pengguna"></td>
				</tr>
				<tr>
					<td class="abahsoft_td_border_left">Sandi</td>
					<td><input type="password" id="password" placeholder="Sandi"></td>
				</tr>
				<tr>
					<td class="abahsoft_td_border_left">&nbsp;</td>
					<td>
						<div id="do_login" class="btn btn-success"><b>Masuk</b></div>
				</tr>
				<tr>
					<td colspan="2"></td>
				</tr>
			</table>
		</div>
	</div>
	</div>
 