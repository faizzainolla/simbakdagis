<?php
class Map_model extends CI_Model{

	function __construct(){
		parent:: __construct();
	}

	/* Start of generate Identity */
	function get_empty_id($kelurahan_id) {
		//$this->db->select('data_id,data_nomor_identitas,data_map_latitude,data_map_longitude,data_responden_nik,data_responden_nama,data_responden_alamat,data_responden_rt,data_responden_rw,data_responden_kelurahan_id,data_responden_telepon,data_responden_jumlah_kk,data_responden_jumlah_jiwa');
		$this->db->select('data_id');
		$this->db->where('data_responden_kelurahan_id', $kelurahan_id);
		$this->db->where('data_nomor_identitas', '');
		$this->db->order_by('data_id', 'ASC');
		return $this->db->get('datas', 1000, 0);
	}
	function get_last_inch($kelurahan_id) {
		$this->db->select('data_nomor_identitas');
		$this->db->where('data_responden_kelurahan_id', $kelurahan_id);
		$this->db->where('data_nomor_identitas != ""');
		$this->db->order_by('data_id', 'DESC');
		return $this->db->get('datas', 1, 1);
	}
	function update_identity($id, $data) {
		$this->db->where('data_id', $id);
		$this->db->update('datas', $data);
	}
	/* End of generate Identity */

	function get_all_responden() {
		//$this->db->select('data_id, data_nomor_identitas, data_map_latitude, data_map_longitude, data_responden_nik, data_responden_nama, data_responden_alamat, data_responden_rt, data_responden_rw, data_responden_kelurahan_id, data_responden_telepon');
		$this->db->select('*');
		$this->db->where('data_map_latitude != ""');
		$this->db->where('data_map_longitude != ""');
		$this->db->where('data_status', 1);
		$this->db->where('data_responden_kelurahan_id', $this->session->userdata['user_data']['kelurahan_id']);
		$this->db->order_by('data_id', 'RANDOM');
		return $this->db->get('datas');
	}

	function get_data_id_by_pilihan($rt, $rw, $pid) {
		$this->db->select('data_id');
		$this->db->join('datas', 'data_kuisoner_data_id = data_id');
		$this->db->where('data_responden_rt', $rt);
		$this->db->where('data_responden_rw', $rw);
		$this->db->where('data_kuisoner_pilihan_id', $pid);
		return $this->db->get('data_kuisoner');
	}



	function get_responden($id, $table_name) {
		$this->db->query("call sp_datas('', 'data_id = ".$id." AND data_status = 1','', '".$table_name."');");
		clean_mysqli_connection($this->db->conn_id);
		$this->db->where('data_id', $id);
		return $this->db->get($table_name);
	}

	function get_all_kuisoner() {
		$this->db->join('kuisoner', 'kuisoner_group.kuisoner_group_id = kuisoner.kuisoner_group_id');
		$this->db->where('kuisoner_group_status', 1);
		$this->db->where('kuisoner_status', 1);
		$this->db->order_by('kuisoner_group_urutan, kuisoner_urutan', 'ASC');
		return $this->db->get('kuisoner_group');
	}

	function get_kuisoner_for_recap() {
		$this->db->select('kuisoner_group.kuisoner_group_id,kuisoner_group_nama,kuisoner_id,kuisoner_rekap_nama');
		$this->db->join('kuisoner', 'kuisoner_group.kuisoner_group_id = kuisoner.kuisoner_group_id');
		$this->db->where('kuisoner_group_status', 1);
		$this->db->where('kuisoner_status', 1);
		$this->db->where('kuisoner_rekap', 1);
		$this->db->order_by('kuisoner_group_urutan, kuisoner_urutan', 'ASC');
		return $this->db->get('kuisoner_group');
	}

	function get_kuisoner_item($kuisoner) {
		$this->db->select('kuisoner_pilihan_id,kuisoner_pilihan_teks');
		$this->db->where('kuisoner_pilihan_kuisoner_id', $kuisoner);
		$this->db->where('kuisoner_pilihan_parent_id', 0);
		$this->db->where('kuisoner_pilihan_status', 1);
		return $this->db->get('ppuc_kuisoner_pilihan');
	}

	function get_kuisoner_group() {
		$this->db->order_by('kuisoner_group_urutan','ASC');
		return $this->db->get('kuisoner_group');
	}

	function get_kelurahan_data($kelurahan_id) {
		$this->db->select('kecamatan_id, kelurahan_id, kecamatan_nama, kelurahan_nama');
		$this->db->join('ppuc_kecamatan', 'kelurahan_kecamatan_id = kecamatan_id');
		$this->db->where('kelurahan_id', $kelurahan_id);
		return $this->db->get('ppuc_kelurahan');
	}

