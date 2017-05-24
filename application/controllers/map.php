<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends CI_Controller{
	protected $limit = 5;

	public function __construct() {
		parent::__construct();
		$this->load->model('map_model');

		if(is_array($userdata = $this->session->userdata['user_data'])) {
			if($userdata['logged_in']==false) {
				redirect(base_url('auth/login')); die();
			}
		} else {
			redirect(base_url('auth/login')); die();
		}
	}

	public function index() {
		$data = array();
		$data['groups'] = $this->map_model->get_mgolongan()->result_array();
		$data['golongan'] = array();
		$data['skpd'] = $this->map_model->ambil_skpd();
		$data['kecamatan'] = $this->map_model->ambil_kecamatan();
		$data['st_tanah'] = $this->map_model->ambil_status_tanah();
		$results = $this->map_model->get_mgolongan_for_recap()->result_array();
		//echo $this->db->last_query();exit;
		foreach ($results as $vg) {
		    $data['golongan'][$vg['golongan']]['golongan'] = $vg['golongan'];
			$data['golongan'][$vg['golongan']]['name'] = $vg['nm_golongan'];
			$data['golongan'][$vg['golongan']]['bidang'][$vg['bidang']]['id'] = $vg['bidang'];
			$data['golongan'][$vg['golongan']]['bidang'][$vg['bidang']]['name'] = $vg['nm_bidang'];
		}
		//$data['kelurahan_data'] = $this->map_model->get_kelurahan_data($this->session->userdata['user_data']['kelurahan_id'])->row_array();
        /* 
		echo '<pre>';
		print_r($data['golongan']);
		exit;
		*/
		$this->template->display('map/index', $data);
	}

	//faiz 05/05/2017
	public function list_kelurahan(){
  	if(isset($_POST['kd_kec']))
		{
		$kd_kec=$_POST['kd_kec'];

			$op ="<option selected value=''>--Pilih Kelurahan--</option>";
			$query = $this->db->query("SELECT kd_lokasi,nm_lokasi
			FROM mlokasi WHERE kd_skpd='$kd_kec' ORDER BY kd_lokasi");
			foreach($query->result_array() as $d){
		        $op .="<option value=".$d['kd_lokasi']." > ".$d['nm_lokasi']."</option>";
		   
		    }
		    echo $op;

		}
		else{
			echo '<option>kosong</option>';
		}
	}
	
	public function petatematik($id) {
		$data = array('status'=>false);
		$id = str_replace("_",".",$id) ;
	
		//$data = array('legend'=>$legend);
		if(substr($id,0,2)=='01'){
		   $asets = $this->map_model->get_all_kiba(substr($id,0,5))->result_array();
		}
		else if(substr($id,0,2)=='02'){
		   $asets = $this->map_model->get_all_kibb(substr($id,0,5))->result_array();
		}
		else if(substr($id,0,2)=='03'){
		   $asets = $this->map_model->get_all_kibc(substr($id,0,5))->result_array();
		}
		else if(substr($id,0,2)=='04'){
		   $asets = $this->map_model->get_all_kibd(substr($id,0,5))->result_array();
		}
		else if(substr($id,0,2)=='05'){
		   $asets = $this->map_model->get_all_kibe(substr($id,0,5))->result_array();
		}
		else if(substr($id,0,2)=='06'){
		   $asets = $this->map_model->get_all_kibf(substr($id,0,5))->result_array();
		}
		
		//echo($this->db->last_query());
		//		exit;		

		if(count($asets)>0) {
			$data = array('status'=>true);
			if( (substr($id,0,2)=='01') or (substr($id,0,2)=='03') or (substr($id,0,2)=='04') or (substr($id,0,2)=='06') ){
			  $legend = $this->map_model->get_nm_kelompok($id)->result_array();
			}
			else {
			  $legend ="test";
			  
			}
		    $data['legend']=$legend;
			$data['asets'] = $asets;
		}

		echo json_encode($data);
	}
	
	public function unittematik($id) {
		$data = array('status'=>false);
	
		$unit = $this->map_model->get_all_uskpd()->result_array();

		if(count($unit)>0) {
			$data = array('status'=>true);
			//$legend = $this->map_model->get_nm_kelompok($id)->result_array();
		    //$data['legend']=$legend;
			$data['unit'] = $unit;
		}

		echo json_encode($data);
	}
	
	//start abah update 08012014: tambah fungsi view tematik fullscreen A2
	public function cetaktematik($id) {
		//echo $id;exit;
		$data = array();		
	    $data['lat']= '-5.1608664';
		$data['lon']= '119.49127';		
		$data['category']=$id;
	    $this->template->single('cetak/index', $data);
	}
	//end abah update 08012014: tambah fungsi view tematik fullscreen A2
	
	public function responden() {
		$data = array();
		$data['responden'] = array();
		if($input = $this->input->post()) {
			$data_id = isset($input['data_id'])?$input['data_id']:'';
			$kd_brg = isset($input['kdbrg'])?$input['kdbrg']:'';
			//echo(kd_brg);exit;
			if($data_id!='') {
				//$responden = $this->map_model->get_data_trkiba($data_id)->row_array();
				if(substr($kd_brg,0,2)=='01'){
				   $responden = $this->map_model->get_data_trkiba($data_id)->row_array();
				   $layout='map/trkib_a';
				}
				else if(substr($kd_brg,0,2)=='02'){
				   $responden = $this->map_model->get_data_trkibb($data_id)->row_array();
				   $layout='map/trkib_b';
				}
				else if(substr($kd_brg,0,2)=='03'){
				   $responden = $this->map_model->get_data_trkibc($data_id)->row_array();
				   $layout='map/trkib_c';
				}
				else if(substr($kd_brg,0,2)=='04'){
				   $responden = $this->map_model->get_data_trkibd($data_id)->row_array();
				   $layout='map/trkib_d';
				}
				else if(substr($kd_brg,0,2)=='05'){
				   $responden = $this->map_model->get_data_trkibe($data_id)->row_array();
				    $layout='map/trkib_e';
				}
				else if(substr($kd_brg,0,2)=='06'){
				   $responden = $this->map_model->get_data_trkibf($data_id)->row_array();
				    $layout='map/trkib_f';
				}
			
				if(count($responden)>0) {
					$data['responden'] = $responden;
					//$layout='map/trkib_a';					
				}
			}
		}
		$this->template->single($layout, $data);
	}
	
	//fungsi untuk idbarangview dari script.js
		public function idbarangview() {
		$data = array();
		$data['responden'] = array();
		if($input = $this->input->post()) {
			$data_id = isset($input['data_id'])?$input['data_id']:'';
			$kd_brg = isset($input['kdbrg'])?$input['kdbrg']:'';
			
			if($data_id!='') {
				//$responden = $this->map_model->get_data_trkiba($data_id)->row_array();
				if(substr($kd_brg,0,2)=='01'){
				   $responden = $this->map_model->get_data_trkiba_barang($data_id)->row_array();
				   $layout='map/trkib_a';
				}
				else if(substr($kd_brg,0,2)=='02'){
				   $responden = $this->map_model->get_data_trkibb_barang($data_id)->row_array();
				   $layout='map/trkib_b';
				}
				else if(substr($kd_brg,0,2)=='03'){
				   $responden = $this->map_model->get_data_trkibc_barang($data_id)->row_array();
				   $layout='map/trkib_c';
				}
				else if(substr($kd_brg,0,2)=='04'){
				   $responden = $this->map_model->get_data_trkibd_barang($data_id)->row_array();
				   $layout='map/trkib_d';
				}
				else if(substr($kd_brg,0,2)=='05'){
				   $responden = $this->map_model->get_data_trkibe_barang($data_id)->row_array();
				    $layout='map/trkib_e';
				}
				else if(substr($kd_brg,0,2)=='06'){
				   $responden = $this->map_model->get_data_trkibf_barang($data_id)->row_array();
				    $layout='map/trkib_f';
				}
			
				if(count($responden)>0) {
					$data['responden'] = $responden;
					//$layout='map/trkib_a';					
				}
			}
		}
		$this->template->single($layout, $data);
	}
	
		public function showjalan() {
		$data = array();
		$data['responden'] = array();
		if($input = $this->input->post()) {
			$id_barang = isset($input['id_barang'])?$input['id_barang']:'';
			//$noreg = isset($input['noreg'])?$input['noreg']:'';
			$kdbrg = isset($input['kdbrg'])?$input['kdbrg']:'';
			//$data_id = isset($input['data_id'])?$input['data_id']:'';
			
			//$data_id = $datalengkap;
			
			//$kd_brg = isset($input['kdbrg'])?$input['kdbrg']:'';
			//echo(kd_brg);exit;
			/*if($data_id!='') {
				//$responden = $this->map_model->get_data_trkiba($data_id)->row_array();
				if(substr($kd_brg,0,2)=='01'){
				   $responden = $this->map_model->get_data_trkiba($data_id)->row_array();
				   $layout='map/trkib_a';
				}
				else if(substr($kd_brg,0,2)=='02'){
				   $responden = $this->map_model->get_data_trkibb($data_id)->row_array();
				   $layout='map/trkib_b';
				}
				else if(substr($kd_brg,0,2)=='03'){
				   $responden = $this->map_model->get_data_trkibc($data_id)->row_array();
				   $layout='map/trkib_c';
				}
				else if(substr($kd_brg,0,2)=='04'){
				   $responden = $this->map_model->get_data_trkibd($data_id)->row_array();
				   $layout='map/trkib_d';
				}
				else if(substr($kd_brg,0,2)=='05'){
				   $responden = $this->map_model->get_data_trkibe($data_id)->row_array();
				    $layout='map/trkib_e';
				}
				else if(substr($kd_brg,0,2)=='06'){
				   $responden = $this->map_model->get_data_trkibf($data_id)->row_array();
				    $layout='map/trkib_f';
				}*/
				   
				   $responden = $this->map_model->get_data_trkibd_datalengkap($id_barang,$kdbrg)->row_array();
				   //$responden = $this->map_model->get_data_trkibd_datalengkap($noreg,$kdbrg)->row_array();
				   //echo $this->db->last_query();exit;
				   $layout='map/trkib_d';
				
				if(count($responden)>0) {
					$data['responden'] = $responden;
					//$layout='map/trkib_a';					
				
			}
		}
		$this->template->single($layout, $data);
	}
	
	public function unit() {
		$data = array();
		$data['unit'] = array();
		if($input = $this->input->post()) {
			$data_id = isset($input['id'])?$input['id']:'';
			$cat = isset($input['category'])?$input['category']:'';
			if($data_id!='') {
				$unit = $this->map_model->get_data_uskpd($data_id)->row_array();
				$asset = $this->map_model->get_data_asset_uskpd($cat,$data_id)->result_array();
				if(count($unit)>0) {
					$data['unit'] = $unit;				 
					$data['asset'] = $asset;				 
				}
			}
		}
		$this->template->single('map/unitskpd', $data);
	}
	
	public function quick_search($rws) {
		$table_name="";
		$data = array('status'=>false);
		//var_dump($this->input->post());exit;
		if($input = $this->input->post()) {
			$qs = isset($input['qs'])?$input['qs']:'';
			$kd_skpd = isset($input['kd_skpd'])?$input['kd_skpd']:'';
			$gol = isset($input['gol'])?$input['gol']:'';
			$id = isset($input['id'])?$input['id']:'';
			$kec = isset($input['kec'])?$input['kec']:'';
			$kel = isset($input['kel'])?$input['kel']:'';
			//if ( ($kd_skpd=='00') AND ($kd_skpd=='99')) {$kd_skpd='';}
			//$rws = ($rws>0)?$rws:false;
			if($rws=='01'){$table_name = 'trkib_a';}
			else if($rws=='02'){$table_name = 'trkib_b';} 
			else if($rws=='03'){$table_name = 'trkib_c';} 	
			else if($rws=='04'){$table_name = 'trkib_d';} 	
			else if($rws=='05'){$table_name = 'trkib_e';} 	
			else if($rws=='06'){$table_name = 'trkib_f';} 				
			//$rws=true;
			//if($qs) {
				$resp = $this->map_model->get_quick_search($qs, $rws, $table_name, $kd_skpd,$id,$kec,$kel)->result_array();
				//echo $this->db->last_query();exit; 
				if(count($resp)>0) {
					$data = array('status'=>true);
					$data['responden'] = $resp;
					
					//cek legend
					if( (substr($rws,0,2)=='01') or (substr($rws,0,2)=='03') or (substr($rws,0,2)=='04') or (substr($rws,0,2)=='06') ){
						$legend = $this->map_model->get_nm_kelompok($rws)->result_array();
					    //echo $this->db->last_query();exit; 
					}
					else {
						$legend ="test";
			  
					}
					$data['legend']=$legend;
				}
				
			//}
			
		}
		echo json_encode($data);
	}
	
	public function add_search($rws) {
		$table_name="";
		$data = array('status'=>false);
		if($input = $this->input->post()) {
			$qs = isset($input['qs'])?$input['qs']:'';
			$kd_skpd = isset($input['kd_skpd'])?$input['kd_skpd']:'';
			//$rws = ($rws>0)?$rws:false;
			if($rws=='01'){$table_name = 'trkib_a';}
			else if($rws=='02'){$table_name = 'trkib_b';} 
			else if($rws=='03'){$table_name = 'trkib_c';} 	
			else if($rws=='04'){$table_name = 'trkib_d';} 	
			else if($rws=='05'){$table_name = 'trkib_e';} 	
			else if($rws=='06'){$table_name = 'trkib_f';} 				
			//$rws=true;
			//if($qs) {
				$resp = $this->map_model->get_add_search($qs, $rws, $table_name,$kd_skpd)->result_array();
				if(count($resp)>0) {
					$data = array('status'=>true);
					$data['responden'] = $resp;
				}
			//}
		}
		echo json_encode($data);
	}

	public function barang_search($rws) {
		$table_name="";
		$data = array('status'=>false);
		if($input = $this->input->post()) {
			$qs = isset($input['qs'])?$input['qs']:'';
			//$rws = ($rws>0)?$rws:false;
			if($rws=='01'){$table_name = 'trkib_a';}
			else if($rws=='02'){$table_name = 'trkib_b';} 
			else if($rws=='03'){$table_name = 'trkib_c';} 	
			else if($rws=='04'){$table_name = 'trkib_d';} 	
			else if($rws=='05'){$table_name = 'trkib_e';} 	
			else if($rws=='06'){$table_name = 'trkib_f';} 				
			//$rws=true;
			if($qs) {
				$resp = $this->map_model->get_barang_search($qs, $rws, $table_name)->result_array();
				//echo $this->db->last_query(); exit;
				if(count($resp)>0) {
					$data = array('status'=>true);
					$data['responden'] = $resp;
				}
			}
		}
		echo json_encode($data);
	}
	
	
	
	public function mod_quick_search($gol,$bid,$kel,$sub) {
		$table_name="";
		$data = array('status'=>false);
		if($input = $this->input->post()) {
			$qs = isset($input['qs'])?$input['qs']:'';
			//$rws = ($rws>0)?$rws:false;
			if($gol=='01'){$table_name = 'trkib_a';$tablegis = 'trkiba_gis';}
			else if($gol=='02'){$table_name = 'trkib_b';$tablegis = 'trkibb_gis';} 
			else if($gol=='03'){$table_name = 'trkib_c';$tablegis = 'trkibc_gis';} 	
			else if($gol=='04'){$table_name = 'trkib_d';$tablegis = 'trkibd_gis';} 	
			else if($gol=='05'){$table_name = 'trkib_e';$tablegis = 'trkibe_gis';} 	
			else if($gol=='06'){$table_name = 'trkib_f';$tablegis = 'trkibf_gis';} 				
			//$gol=true;
			if($qs) {
				$resp = $this->map_model->get_mod_quick_search($qs, $table_name, $tablegis, $gol, $bid, $kel, $sub)->result_array();
				if(count($resp)>0) {
					$data = array('status'=>true);
					$data['responden'] = $resp;
				}
			}
		}
		echo json_encode($data);
	}
	
	public function simpan_data() {
		if($input = $this->input->post()) {
			echo $input['koordinat'];
		}
	}
	
	public function get_bidang_list($golongan){
		$bidangs = $this->map_model->get_bid_by_gol($golongan);
		$data['list'] = '<select style="width:260px" id="abahsoft_quick_search_bid">';
		$data['list'] .= '<option id="abahsoft_quick_search_bid_nol" value="nol">-- Bidang Aset --</option>';
		foreach($bidangs->result_array() as $bid){
			$data['list'].='<option id="abahsoft_quick_search_bid_'.$bid['bidang'].'" value="'.$bid['bidang'].'">'.$bid['nm_bidang'].'</option>';
		}
		$data['list'] .= '</select>';
		
		echo json_encode($data);
	}
	
	public function get_kelompok_list($bidang){
		$kelompok = $this->map_model->get_kel_by_bid($bidang);
		$data['list'] = '<select style="width:260px" id="abahsoft_quick_search_kel">';
		$data['list'] .= '<option id="abahsoft_quick_search_kel_nol" value="nol">-- Kelompok Aset --</option>';
		foreach($kelompok->result_array() as $kel){
			$data['list'].='<option id="abahsoft_quick_search_kel_'.$kel['kelompok'].'" value="'.$kel['kelompok'].'">'.$kel['nm_kelompok'].'</option>';
		}
		$data['list'] .= '</select>';
		
		echo json_encode($data);
	}
	
	public function get_subkel_list($kelompok){
		$subkel = $this->map_model->get_sub_by_kel($kelompok);
		$data['list'] = '<select style="width:260px" id="abahsoft_quick_search_sub">';
		$data['list'] .= '<option id="abahsoft_quick_search_sub_nol" value="nol">-- Sub-Kelompok Aset --</option>';
		foreach($subkel->result_array() as $kel){
			$data['list'].='<option id="abahsoft_quick_search_sub_'.$kel['kd_kelompok'].'" value="'.$kel['kd_kelompok'].'">'.$kel['nm_kelompok'].'</option>';
		}
		$data['list'] .= '</select>';
		
		echo json_encode($data);
	}
	
	public function get_barang_list($subkel){
		$barang = $this->map_model->get_brg_by_sub($subkel);
		$data['list'] = '<select style="width:260px" id="abahsoft_quick_search_brg">';
		$data['list'] .= '<option id="abahsoft_quick_search_brg_nol" value="nol">-- Barang Aset --</option>';
		foreach($barang->result_array() as $brg){
			$data['list'].='<option id="abahsoft_quick_search_brg_'.$brg['kd_brg'].'" value="'.$brg['kd_brg'].'">'.$brg['nm_brg'].'</option>';
		}
		$data['list'] .= '</select>';
		
		echo json_encode($data);
	}
		
	public function add_responden() {
		$data = array();
		if($input = $this->input->post()) {
			$data['lat'] = $this->input->post('lat');
			$data['long'] = $this->input->post('lng');
			$data['noreg'] = $this->input->post('register');
		    $data['kdbrg'] = $this->input->post('kdbrg');

		}
		$this->template->single('map/addresponden', $data);
	}
	
	public function update_barang() {
		$data = array();
		if($input = $this->input->post()) {
			$data['lat'] = $this->input->post('lat');
			$data['long'] = $this->input->post('lng');
			$data['noreg'] = $this->input->post('register');
			$data['idbarang'] = $this->input->post('idbarang');
		    $data['kdbrg'] = $this->input->post('kdbrg');
			$data['detailbrg'] = $this->input->post('detailbrg');
			$data['alamat'] = $this->input->post('alamat');
		}
		$this->template->single('map/updatebarang', $data);
	}
	
	public function save_responden(){
		$data = array();
		$data2 = array();
		if($input = $this->input->post()) {
			$golongan = $this->input->post('gol');
			//echo $gol;
			//Data KIB
			//$data['no_reg'] = $this->input->post('noreg');
			//$data['kd_brg'] = $this->input->post('kdbrg');
			$no_reg = $this->input->post('noreg');
			/*
			$data['alamat1'] = $this->input->post('alamat1');
			$data['alamat2'] = $this->input->post('alamat2');
			$data['alamat3'] = 'PAPUA BARAT';
			$data['no_dokumen'] = $this->input->post('nodok');
			if($gol=='01'){
				$data['no_sertifikat'] = $this->input->post('noser');
				$data['tgl_sertifikat'] = $this->input->post('tglser');
			}
			*/
			$data['data_map_latitude'] = $this->input->post('lat');
			$data['data_map_longitude'] = $this->input->post('lon');
			$this->map_model->update_trkib($no_reg,$golongan,$data);
			//print_r($data);
			//$this->map_model->add_resp($gol,$data);
			//Data GIS
			//$data2['data_no_reg'] = $this->input->post('noreg');
			//$data2['data_map_latitude'] = $this->input->post('lat');
			//$data2['data_map_longitude'] = $this->input->post('lon');
			//$data2['data_tanggal_entry'] = $this->input->post('tglser');
			//$data2['data_status'] = '1';
			//print_r($data2);
			//$this->map_model->add_resp_gis($gol,$data2);
		}
	}
	
	public function save_barang(){
		$data = array();
		$data2 = array();
		if($input = $this->input->post()) {
			$golongan = $this->input->post('gol');
			//echo $gol;
			//Data KIB
			//$data['no_reg'] = $this->input->post('noreg');
			//$data['kd_brg'] = $this->input->post('kdbrg');
			//$no_reg = $this->input->post('noreg');
			$id_barang = $this->input->post('idbarang');
		 
			/*
			$data['alamat1'] = $this->input->post('alamat1');
			$data['alamat2'] = $this->input->post('alamat2');
			$data['alamat3'] = 'PAPUA BARAT';
			$data['no_dokumen'] = $this->input->post('nodok');
			if($gol=='01'){
				$data['no_sertifikat'] = $this->input->post('noser');
				$data['tgl_sertifikat'] = $this->input->post('tglser');
			}
			*/
			$data['lat'] = $this->input->post('lat');
			$data['lon'] = $this->input->post('lon');
			$this->map_model->update_trkib($id_barang,$golongan,$data);
			//echo $this->db->last_query();exit;
 
		}
	}
		public function get_asetunit() {
		$data = array();
		$data['aset'] = array();
		if($input = $this->input->post()) {
			$kdskpd = isset($input['kdskpd'])?$input['kdskpd']:'';
			$kdbidang = isset($input['kdbidang'])?$input['kdbidang']:'';
			//echo(kdbidang);exit;

				if(substr($kdbidang,0,2)=='02'){
				//if($kdbidang=='02'){
				     $asets = $this->map_model->get_data_asetunitb($kdskpd,$kdbidang)->result_array();
				     $layout='map/asetunit_b';
				}
				else if(substr($kdbidang,0,2)=='05'){
				//else if($kdbidang=='05'){
				   $asets = $this->map_model->get_data_asetunite($kdskpd,$kdbidang)->result_array();
				   $layout='map/asetunit_e';
				}
				
				//echo($this->db->last_query());
				//exit;				
				//var_dump($asets);exit;
				 
				if(count($asets)>0) {
					$data['aset'] = $asets;				 
				}
			}
				$this->template->single($layout, $data);
	}
	public function save_gisdata(){
		//idBlok:idBlok,NamaJalan:NamaJalan,SegmentJalan:SegmentJalan,KmLokasi:KmLokasi,DataPeta
		$data = array();

		if($input = $this->input->post()) {
			$kib['gol'] = $this->input->post('gol');
			$kib['lat'] = $this->input->post('lat');
			$kib['lon'] = $this->input->post('lng'); 
			$data['idKawasan'] = $this->input->post('idKawasan');
			$data['id_barang'] = $this->input->post('id_barang');
			$data['kd_brg'] = $this->input->post('kdbrg');
			$data['NamaJalan'] = $this->input->post('NamaJalan');
			$data['SegmentJalan'] = $this->input->post('SegmentJalan');
			$data['Keterangan'] = $this->input->post('Keterangan');
			$data['DataPeta'] = $this->input->post('DataPeta');
			$this->map_model->insert_gisdata($data);
			$this->map_model->update_trkibgis($data['id_barang'],$kib);

		}
	}
	
	public function save_gisdrainase(){
		//idBlok:idBlok,NamaJalan:NamaJalan,SegmentJalan:SegmentJalan,KmLokasi:KmLokasi,DataPeta
		$data = array();

		if($input = $this->input->post()) {
			$kib['gol'] = $this->input->post('gol');
			$kib['lat'] = $this->input->post('lat');
			$kib['lon'] = $this->input->post('lng'); 
			$data['NamaDrainase'] = $this->input->post('NamaJalan');
			$data['idKawasan'] = $this->input->post('idKawasan');
			//$data['SegmentDrainase'] = $this->input->post('SegmentJalan');
			$data['id_barang'] = $this->input->post('id_barang');
			$data['kd_brg'] = $this->input->post('kdbrg');
			$data['Keterangan'] = $this->input->post('Keterangan');
			$data['DataPeta'] = $this->input->post('DataPeta');
			$this->map_model->insert_gisdrainase($data);
			$this->map_model->update_trkibgis($data['id_barang'],$kib);

		}
	}
	
	
	public function save_gisdatakawasan(){
		//NamaKawasan,KetKawasan,DataPeta
		$data = array();

		if($input = $this->input->post()) {
		 
			$data['NamaKawasan']  = $this->input->post('NamaKawasan');
			$data['KetKawasan'] = $this->input->post('KetKawasan');
			$data['DataPeta'] = $this->input->post('DataPeta');
			$this->map_model->insert_gisdatakawasan($data);

		}
	}
	
		//Untuk Delete
		public function delete_gisdata(){
		$data = array();

		if($input = $this->input->post()) {
			$id = $this->input->post('id');
			$this->map_model->delete_gisdata($id);

			}
		}
	
		public function delete_gisdrainase(){
		$data = array();

		if($input = $this->input->post()) {
			$id = $this->input->post('id');
			$this->map_model->delete_gisdrainase($id);

			}
		}
	
		public function delete_gisdatakawasan(){
		$data = array();

		if($input = $this->input->post()) {
			$id = $this->input->post('id');
			$this->map_model->delete_gisdatakawasan($id);

		}
	}
	
	//Untuk Update
		public function update_gisdata(){
		//idBlok:idBlok,NamaJalan:NamaJalan,SegmentJalan:SegmentJalan,KmLokasi:KmLokasi,DataPeta
		$data = array();

		if($input = $this->input->post()) {
			$id = $this->input->post('id');
			$kib['gol'] = $this->input->post('gol');
			$kib['lat'] = $this->input->post('lat');
			$kib['lon'] = $this->input->post('lng'); 
			$data['NamaJalan'] = $this->input->post('NamaJalan');
			$data['SegmentJalan'] = $this->input->post('SegmentJalan');
			$data['id_barang'] = $this->input->post('id_barang');
			$data['kd_brg'] = $this->input->post('kdbrg');
			$data['Keterangan'] = $this->input->post('Keterangan');
			$data['idKawasan'] = $this->input->post('idKawasan');
			$data['DataPeta'] = $this->input->post('DataPeta');
			$this->map_model->update_gisdata($id, $data);
			$this->map_model->update_trkibgis($data['id_barang'],$kib);

		}
	}
	
	  public function update_gisdrainase(){
		//idBlok:idBlok,NamaJalan:NamaJalan,SegmentJalan:SegmentJalan,KmLokasi:KmLokasi,DataPeta
		$data = array();

		if($input = $this->input->post()) {
			$id = $this->input->post('id');
			$kib['gol'] = $this->input->post('gol');
			$kib['lat'] = $this->input->post('lat');
			$kib['lon'] = $this->input->post('lng'); 
			$data['NamaDrainase'] = $this->input->post('NamaJalan');
			//$data['SegmentJalan'] = $this->input->post('SegmentJalan');
			$data['id_barang'] = $this->input->post('id_barang');
			$data['kd_brg'] = $this->input->post('kdbrg');
			$data['idKawasan'] = $this->input->post('idKawasan');
			$data['Keterangan'] = $this->input->post('Keterangan');
			$data['DataPeta'] = $this->input->post('DataPeta');
			$this->map_model->update_gisdrainase($id, $data);
			$this->map_model->update_trkibgis($data['id_barang'],$kib);

		}
	}
	
		public function update_gisdatakawasan(){
		//idBlok:idBlok,NamaJalan:NamaJalan,SegmentJalan:SegmentJalan,KmLokasi:KmLokasi,DataPeta
		$data = array();

		if($input = $this->input->post()) {
			$id = $this->input->post('id');
			$data['NamaKawasan'] = $this->input->post('NamaKawasan');
			//$data['SegmentJalan'] = $this->input->post('SegmentJalan');
			$data['KetKawasan'] = $this->input->post('KetKawasan');
			$data['DataPeta'] = $this->input->post('DataPeta');
			$this->map_model->update_gisdatakawasan($id, $data);

			}
		}
	

	
	
	
	public function petakawasan($id) {
		$data = array('status'=>false);
	    /*
		//$data = array('legend'=>$legend);
		if(substr($id,0,2)=='01'){
		   $asets = $this->map_model->get_all_kiba(substr($id,0,4))->result_array();
		}
		else if(substr($id,0,2)=='02'){
		   $asets = $this->map_model->get_all_kibb(substr($id,0,4))->result_array();
		}
		else if(substr($id,0,2)=='03'){
		   $asets = $this->map_model->get_all_kibc(substr($id,0,4))->result_array();
		}
		else if(substr($id,0,2)=='04'){
		   $asets = $this->map_model->get_all_kibd(substr($id,0,4))->result_array();
		}
		else if(substr($id,0,2)=='05'){
		   $asets = $this->map_model->get_all_kibe(substr($id,0,4))->result_array();
		}
		else if(substr($id,0,2)=='06'){
		   $asets = $this->map_model->get_all_kibf(substr($id,0,4))->result_array();
		}
		
		//echo($this->db->last_query());
		//		exit;		

		if(count($asets)>0) {
			$data = array('status'=>true);
			if( (substr($id,0,2)=='01') or (substr($id,0,2)=='03') or (substr($id,0,2)=='04') or (substr($id,0,2)=='06') ){
			  $legend = $this->map_model->get_nm_kelompok($id)->result_array();
			}
			else {
			  $legend ="test";
			  
			}
		    $data['legend']=$legend;
			$data['asets'] = $asets;
		}
		*/
	 
		$asets = $this->map_model->get_all_kawasan($id)->result_array();
		if(count($asets)>0) {
		   $data = array('status'=>true);
           $data['asets'] = $asets;
		}   
		//var_dump($asets );exit;
		//echo $this->db->last_query();exit;
		echo json_encode($data);
	}
	
	function getkawasan($id){
		echo $this->map_model->get_filter_all_kawasan($id); 
	}
	
	function getskpd($id=null){
		echo $this->map_model->get_filter_all_skpd($id); 
	}
	
	function getskpdname($id=null){
		  $ids = $this->input->post('ids');
		  $name = $this->input->post('name');
		echo $this->map_model->get_filter_all_skpd_name($id,$name,$ids); 
	}
}

?>