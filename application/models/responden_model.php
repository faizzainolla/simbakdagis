<?php

class Responden_model extends CI_Model{

	function __construct(){
		parent:: __construct();
	}

	function get_paged_list($kelurahan_id, $limit=10, $offset=0, $order_column='', $order_type='asc', $search='', $fields='')
	{
		$this->db->where('data_responden_kelurahan_id', $kelurahan_id);
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
		return $this->db->get('datas',$limit,$offset);
	}

	function count_all($status,$search, $fields='', $kelurahan_id)
	{
		$this->db->where('data_responden_kelurahan_id', $kelurahan_id);
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
		$this->db->from('datas');
		return $this->db->count_all_results(); 
	}

	function get_responden($id) {
		$this->db->where('data_id', $id);
		return $this->db->get('datas');
	}

	function responden_update($id, $data) {
		$this->db->where('data_id', $id);
		return $this->db->update('datas',$data);
	}

	function get_kuisoner_group() {
		$this->db->where('kuisoner_group_status', 1);
		$this->db->order_by('kuisoner_group_urutan', 'ASC');
		return $this->db->get('kuisoner_group');
	}

	function get_kuisoner($gid) {
		$this->db->where('kuisoner_group_id', $gid);
		$this->db->where('kuisoner_status', 1);
		$this->db->order_by('kuisoner_urutan', 'ASC');
		return $this->db->get('kuisoner');
	}

	function get_kuisoner_pilihan($kid, $pid=0) {
		$this->db->where('kuisoner_pilihan_kuisoner_id', $kid);
		$this->db->where('kuisoner_pilihan_parent_id', $pid);
		$this->db->where('kuisoner_pilihan_status', 1);
		$this->db->order_by('kuisoner_pilihan_nomor', 'ASC');
		return $this->db->get('kuisoner_pilihan');
	}

	function get_answer($rid) {
		$this->db->where('data_kuisoner_data_id', $rid);
		$this->db->group_by('data_kuisoner_kuisoner_id');
		return $this->db->get('data_kuisoner');
	}

	function check_option_exist($did, $kid) {
		$this->db->where('data_kuisoner_data_id', $did);
		$this->db->where('data_kuisoner_kuisoner_id', $kid);
		$this->db->from('data_kuisoner');
		return $this->db->count_all_results(); 
	}

	function update_kuisoner_data($did, $kid, $pid, $oth) {
		$this->db->where('data_kuisoner_data_id', $did);
		$this->db->where('data_kuisoner_kuisoner_id', $kid);
		$this->db->update('data_kuisoner', array('data_kuisoner_pilihan_id'=>$pid,'data_kuisoner_pilihan_tambahan'=>$oth));
	}

	function insert_kuisoner_data($data) {
		$this->db->insert('data_kuisoner', $data);
	}
	function insert_responden($data) {
		$this->db->insert('datas', $data);
		return $this->db->insert_id();
	}

	function get_last_identity($kel_id) {
		$this->db->select('data_nomor_identitas');
		$this->db->where('data_nomor_identitas !=""');
		$this->db->where('data_responden_kelurahan_id', $kel_id);
		$this->db->order_by('data_nomor_identitas', 'DESC');
		return $this->db->get('datas');
	}
}