	function get_rw($kelurahan_id) {
		$this->db->select('rw');
		$this->db->where('kel', $kelurahan_id);
		$this->db->group_by('rw');
		$this->db->order_by('rw', 'ASC');
		return $this->db->get('view_area');
	}
	function get_rt($kelurahan_id, $rw) {
		$this->db->select('rt');
		$this->db->where('rw', $rw);
		$this->db->where('kel', $kelurahan_id);
		$this->db->group_by('rt');
		$this->db->order_by('rt', 'ASC');
		return $this->db->get('view_area');
	}
	
	
	//abah fungsi untuk get golongan aset
	
	function get_mgolongan() {
		$this->db->select('*');
		$this->db->where('jenis','1');
		$this->db->where('golongan !=','07');
		$this->db->order_by('golongan','ASC');
		return $this->db->get('mgolongan');
			//$this->db->where('golongan',$golongan);
	}
	
	function get_mgolongan_for_recap() {
		$this->db->select('mgolongan.golongan,nm_golongan,bidang,nm_bidang');
		$this->db->join('mbidang', 'mgolongan.golongan = mbidang.golongan');	
		//$this->db->where('jenis','1');		
		$this->db->where('mgolongan.golongan','01');
		//$this->db->where('mgolongan.golongan !=','05');
		//$this->db->where('mgolongan.golongan !=','07');
		$this->db->order_by('golongan, bidang', 'ASC');		
		return $this->db->get('mgolongan');
	}
	
	function get_all_kiba($bidang) {
		$this->db->select('*'); 
		$this->db->join('mbarang', 'trkib_a.kd_brg = mbarang.kd_brg');	 
		$this->db->where('lat != ""');
		$this->db->where('lon != ""');
		$this->db->where('substr(trkib_a.kd_brg,1,5)',$bidang);
		return $this->db->get('trkib_a');
	}
	
	function get_all_kibb($bidang) {
	   /// $filter ='substring(trkib_b.kd_unit,1,5)';
		//$data1='substr(trkib_b.kd_brg,1,4) AS bidang';
	
		///$this->db->select('unit_skpd.*,trkib_b.kd_brg,trkib_b.no_reg'); 
		//$this->db->join('mbarang', 'trkib_b.kd_brg = mbarang.kd_brg');	
		//$this->db->join('unit_skpd','trkib_b.kd_unit=unit_skpd.kd_uskpd');
		//$this->db->join('unit_skpd','substr(trkib_b.kd_unit,1,5)'='unit_skpd.kd_uskpd');	
		//func
	///	$this->db->join('unit_skpd','substr(trkib_b.kd_unit,1,5)'='unit_skpd.kd_uskpd');	
		//$this->db->join('unit_skpd',$filter);	
		//$this->db->where('trkib_b.data_map_latitude != ""');
		//$this->db->where('trkib_b.data_map_longitude != ""');
	///	$this->db->where('substr(trkib_b.kd_brg,1,4)',$bidang);
	///	return $this->db->get('trkib_b');
		
   		$sql = "SELECT unit_skpd.*,trkib_b.kd_brg,trkib_b.no_reg FROM trkib_b ";
		$sql .= " JOIN unit_skpd ON SUBSTR(trkib_b.kd_unit,1,5)=unit_skpd.kd_uskpd ";
		$sql .= " WHERE SUBSTR(trkib_b.kd_brg,1,5) = $bidang ";   
        echo $sql;exit; 		
   		return $this->db->query($sql); 
	
		
	}
	
	function get_all_kibc($bidang) {
		//$this->db->select('data_id, data_nomor_identitas, data_map_latitude, data_map_longitude, data_responden_nik, data_responden_nama, data_responden_alamat, data_responden_rt, data_responden_rw, data_responden_kelurahan_id, data_responden_telepon');
		$this->db->select('*'); 
		$this->db->join('mbarang', 'trkib_c.kd_brg = mbarang.kd_brg');	 
		$this->db->where('lat != ""');
		$this->db->where('lon != ""');
		$this->db->where('substr(trkib_c.kd_brg,1,5)',$bidang);
		return $this->db->get('trkib_c');
	}
	
		function get_all_kibd($bidang) {
		//$this->db->select('data_id, data_nomor_identitas, data_map_latitude, data_map_longitude, data_responden_nik, data_responden_nama, data_responden_alamat, data_responden_rt, data_responden_rw, data_responden_kelurahan_id, data_responden_telepon');
		$this->db->select('*'); 
		$this->db->join('mbarang', 'trkib_d.kd_brg = mbarang.kd_brg');	 
		$this->db->where('lat != ""');
		$this->db->where('lon != ""');
		$this->db->where('substr(trkib_d.kd_brg,1,5)',$bidang);
		return $this->db->get('trkib_d');
	}
	
