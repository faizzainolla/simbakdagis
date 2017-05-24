<?php

class Setting_model extends CI_Model{

	function __construct(){
		parent:: __construct();
	}

	function get_paged_list($limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		if($search!='' AND $fields!='')
		{
			$likeclause = '(';
			$i=0;
			foreach($fields as $field)
			{
				if($i==count($fields)-1) {
					$likeclause .= $field." LIKE '%".$search."%'";
				} else {
					$likeclause .= $field." LIKE '%".$search."%' OR ";
				}
				++$i;
			}
			$likeclause .= ')';
			$this->db->where($likeclause);
		}

		if (empty($order_column) || empty($order_type))
		{
			$this->db->order_by($this->primary_key,'desc');
		} else {
			$this->db->order_by($order_column,$order_type);
		}
		return $this->db->get('view_pengguna',$limit,$offset);
	}

	function count_all($status,$search, $fields='')
	{
		if($search!='' AND $fields!='')
		{
			$likeclause = '(';
			$i=0;
			foreach($fields as $field)
			{
				if($i==count($fields)-1) {
					$likeclause .= $field." LIKE '%".$search."%'";
				} else {
					$likeclause .= $field." LIKE '%".$search."%' OR ";
				}
				++$i;
			}
			$likeclause .= ')';
			$this->db->where($likeclause);
		}
		$this->db->from('view_pengguna');
		return $this->db->count_all_results(); 
	}

	function user_check($uname) {
		$this->db->where('pengguna_nama', $uname);
		$this->db->from('view_pengguna');
		return $this->db->count_all_results(); 
	}

	function get_kelurahan() {
		return $this->db->get('view_enabled_kelurahan');
	}
	function insert_pegawai($data) {
		$this->db->insert('pegawai', $data);
		return $this->db->insert_id();
	}
	function insert_user($data) {
		$this->db->insert('gis_pengguna', $data);
		return $this->db->insert_id();
	}

	function update_pegawai($pid, $data) {
		$this->db->where('pegawai_id', $pid);
		$this->db->update('pegawai', $data);
	}

	function update_pengguna($pid, $data) {
		$this->db->where('pengguna_id', $pid);
		$this->db->update('pengguna', $data);
	}

	function get_user($pid) {
		$this->db->select('pengguna.*, pegawai.pegawai_nama_depan');
		$this->db->where('pengguna_id', $pid);
		$this->db->join('pegawai', 'pengguna_pegawai_id = pegawai_id');
		return $this->db->get('pengguna');
	}

}