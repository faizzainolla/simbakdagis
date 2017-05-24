<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Responden extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$this->load->model('responden_model');
	}

	public function responden_add() {
		if($post = $this->input->post()) {
			$html = 0;
			$ansadd = isset($post['ansadd'])?$post['ansadd']:'';
			$nik = isset($post['nik'])?$post['nik']:'';
			$nama = isset($post['nama'])?$post['nama']:'';
			$alamat = isset($post['alamat'])?$post['alamat']:'';
			$rt = isset($post['rt'])?$post['rt']:'';
			$rw = isset($post['rw'])?$post['rw']:'';
			$telp = isset($post['telp'])?$post['telp']:'';
			$jumlah_kk = isset($post['jumlah_kk'])?$post['jumlah_kk']:'';
			$jumlah_jiwa = isset($post['jumlah_jiwa'])?$post['jumlah_jiwa']:'';
			$loc = explode('|', (isset($post['loc'])?$post['loc']:'|'));

			if($nama!='' && count($ansadd)>0) {
				$getlastidentity = $this->responden_model->get_last_identity($this->session->userdata['user_data']['kelurahan_id'])->row_array();

				$lastnum = $getlastidentity['data_nomor_identitas'];
				$expl = explode('.', $lastnum);
				$newnum = str_replace($expl[4], str_pad(($expl[4]+1), 8, "0", STR_PAD_LEFT), $lastnum);

				$resdata = array(
						'data_nomor_identitas'			=> $newnum,
						'data_map_latitude'				=> $loc[0],
						'data_map_longitude'			=> $loc[1],
						'data_responden_nik'			=> $nik,
						'data_responden_nama'			=> $nama,
						'data_responden_alamat'			=> $alamat,
						'data_responden_rt'				=> $rt,
						'data_responden_rw'				=> $rw,
						'data_responden_kelurahan_id'	=> $this->session->userdata['user_data']['kelurahan_id'],
						'data_responden_telepon'		=> $telp,
						'data_responden_jumlah_kk'		=> $jumlah_kk,
						'data_responden_jumlah_jiwa'	=> $jumlah_jiwa,
						'data_tanggal_entry'			=> date('Y-m-d H:i:s', time()),
						'data_user_entry'				=> $this->session->userdata['user_data']['user_id'],
						'data_status'					=> 1

					);
				$html = $this->responden_model->insert_responden($resdata);
				if($html>0) {
					foreach($ansadd as $kuisoner_id => $pilihan_id_ext) {

						$pil_id = explode('_', $pilihan_id_ext);
						$pilihan_id = $pil_id[0];
						$pilihan_other = str_replace($pilihan_id.'_', '', $pilihan_id_ext);
						$datakuisoner = array(
								'data_kuisoner_data_id'				=> $html,
								'data_kuisoner_kuisoner_id'			=> $kuisoner_id,
								'data_kuisoner_pilihan_id'			=> $pilihan_id,
								'data_kuisoner_pilihan_tambahan'	=> $pilihan_other,
								'data_kuisoner_status'				=> 1
							);
						$this->responden_model->insert_kuisoner_data($datakuisoner);
					}
				}
			}
			echo $html;
		} else {
			$data = array();
			$data['kuisoners'] = array();
			$groups = $this->responden_model->get_kuisoner_group()->result_array();
			foreach($groups as $gk => $gv) {
				$kuisoners = $this->responden_model->get_kuisoner($gv['kuisoner_group_id'])->result_array();
				$pertanyaan = array();
				foreach($kuisoners as $kk => $kv) {
					$pilihans = $this->responden_model->get_kuisoner_pilihan($kv['kuisoner_id'])->result_array();
					$jawaban = array();

					foreach($pilihans as $pk => $pv) {
						$anakpilihans = $this->responden_model->get_kuisoner_pilihan($kv['kuisoner_id'], $pv['kuisoner_pilihan_id'])->result_array();
						$anakjawaban = array();

						foreach($anakpilihans as $ak => $av) {
							$anakjawaban[] = array(
									'id_pilihan'		=> $av['kuisoner_pilihan_id'],
									'nomor_pilihan'		=> $av['kuisoner_pilihan_nomor'],
									'nama_pilihan'		=> $av['kuisoner_pilihan_teks'],
									'tambahan_pilihan'	=> $av['kuisoner_pilihan_tambahan']
								);
						}

						$jawaban[] = array(
								'id_pilihan'		=> $pv['kuisoner_pilihan_id'],
								'nomor_pilihan'		=> $pv['kuisoner_pilihan_nomor'],
								'nama_pilihan'		=> $pv['kuisoner_pilihan_teks'],
								'tambahan_pilihan'	=> $pv['kuisoner_pilihan_tambahan'],
								'anak_pilihan'		=> $anakjawaban
							);

					}

					if(count($jawaban)>0) {
						$pertanyaan[] = array(
								'id_pertanyaan' => $kv['kuisoner_id'],
								'pertanyaan'	=> $kv['kuisoner_pertanyaan'],
								'pilihan'		=> $jawaban
							);
					}
				}
				if(count($pertanyaan)>0) {
					$data['kuisoners'][] = array(
							'id_group'			=> $gv['kuisoner_group_id'],
							'nama_group'		=> $gv['kuisoner_group_nama'],
							'pertanyaan_group'	=> $pertanyaan
						);
				}
			}
			$this->template->single('responden/add_responden', $data);
		}
	}

	public function listall()
	{
		//custom header table from field name 
		$default_order = 'data_responden_nama';
		$order_field = array(
				'',
				'data_nomor_identitas',
				'data_responden_nik',
				'data_responden_nama',
				'data_responden_alamat',
				'data_responden_rt',
				'data_responden_rw'
			);
		$order_field = array_filter($order_field);

		//don't edit me
		$order_key = (!$this->input->get('iSortCol_0'))?0:$this->input->get('iSortCol_0');
		$order = (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort = (!$this->input->get('sSortDir_0'))?'desc':$this->input->get('sSortDir_0');
		$search = (!$this->input->get('sSearch'))?'':$this->input->get('sSearch');

		$limit = (!$this->input->get('iDisplayLength'))?0:$this->input->get('iDisplayLength');
		$start = (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');

		$data['sEcho'] = (!$this->input->get('callback'))?0:$this->input->get('callback');


		$data['iTotalRecords'] = $this->responden_model->count_all(1,$search,$order_field, $this->session->userdata['user_data']['kelurahan_id']);
		
		//load data
		$data['respondens'] = $this->responden_model->get_paged_list($this->session->userdata['user_data']['kelurahan_id'], $limit, $start, $order, $sort, $search, $order_field, 1)->result_array();
		//$data['respondens'] = array();
		$data['action'] = 'access_active';
		$data['callback'] = $this->input->get('callback');
		$data['start'] = $start;

		$this->template->single('responden/listall', $data);

	}

	public function responden_edit($id=0) {
		if($id>0) {
			$status = 0;
			if($postdata = $this->input->post()) {
				$nik			= isset($postdata['nik'])?$postdata['nik']:'';
				$nama			= isset($postdata['nama'])?$postdata['nama']:'';
				$alamat			= isset($postdata['alamat'])?$postdata['alamat']:'';
				$rt				= isset($postdata['rt'])?$postdata['rt']:'';
				$rw				= isset($postdata['rw'])?$postdata['rw']:'';
				$telp			= isset($postdata['telp'])?$postdata['telp']:'';
				$jumlah_kk		= isset($postdata['jumlah_kk'])?$postdata['jumlah_kk']:'';
				$jumlah_jiwa	= isset($postdata['jumlah_jiwa'])?$postdata['jumlah_jiwa']:'';
				$loc			= explode('|', (isset($postdata['loc'])?$postdata['loc']:'|'));

				$updatedata = array(
						'data_responden_nik' 			=> $nik,
						'data_map_latitude' 			=> $loc[0],
						'data_map_longitude' 			=> $loc[1],
						'data_responden_nama' 			=> $nama,
						'data_responden_alamat' 		=> $alamat,
						'data_responden_rt' 			=> $rt,
						'data_responden_rw' 			=> $rw,
						'data_responden_telepon' 		=> $telp,
						'data_responden_jumlah_kk' 		=> $jumlah_kk,
						'data_responden_jumlah_jiwa' 	=> $jumlah_jiwa
					);
				$updateprocess = $this->responden_model->responden_update($id, $updatedata);
				if($updateprocess) {
					$status = 1;
				}
			}
			echo $status;
		} else {
			if($postdata = $this->input->post()) {
				$data_id = isset($postdata['data_id'])?$postdata['data_id']:'';
				if($data_id!='') {
					$data = array();
					$data['responden'] = $this->responden_model->get_responden($data_id)->row_array();
					$this->template->single('responden/edit_responden', $data);
				} else {
					?> <div class="aLignCenter" style="color:#ff0000;">Maaf, Ada kesalahan!</div> <?php
				}
			} else {
				?> <div class="aLignCenter" style="color:#ff0000;">Maaf, Ada kesalahan!</div> <?php
			}
		}
	}

	public function survey_edit($id=0) {
		if($id>0) {
			$result = 0;
			if($post = $this->input->post()) {
				$ans = isset($post['ans'])?$post['ans']:'';
				if($ans!='') {
					$result = 1;
					foreach($ans as $kuisoner_id => $pilihan_id_ext) {
						$pil_id = explode('_', $pilihan_id_ext);
						$pilihan_id = $pil_id[0];
						$pilihan_other = str_replace($pilihan_id.'_', '', $pilihan_id_ext);


						$exist = $this->responden_model->check_option_exist($id, $kuisoner_id, $pilihan_id);
						if($exist>0) {
							$this->responden_model->update_kuisoner_data($id, $kuisoner_id, $pilihan_id, $pilihan_other);
						} else {
							$datakuisoner = array(
									'data_kuisoner_data_id'				=> $id,
									'data_kuisoner_kuisoner_id'			=> $kuisoner_id,
									'data_kuisoner_pilihan_id'			=> $pilihan_id,
									'data_kuisoner_pilihan_tambahan'	=> $pilihan_other,
									'data_kuisoner_status'				=> 1
								);
							$this->responden_model->insert_kuisoner_data($datakuisoner);
						}
					}
				}
			}
			echo $result;
		} else {
			if($postdata = $this->input->post()) {
				$data_id = isset($postdata['data_id'])?$postdata['data_id']:'';
				if($data_id!='') {
					$data = array();
					$data['data_id'] = $data_id;
					$data['responden'] = $this->responden_model->get_responden($data_id)->row_array();
					$jawaban = $this->responden_model->get_answer($data_id)->result_array();
					$data['jawaban'] = array();
					foreach($jawaban as $jv) {
						$data['jawaban'][$jv['data_kuisoner_kuisoner_id']] = $jv;
					}
					$data['kuisoners'] = array();
					$groups = $this->responden_model->get_kuisoner_group()->result_array();
					foreach($groups as $gk => $gv) {
						$kuisoners = $this->responden_model->get_kuisoner($gv['kuisoner_group_id'])->result_array();
						$pertanyaan = array();
						foreach($kuisoners as $kk => $kv) {
							$pilihans = $this->responden_model->get_kuisoner_pilihan($kv['kuisoner_id'])->result_array();
							$jawaban = array();

							foreach($pilihans as $pk => $pv) {
								$anakpilihans = $this->responden_model->get_kuisoner_pilihan($kv['kuisoner_id'], $pv['kuisoner_pilihan_id'])->result_array();
								$anakjawaban = array();

								foreach($anakpilihans as $ak => $av) {
									$anakjawaban[] = array(
											'id_pilihan'		=> $av['kuisoner_pilihan_id'],
											'nomor_pilihan'		=> $av['kuisoner_pilihan_nomor'],
											'nama_pilihan'		=> $av['kuisoner_pilihan_teks'],
											'tambahan_pilihan'	=> $av['kuisoner_pilihan_tambahan']
										);
								}

								$jawaban[] = array(
										'id_pilihan'		=> $pv['kuisoner_pilihan_id'],
										'nomor_pilihan'		=> $pv['kuisoner_pilihan_nomor'],
										'nama_pilihan'		=> $pv['kuisoner_pilihan_teks'],
										'tambahan_pilihan'	=> $pv['kuisoner_pilihan_tambahan'],
										'anak_pilihan'		=> $anakjawaban
									);

							}

							if(count($jawaban)>0) {
								$pertanyaan[] = array(
										'id_pertanyaan' => $kv['kuisoner_id'],
										'pertanyaan'	=> $kv['kuisoner_pertanyaan'],
										'pilihan'		=> $jawaban
									);
							}
						}
						if(count($pertanyaan)>0) {
							$data['kuisoners'][] = array(
									'id_group'			=> $gv['kuisoner_group_id'],
									'nama_group'		=> $gv['kuisoner_group_nama'],
									'pertanyaan_group'	=> $pertanyaan
								);
						}
					}
					$this->template->single('responden/edit_survey', $data);
				} else {
					?> <div class="aLignCenter" style="color:#ff0000;">Maaf, Ada kesalahan!</div> <?php
				}
			} else {
				?> <div class="aLignCenter" style="color:#ff0000;">Maaf, Ada kesalahan!</div> <?php
			}
		}
	}

}
?>