		function get_all_kibe($bidang) {
			$sql = "SELECT unit_skpd.*,trkib_e.kd_brg,trkib_e.no_reg FROM trkib_e ";
			$sql .= " JOIN unit_skpd ON SUBSTR(trkib_e.kd_unit,1,5)=unit_skpd.kd_uskpd ";
			$sql .= " WHERE SUBSTR(trkib_e.kd_brg,1,5) = $bidang ";
			//echo $sql;exit; 		
			return $this->db->query($sql); 
	}
	
	function get_all_kibf($bidang) {
		//$this->db->select('data_id, data_nomor_identitas, data_map_latitude, data_map_longitude, data_responden_nik, data_responden_nama, data_responden_alamat, data_responden_rt, data_responden_rw, data_responden_kelurahan_id, data_responden_telepon');
		$this->db->select('*'); 
		$this->db->join('mbarang', 'trkib_f.kd_brg = mbarang.kd_brg');	 
		$this->db->where('lat != ""');
		$this->db->where('lon != ""');
		$this->db->where('substr(trkib_f.kd_brg,1,5)',$bidang);
		return $this->db->get('trkib_f');
	}
	
	function get_all_uskpd() {
		//$this->db->select('data_id, data_nomor_identitas, data_map_latitude, data_map_longitude, data_responden_nik, data_responden_nama, data_responden_alamat, data_responden_rt, data_responden_rw, data_responden_kelurahan_id, data_responden_telepon');
		$this->db->select('*');
		$this->db->where('data_map_latitude != ""');
		$this->db->where('data_map_longitude != ""');
		//$this->db->where('data_responden_kelurahan_id', $this->session->userdata['user_data']['kelurahan_id']);
		//$this->db->order_by('data_id', 'RANDOM');
		return $this->db->get('unit_skpd_gis');
	}
	
	function get_nm_kelompok($id) {
		$this->db->select('kelompok,nm_kelompok');
		$this->db->where('bidang', $id);
		return $this->db->get('mkelompok');
	}
	
	function get_data_trkiba($id) {
		$this->db->select('* , (SELECT nm_skpd from ms_skpd where kd_skpd = trkib_a.kd_skpd) as nm_skpd');
		//$this->db->join('trkib_a', 'trkib_a.no_reg = trkiba_gis.data_no_reg');	 
        $this->db->join('mbarang', 'trkib_a.kd_brg = mbarang.kd_brg');	 
		$this->db->where('id_barang',$id);
		//$this->db->where('data_status', 1);
		return $this->db->get('trkib_a');
	}
	
	//untuk view data id barang dari script.js//
	function get_data_trkiba_barang($id) {
		$this->db->select('* , (SELECT nm_skpd from ms_skpd where kd_skpd = trkib_a.kd_skpd) as nm_skpd');
		//$this->db->join('trkib_a', 'trkib_a.no_reg = trkiba_gis.data_no_reg');	 
        $this->db->join('mbarang', 'trkib_a.kd_brg = mbarang.kd_brg');
		$this->db->where('trkib_a.id_barang',$id);
		//$this->db->where('data_status', 1);
		return $this->db->get('trkib_a');
	}
	
		function get_data_trkibb_barang($id) {
		$this->db->select('* , (SELECT nm_skpd from ms_skpd where kd_skpd = trkib_b.kd_skpd) as nm_skpd');
		//$this->db->join('trkib_a', 'trkib_a.no_reg = trkiba_gis.data_no_reg');	 
        $this->db->join('mbarang', 'trkib_b.kd_brg = mbarang.kd_brg');	 
		$this->db->where('id_barang',$id);
		//$this->db->where('data_status', 1);
		return $this->db->get('trkib_b');
	}
	
		function get_data_trkibc_barang($id) {
		$this->db->select('* , (SELECT nm_skpd from ms_skpd where kd_skpd = trkib_c.kd_skpd) as nm_skpd');
		//$this->db->join('trkib_a', 'trkib_a.no_reg = trkiba_gis.data_no_reg');	 
        $this->db->join('mbarang', 'trkib_c.kd_brg = mbarang.kd_brg');	 
		$this->db->where('id_barang',$id);
		//$this->db->where('data_status', 1);
		return $this->db->get('trkib_c');
	}
	
