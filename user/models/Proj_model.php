<?php

class Proj_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function proj_nums($user_id)
	{
		$this->db->select('proj_id');
		$this->db->distinct();
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('projs');
		return $query->num_rows();
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
	
	public function projs_complete($excel_id, $type)
	{
		//  针对于projs第一行
		$this->db->where('excel_id', $excel_id);
		$this->db->update('projs', array(
			'type' => $type
		));
	}
	
	public function projs_new($data)
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