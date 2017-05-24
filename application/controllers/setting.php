<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$this->load->model('setting_model');
	}

	public function listall() {
		//custom header table from field name 
		$default_order = 'pengguna_nama';
		$order_field = array(
				'',
				'pegawai_nama_depan',
				'pengguna_nama',
				'kelurahan_nama',
				'pengguna_status'
			);
		$order_field = array_filter($order_field);

		//don't edit me
		$order_key = (!$this->input->get('iSortCol_0'))?0:$this->input->get('iSortCol_0');
		$order = (!$this->input->get('iSortCol_0'))?$default_order:$order_field[$order_key];
		$sort = (!$this->input->get('sSortDir_0'))?'desc':$this->input->get('sSortDir_0');
		$search = (!$this->input->get('sSearch'))?'':$this->input->get('sSearch');

		$limit = (!$this->input->get('iDisplayLength'))?10:$this->input->get('iDisplayLength');
		$start = (!$this->input->get('iDisplayStart'))?0:$this->input->get('iDisplayStart');

		$data['sEcho'] = (!$this->input->get('callback'))?0:$this->input->get('callback');


		$data['iTotalRecords'] = $this->setting_model->count_all(1,$search,$order_field);
		
		//load data
		$data['users'] = $this->setting_model->get_paged_list($limit, $start, $order, $sort, $search, $order_field, 1)->result_array();

		$data['callback'] = $this->input->get('callback');
		$data['start'] = $start;

		$this->template->single('setting/listall', $data);
	}

	public function pengguna($action='add') {
		if($action=='add') {
			if($post = $this->input->post()) {
				$result = 0;
				$pegawai = isset($post['pegawai'])?$post['pegawai']:'';
				$uname = isset($post['uname'])?$post['uname']:'';
				$passwd = isset($post['passwd'])?$post['passwd']:'';
				$kel = isset($post['kel'])?$post['kel']:'';
				//echo $pegawai.' - '.$uname.' - '.$passwd.' - '.$kel; 
				if($pegawai!='' && $uname!='' && $passwd!='' && $kel!='') {
					$pegawaidata = array('pegawai_nama_depan'=>$pegawai,'pegawai_status'=>1);
					$pegawai_id = $this->setting_model->insert_pegawai($pegawaidata);
					if($pegawai_id>0) {
						$userdata = array(
								'pengguna_pegawai_id'		=> $pegawai_id,
								'pengguna_nama'				=> $uname,
								'pengguna_password'			=> md5($passwd),
								'pengguna_kelurahan_id'		=> $kel,
								'pengguna_status'			=> 1
							);
						$insertuser = $this->setting_model->insert_user($userdata);
						if($insertuser>0) {
							$result = 1;
						}
					}
				}
				echo $result;
			} else {
				$data = array();
				$data['kelurahans'] = $this->setting_model->get_kelurahan()->result_array();
				$this->template->single('setting/pengguna_add', $data);
			}
		} else if($action=='edit') {
			if($post = $this->input->post()) {
				$result = 0;
				$ids = explode('-', isset($post['pid'])?$post['pid']:'-');
				$pen_id = $ids[0];
				$peg_id = $ids[1];
				$pegawai = isset($post['pegawai'])?$post['pegawai']:'';
				$uname = isset($post['uname'])?$post['uname']:'';
				$passwd = isset($post['passwd'])?$post['passwd']:'';
				$kel = isset($post['kel'])?$post['kel']:0;
				if($pen_id!='' && $peg_id!='' && $pegawai!='' && $uname!='' && $kel>0) {
					$updpeg = $this->setting_model->update_pegawai($peg_id, array('pegawai_nama_depan'=>$pegawai));
					$pengdata = array(
							'pengguna_nama'			=> $uname,
							'pengguna_kelurahan_id'	=> $kel
						);
					if($passwd!='') {
						$pengdata['pengguna_password'] = md5($passwd);
					}
					$updpeg = $this->setting_model->update_pengguna($pen_id, $pengdata);
					$result = 1;
				}
				echo $result;
			}

		}
	}

	public function check_pengguna() {
		$result = 0;
		if($post = $this->input->post()) {
			$uname = isset($post['uname'])?$post['uname']:'';
			if($uname!='') {
				$result = $this->setting_model->user_check($uname);
			}
		}
		echo $result;
	}

	function change_status() {
		$data = 0;
		if($post = $this->input->post()) {
			$id = isset($post['id'])?$post['id']:'';
			$status = isset($post['status'])?$post['status']:'';
			if($id!='' && $status!='') {
				$this->setting_model->update_pengguna($id, array('pengguna_status'=>$status));
				$data = 1;
			}
		}
		echo $data;
	}

	public function get_user($pid) {
		$result = array('status'=>false);
		if($pid>0) {
			$result = $this->setting_model->get_user($pid)->row_array();
			if(count($result)>0) {
				$result = array('status'=>true,'datas'=>$result);
			}
		}
		echo json_encode($result);
	}
}