		function get_data_trkibd_barang($id) {
		$this->db->select('* , (SELECT nm_skpd from ms_skpd where kd_skpd = trkib_d.kd_skpd) as nm_skpd');
		//$this->db->join('trkib_a', 'trkib_a.no_reg = trkiba_gis.data_no_reg');	 
        $this->db->join('mbarang', 'trkib_d.kd_brg = mbarang.kd_brg');	 
		$this->db->where('id_barang',$id);
		//$this->db->where('data_status', 1);
		return $this->db->get('trkib_d');
	}
	
		function get_data_trkibe_barang($id) {
		$this->db->select('* , (SELECT nm_skpd from ms_skpd where kd_skpd = trkib_e.kd_skpd) as nm_skpd');
		//$this->db->join('trkib_a', 'trkib_a.no_reg = trkiba_gis.data_no_reg');	 
        $this->db->join('mbarang', 'trkib_e.kd_brg = mbarang.kd_brg');	 
		$this->db->where('id_barang',$id);
		//$this->db->where('data_status', 1);
		return $this->db->get('trkib_e');
		}
		
		function get_data_trkibf_barang($id) {
		$this->db->select('* , (SELECT nm_skpd from ms_skpd where kd_skpd = trkib_f.kd_skpd) as nm_skpd');
		//$this->db->join('trkib_a', 'trkib_a.no_reg = trkiba_gis.data_no_reg');	 
        $this->db->join('mbarang', 'trkib_f.kd_brg = mbarang.kd_brg');	 
		$this->db->where('id_barang',$id);
		//$this->db->where('data_status', 1);
		return $this->db->get('trkib_f');
	}
	//untuk view data id barang//
		
	function get_data_uskpd($id) {
		$this->db->select('*');
		$this->db->where('kd_uskpd',$id);
		return $this->db->get('unit_skpd_gis');
	}
		
	function get_data_asset_uskpd($cat,$uskpd) {
		$this->db->select('*');
		$table = 'trkib_b';
		$this->db->join('mbarang',$table.'.kd_brg=mbarang.kd_brg');
		$this->db->where('kd_unit',$uskpd);
		return $this->db->get($table);
	}
	
	function get_data_trkibb($id) {
		$this->db->select('* , (SELECT nm_skpd from ms_skpd where kd_skpd = trkib_b.kd_skpd) as nm_skpd'); 
        $this->db->join('mbarang', 'trkib_b.kd_brg = mbarang.kd_brg');	 
		$this->db->where('id_barang',$id);
		//$this->db->where('data_status', 1);
		return $this->db->get('trkib_b');
	}
	
	
	function get_data_trkibc($id) {
		$this->db->select('* , (SELECT nm_skpd from ms_skpd where kd_skpd = trkib_c.kd_skpd) as nm_skpd');
		//$this->db->join('trkib_a', 'trkib_a.no_reg = trkiba_gis.data_no_reg');	 
        $this->db->join('mbarang', 'trkib_c.kd_brg = mbarang.kd_brg');	 
		$this->db->where('id_barang',$id);
		//$this->db->where('data_status', 1);
		return $this->db->get('trkib_c');
	}
	
	function get_data_trkibd($id) {
		$this->db->select('* , (SELECT nm_skpd from ms_skpd where kd_skpd = trkib_d.kd_skpd) as nm_skpd');
		//$this->db->join('trkib_a', 'trkib_a.no_reg = trkiba_gis.data_no_reg');	 
        $this->db->join('mbarang', 'trkib_d.kd_brg = mbarang.kd_brg');	 
		$this->db->where('id_barang',$id);
		//$this->db->where('data_status', 1);
		return $this->db->get('trkib_d');
	}
	
	function get_data_trkibd_datalengkap($id_barang,$kdbrg) {
		//$noreg = $datalengkap['noreg'];
		//$kdbrg = $datalengkap['kdbrg'];
		$this->db->select('*, (SELECT nm_skpd from ms_skpd where kd_skpd = trkib_d.kd_skpd) as nm_skpd');
		//$this->db->join('trkib_a', 'trkib_a.no_reg = trkiba_gis.data_no_reg');	 
        $this->db->join('mbarang', 'trkib_d.kd_brg = mbarang.kd_brg');	 
		//$this->db->where('id_barang',$id_barang);
		$this->db->where('id_barang',$id_barang);
		$this->db->where('trkib_d.kd_brg',$kdbrg);
		//$this->db->where('data_status', 1);
		return $this->db->get('trkib_d');
	}
	
