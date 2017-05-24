<?php
class Auth_model extends CI_Model{

	function __construct(){
		parent:: __construct();
	}

	function get_login($username, $password) {
		$this->db->select('*');
		$this->db->where('iduser',md5($username));
		$this->db->where('password=MD5("'.$password.'")','',false);
		//$this->db->where('pengguna_status', 1);
		//$this->db->join('kelurahan', 'pengguna_kelurahan_id = kelurahan_id');
		return $this->db->get('muser');
	}

}