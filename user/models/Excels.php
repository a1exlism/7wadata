<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Excels extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->dbforge();
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
	
	public function select_excels($excel_arr)
	{
		$results = array();
		foreach ($excel_arr as $value) {
			$results = array_merge($results, $this->select_excel_one($value)->result());
		}
		
		return $results;
	}
	
	public function select_excel_one($excel_id)
	{
		$this->db->select('*');
		$query = $this->db->get($excel_id);
		return $query;
	}
}