	function get_data_trkibe($id) {
		$this->db->select('* , (SELECT nm_skpd from ms_skpd where kd_skpd = trkib_e.kd_skpd) as nm_skpd');
		//$this->db->join('trkib_a', 'trkib_a.no_reg = trkiba_gis.data_no_reg');	 
        $this->db->join('mbarang', 'trkib_e.kd_brg = mbarang.kd_brg');	 
		$this->db->where('no_reg',$id);
		//$this->db->where('data_status', 1);
	return $this->db->get('trkib_e');
	}
	
	function get_data_trkibf($id) {
		$this->db->select('* , (SELECT nm_skpd from ms_skpd where kd_skpd = trkib_f.kd_skpd) as nm_skpd');
		//$this->db->join('trkib_a', 'trkib_a.no_reg = trkiba_gis.data_no_reg');	 
        $this->db->join('mbarang', 'trkib_f.kd_brg = mbarang.kd_brg');	 
		$this->db->where('no_reg',$id);
		//$this->db->where('data_status', 1);
	return $this->db->get('trkib_f');
	}
	
	
	//QUERYY LAMA//
	function get_quick_searchxx($keyword, $rws=false, $table, $kd_skpd,$id) {
	    //$join = $table.".noreg";
		/* if($table=='') {
		   $table="trkib_a";
		} */
		//detail_brg,alamat1,
		//$this->db->join('trkiba_gis', $table.".no_reg" ."= trkiba_gis.data_no_reg");			
		//$this->db->join('trkiba_gis', 'trkib_a.no_reg = trkiba_gis.data_no_reg');	 
		//if($kd_skpd != '') {$this->db->like('kd_skpd',$kd_skpd,'after');}	
		$this->db->select('*');
		if($kd_skpd != ''){
		$this->db->where('kd_skpd',$kd_skpd);
		}if($id != ''){
		$this->db->where('id_barang',$id);
		}
		if($keyword != ''){
			$this->db->like('detail_brg', $keyword);
			$this->db->or_like('alamat1', $keyword); 
			$this->db->or_like('keterangan', $keyword); 
		}
		return $this->db->get($table);
	}
	//faiz 05/05/2017
	//QUERY BARU//
	function get_quick_search($keyword, $rws=false, $table, $kd_skpd,$id,$kec,$kel) {

		$where="";
		$where2="";
		$where3="";
		$where4="";
		$where5="";
		
		if($kd_skpd != ''){
		$where ="and kd_skpd='$kd_skpd'";
		}if($id != ''){
		$where2 ="and id_barang='$id'";
		}if($keyword != ''){
		$where3 ="and (detail_brg like '%$keyword%' or alamat1 like '%$keyword%' or keterangan like '%$keyword%')";
		}if($kec != ''){
		$where4 ="and kd_camat='$kec'";
		}if($kel != ''){
		$where5 ="and kd_lurah='$kel'";
		}
		
		$sql = $this->db->query("select * from $table WHERE lat IS NOT NULL AND lon IS NOT NULL AND lat<>'0' $where $where2 $where3 $where4 $where5 ");
		return $sql;
	}
	//END BARU//
	
	
	function get_add_search($keyword, $rws=false, $table,$kd_skpd) {
	    //$join = $table.".noreg";
		$this->db->select('*');
		if($table=='') {
		   $table="trkib_a";
		}
	    if($keyword != '') {$this->db->like('id_barang', $keyword,'after');}
		if($kd_skpd != '') {$this->db->like('kd_skpd',$kd_skpd,'after');}	
		return $this->db->get($table);
	}
	
		function get_barang_search($keyword, $rws=false, $table) {
		$this->db->select('*');
		if($table=='') {
		   $table="trkib_a";
		}
		$this->db->like('id_barang', $keyword, 'after');
		return $this->db->get($table);
	}

	
	function get_mod_quick_search($keyword, $table, $tablegis, $gol, $bid, $kel, $sub) {
		//$this->db->select('*');
		if($table=='') {
		   $table="trkib_a";
		}
		if($tablegis=='') {
			$tablegis="trkiba_gis";
		}
		//$this->db->join('trkiba_gis', $table.".no_reg" ."= trkiba_gis.data_no_reg");
		$filreg = $gol;
		if($bid!='nol'){$filreg=$bid;}
		if($kel!='nol'){$filreg=$kel;}
		if($sub!='nol'){$filreg=$sub;}
		//$this->db->like('no_reg', $keyword);
		$query = "SELECT * FROM ".$table." JOIN ".$tablegis." ON ".$table.".no_reg = ".$tablegis.".data_no_reg WHERE ".$table.".no_reg LIKE '".$filreg."%".$keyword."%'";
		return $this->db->get($query);
	}
	
	function get_bid_by_gol($golongan){
		$this->db->select('*');
		$this->db->from('mbidang');
		$this->db->where('golongan',$golongan);
		$this->db->order_by('bidang','ASC');
		return $this->db->get();
	}
	
