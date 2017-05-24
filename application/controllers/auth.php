<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$this->load->model("auth_model");	
	}

	public function login() {
		if(is_array($userdata = $this->session->userdata['user_data'])) {
			if($userdata['logged_in']==true) {
			    //$this->session->sess_destroy();
				redirect(base_url()); 
				die();
			}
		}
		if($postdata = $this->input->post()) {
			$data = 0;
			$username = isset($postdata['username'])?$postdata['username']:'';
			$password = isset($postdata['password'])?$postdata['password']:'';
			if($username!='' && $password!='') {
				if(count($login = $this->auth_model->get_login($username, $password)->row_array())>0) {
					$userdata = array(
							'user_id'		=> $login['iduser'],
							'kelurahan_id'	=> $login['pengguna_kelurahan_id'],
							'coordinate'	=> array(
										'lat' => $login['kelurahan_map_latitude'],
										'lon' => $login['kelurahan_map_longitude']
									),
							'logged_in' => true
						);
					$this->session->set_userdata('user_data',$userdata);
					$data = 1;
				}
			}
			echo $data;
		} else {
			$data = array();
			$this->template->headonly('login', $data);
		}
	}

	function logout() {
		$this->session->sess_destroy();
		redirect(base_url()); die();
	}

}