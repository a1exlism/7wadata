<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Excels extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->dbforge();
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
	
	public function create_table($table_name, $tables)
	{
		/*
		 * 建表
		 * */
		$this->dbforge->add_field('id');
		$fields = array(
			'expense_side' => array(
				'type' => 'VARCHAR',
				'constraint' => '40'
			),
			'income_side' => array(
				'type' => 'VARCHAR',
				'constraint' => '40'
			),
			'amount' => array(
				'type' => 'INT'
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->create_table($table_name);
		
		/*
		* 数据插入
		*/
		$table_keys = [];
		$values = $tables['values'];  //  接收到需要插入的数据
		$orders = array(
			'expense_side' => $tables['expense_side'] - 1,
			'income_side' => $tables['income_side'] - 1,
			'amount' => $tables['amount'] - 1
		);
		
		foreach ($values[0] as $key => $val) {
			array_push($table_keys, $key);
		}
		
		foreach ($values as $k => $vals) {
			$tmp_arr = get_object_vars($vals);
			$this->db->insert($table_name, array(
				'expense_side' => $tmp_arr[$table_keys[$orders['expense_side']]],
				'income_side' => $tmp_arr[$table_keys[$orders['income_side']]],
				'amount' => $tmp_arr[$table_keys[$orders['amount']]]
			));
		}
	}
}