	function get_kel_by_bid($bidang){
		$this->db->select('*');
		$this->db->from('mkelompok');
		$this->db->where('bidang',$bidang);
		$this->db->order_by('kelompok','ASC');
		return $this->db->get();
	}
	
	function get_sub_by_kel($kelompok){
		$this->db->select('*');
		$this->db->from('mkelompok1');
		$this->db->where('kelompok',$kelompok);
		$this->db->order_by('kd_kelompok','ASC');
		return $this->db->get();
	}
	
	function get_brg_by_sub($kelompok){
		$this->db->select('*');
		$this->db->from('mbarang');
		$this->db->where('kd_kelompok',$kelompok);
		$this->db->order_by('kd_brg','ASC');
		return $this->db->get();
	}
	
	function add_resp($gol, $data){
		$this->db->flush_cache();
		if($gol=='01'){$table='trkib_a';}
		if($gol=='02'){$table='trkib_b';}
		if($gol=='03'){$table='trkib_c';}
		if($gol=='04'){$table='trkib_d';}
		if($gol=='05'){$table='trkib_e';}
		$result = $this->db->insert($table,$data);
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
	function update_trkib($id_barang,$gol,$data) {
	    //echo $gol;
		//$this->db->flush_cache();
	    if($gol=='01'){$table='trkib_a';}
		else if($gol=='02'){$table='trkib_b';}
		else if($gol=='03'){$table='trkib_c';}
		else if($gol=='04'){$table='trkib_d';}
		else if($gol=='05'){$table='trkib_e';}

		//echo $table;
		//$this->db->where('no_reg', $noreg);
		//$result = $this->db->update("'".$tabel."'",$data);
		$sql = "update ".$table."  set lat='".$data['lat']."',lon='".$data['lon']."' ";
		$sql .= "where id_barang='".$id_barang."'";
		return $this->db->query($sql); 
		/*
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
		*/
	}
	
	function update_trkibgis($id_barang,$kib) {
	    //echo $gol;
		echo $kib['lat'];
		echo $kib['lon'];		
		//$this->db->flush_cache();
	    if($kib['gol']=='01'){$table='trkib_d';}
		else if($kib['gol']=='02'){$table='trkib_b';}
		else if($kib['gol']=='03'){$table='trkib_c';}
		else if($kib['gol']=='04'){$table='trkib_d';}
		else if($kib['gol']=='05'){$table='trkib_e';}

		//echo $table;
		//$this->db->where('no_reg', $noreg);
		//$result = $this->db->update("'".$tabel."'",$data);
		$sql = "update ".$table."  set lat='".$kib['lat']."',lon='".$kib['lon']."' ";
		$sql .= "where id_barang='".$id_barang."'";
		return $this->db->query($sql); 
		/*
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
		*/
	}
	
	
	function add_resp_gis($gol, $data){
		$this->db->flush_cache();
		if($gol=='01'){$table='trkiba_gis';}
		if($gol=='02'){$table='trkibb_gis';}
		if($gol=='03'){$table='trkibc_gis';}
		if($gol=='04'){$table='trkibd_gis';}
		if($gol=='05'){$table='trkibe_gis';}
		$result = $this->db->insert($table,$data);
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
	function get_data_asetunitb($kdskpd,$kdbarang) {
	    $filter ='substr(trkib_b.kd_unit,1,5)';
		$this->db->select('*');
		//$this->db->join('trkib_a', 'trkib_a.no_reg = trkiba_gis.data_no_reg');	 
        $this->db->join('mbarang', 'trkib_b.kd_brg = mbarang.kd_brg');
		$this->db->join('unit_skpd', $filter = 'unit_skpd.kd_uskpd');
		$this->db->where('substr(trkib_b.kd_unit,1,5)',$kdskpd);
		$this->db->where('substr(trkib_b.kd_brg,1,4)',$kdbarang);
		$this->db->where('unit_skpd.kd_uskpd',$kdskpd);
		//$this->db->where('data_status', 1);
		return $this->db->get('trkib_b');
	}
	
	function get_data_asetunite($kdskpd,$kdbarang) {
	    $filter ='substr(trkib_e.kd_unit,1,5)';
		$this->db->select('*');
		//$this->db->join('trkib_a', 'trkib_a.no_reg = trkiba_gis.data_no_reg');	 
        $this->db->join('mbarang', 'trkib_e.kd_brg = mbarang.kd_brg');
		$this->db->join('unit_skpd', $filter = 'unit_skpd.kd_uskpd');
		$this->db->where('substr(trkib_e.kd_unit,1,5)',$kdskpd);
		$this->db->where('substr(trkib_e.kd_brg,1,4)',$kdbarang);
		$this->db->where('unit_skpd.kd_uskpd',$kdskpd);
		//$this->db->where('data_status', 1);
		return $this->db->get('trkib_e');
	}
	
		function insert_gisdata($data){
		$this->db->flush_cache();
		$table='gisjalan';	
		$result = $this->db->insert($table,$data);
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
			function insert_gisdrainase($data){
		$this->db->flush_cache();
		$table='gisdrainase';	
		$result = $this->db->insert($table,$data);
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
	function insert_gisdatakawasan($data){
		$this->db->flush_cache();
		$table='giskawasan';	
		$result = $this->db->insert($table,$data);
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
	//untuk delete
	
	function delete_gisdata($id)
	{
	  $this->db->flush_cache();
	  $table='gisjalan';
	  $sql = "delete from ".$table." ";
	  $sql .= "where idJalan='".$id."'";
	  return $this->db->query($sql);
	}
	
	function delete_gisdrainase($id)
	{
	  $this->db->flush_cache();
	  $table='gisdrainase';
	  $sql = "delete from ".$table." ";
	  $sql .= "where idDrainase='".$id."'";
	  return $this->db->query($sql);
	}
	
	function delete_gisdatakawasan($id)
	{
	  $this->db->flush_cache();
	  $table='giskawasan';
	  $sql = "delete from ".$table." ";
	  $sql .= "where idKawasan='".$id."'";
	  return $this->db->query($sql);
	}
	
//untuk update
		function update_gisdata($id, $data){
		$this->db->flush_cache();
		$table='gisjalan';	
		$sql = "update ".$table."  set DataPeta='".$data['DataPeta']."',NamaJalan='".$data['NamaJalan']."',SegmentJalan='".$data['SegmentJalan']."',id_barang='".$data['id_barang']."',kd_brg='".$data['kd_brg']."',Keterangan='".$data['Keterangan']."',idKawasan='".$data['idKawasan']."'  ";
		$sql .= "where idJalan='".$id."'";
		return $this->db->query($sql); 

		/*$result = $this->db->update($table,$data);
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}*/
	}

		function update_gisdrainase($id, $data){
		$this->db->flush_cache();
		$table='gisdrainase';	
		$sql = "update ".$table."  set DataPeta='".$data['DataPeta']."',NamaDrainase='".$data['NamaDrainase']."',idKawasan='".$data['idKawasan']."',id_barang='".$data['id_barang']."',kd_brg='".$data['kd_brg']."',Keterangan='".$data['Keterangan']."'  ";
		$sql .= "where idDrainase='".$id."'";
		return $this->db->query($sql); 

		/*$result = $this->db->update($table,$data);
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}*/
	}
	
	
		function update_gisdatakawasan($id, $data){
		$this->db->flush_cache();
		$table='giskawasan';	
		$sql = "update ".$table."  set DataPeta='".$data['DataPeta']."',NamaKawasan='".$data['NamaKawasan']."',KetKawasan='".$data['KetKawasan']."'  ";
		$sql .= "where idKawasan='".$id."'";
		return $this->db->query($sql); 

		/*$result = $this->db->update($table,$data);
		if($result) {
			return TRUE;
		}else {
			return FALSE;
		}*/
	}


	function get_all_kawasan($id){
		if ($id=="blok"){
		  $this->db->select('*');
		  $this->db->order_by('idKawasan','ASC');
		  return $this->db->get('giskawasan');
		}
		if ($id=="jalan"){
		  $this->db->select('*');
		  $this->db->order_by('idJalan','ASC');
		  return $this->db->get('gisjalan');
		}
		if ($id=="drainase"){
		  $this->db->select('*');
		  $this->db->order_by('idDrainase','ASC');
		  return $this->db->get('gisdrainase');
		}
		
		
		else{
			return false;
		}		
	}
	
		function get_filter_all_kawasan($idkawasan){
		 /*
		  $this->db->select('*');
		  $this->db->order_by('idKawasan','ASC');
		  return $this->db->get('giskawasan');
	     */
		 /*
		$name = isset($d['name'])?$d['name']:'';
		$id = isset($d['id'])?$d['id']:'';
		$class = isset($d['class'])?$d['class']:'';
		$value = isset($d['value'])?$d['value']:'';
		*/
		
		$name="filterkawasan";
		$id ="filterkawasan";
		$class ='';
		$value =$idkawasan;
		$this->db->flush_cache();
		$this->db->from('giskawasan');
		//if($id!= 'null') $this->db->where('idKawasan',$id);
		$this->db->order_by('idKawasan');
		$res = $this->db->get();
		
		$out = 'Kawasan: <br> <select name="'.$name.'" id="'.$id.'" class="' . $class . '">';
		$out.= '<option value=""> -- Pilihan -- </option>';
		foreach($res->result() as $r){
			if($r->idKawasan == trim($value)){
				$out .= '<option value="'.$r->idKawasan.'" selected="selected">' .$r->NamaKawasan.'</option>';
			}else{
				$out .= '<option value="'.$r->idKawasan.'">' .$r->NamaKawasan.'</option>';
			}
		}
		$out .= '</select>';
		
		return $out;		
 
	}
	function get_filter_all_skpd($kd_skpd){
		 /*
		  $this->db->select('*');
		  $this->db->order_by('idKawasan','ASC');
		  return $this->db->get('giskawasan');
	     */
		 /*
		$name = isset($d['name'])?$d['name']:'';
		$id = isset($d['id'])?$d['id']:'';
		$class = isset($d['class'])?$d['class']:'';
		$value = isset($d['value'])?$d['value']:'';
		*/
		
		$name="filterskpd";
		$id ="filterskpd";
		$class ='';
		$value =$kd_skpd;
		$this->db->flush_cache();
		$this->db->from('ms_skpd');
		//if($id!= 'null') $this->db->where('idKawasan',$id);
		$this->db->order_by('kd_skpd');
		$res = $this->db->get();
		
		$out = '<select name="'.$name.'" id="'.$id.'" class="' . $class . '">';
		$out.= '<option value=""> -- Pilih Satuan Kerja -- </option>';
	 
		foreach($res->result() as $r){
			if($r->kd_skpd == trim($value)){
				$out .= '<option value="'.$r->kd_skpd.'" selected="selected">' .$r->nm_skpd.'</option>';
			}else{
				$out .= '<option value="'.$r->kd_skpd.'">' .$r->nm_skpd.'</option>';
			}
		}
		$out .= '</select>';
		
		return $out;		
 
	}
 
function ambil_skpd(){
	
     $q=$this->db->query("SELECT * FROM ms_skpd order by kd_skpd");
    return $q->result_array();
}  

function ambil_kecamatan(){
     $q=$this->db->query("SELECT * FROM ms_skpd WHERE SUBSTR(kd_skpd,6,2)>'12' ORDER BY kd_skpd");
    return $q->result_array();
} 

function ambil_status_tanah(){
     $q=$this->db->query("SELECT 
(SELECT COUNT(status_sertifikat) FROM trkib_a WHERE status_sertifikat='1' ) AS st,
(SELECT COUNT(status_sertifikat) FROM trkib_a WHERE status_sertifikat='2' ) AS bst,
(SELECT COUNT(status_sertifikat) FROM trkib_a WHERE status_sertifikat='3' ) AS bs,
(SELECT COUNT(status_sertifikat) FROM trkib_a WHERE status_sertifikat='4' ) AS bbs");
    return $q->result_array();
} 
function ambil_kelurahan(){
     $q=$this->db->query("SELECT * FROM ms_skpd order by kd_skpd");
    return $q->result_array();
}

function get_filter_all_skpd_name($kd_skpd,$name,$ids){
		 /*
		  $this->db->select('*');
		  $this->db->order_by('idKawasan','ASC');
		  return $this->db->get('giskawasan');
	     */
		 /*
		$name = isset($d['name'])?$d['name']:'';
		$id = isset($d['id'])?$d['id']:'';
		$class = isset($d['class'])?$d['class']:'';
		$value = isset($d['value'])?$d['value']:'';
		*/
		
	//	$name="filterskpd";
		//$id ="filterskpd";
		$class ='';
		$value =$kd_skpd;
		$this->db->flush_cache();
		$this->db->from('ms_skpd');
		//if($id!= 'null') $this->db->where('idKawasan',$id);
		$this->db->order_by('kd_skpd');
		$res = $this->db->get();
		
		$out = '<select name="'.$name.'" id="'.$ids.'" class="' . $class . '">';
		$out.= '<option value=""> -- Pilih Satuan Kerja -- </option>';
	 
		foreach($res->result() as $r){
			if($r->kd_skpd == trim($value)){
				$out .= '<option value="'.$r->kd_skpd.'" selected="selected">' .$r->nm_skpd.'</option>';
			}else{
				$out .= '<option value="'.$r->kd_skpd.'">' .$r->nm_skpd.'</option>';
			}
		}
		$out .= '</select>';
		
		return $out;		
 
	}
	
 
	
	
	
	
}

?>
