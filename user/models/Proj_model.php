<?php

class Proj_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->dbforge();
	}
	
	public function get_projs($user_id)
	{
		$this->db->select('*');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('proj_details');
		return $query;
	}
	
	public function get_proj($user_id, $proj_id)
	{
		$this->db->select('*');
		$this->db->where(array(
			'user_id' => $user_id,
			'proj_id' => $proj_id
		));
		$query = $this->db->get('proj_details');
		return $query;
	}
	
	public function proj_details_insert($data)
	{
		$this->db->insert('proj_details', $data);
	}
	
	public function proj_deletes($user_id, $proj_id)
	{
		//  projs && proj_details
		$tables = array('projs', 'proj_details');
		$this->db->where(array(
			'user_id' => $user_id,
			'proj_id' => $proj_id,
		));
		$this->db->delete($tables);
	}
	
	public function proj_update($user_id, $proj_id, $data)
	{
		$this->db->where(array(
			'user_id' => $user_id,
			'proj_id' => $proj_id,
		));
		$this->db->update('proj_details', $data);
	}
	
	//  GET excels arr
	public function excel_drops($excel_arr)
	{
		foreach ($excel_arr as $key => $excel_id) {
			$this->dbforge->drop_table($excel_id, TRUE);
		}
	}
	
	public function get_excel_nums($user_id, $proj_id)
	{
		//  获取用户特定proj存在的excel numbers
		//  proj中第一个excel是alter操作, 之后为insert操作
		$this->db->where(array(
			'user_id' => $user_id,
			'proj_id' => $proj_id,
			'type !=' => 0
		));
		return $this->db->get('projs')->num_rows();
	}
	
	public function excel_new($data)
	{
		//  $data => array
		$this->db->insert('projs', $data);
	}
	
	public function get_excel_ids($user_id, $proj_id)
	{
		$this->db->select('excel_id');
		$this->db->where(array(
			'user_id' => $user_id,
			'proj_id' => $proj_id
		));
		$query = $this->db->get('projs');
		return $query;
	}
}