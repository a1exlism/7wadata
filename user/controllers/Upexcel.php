<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upexcel extends MY_Controller
{
	private $user_id;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('excels');
		$this->load->model('user');
		$this->load->model('projects');
		
		$this->user_id = $this->user->get_user_id($this->session->userdata('user_id'));
		
		if ($this->session_check() != 1) {
			echo '认证失败, 请重新登录';
			sleep(0.3);
			redirect('/user/login', 'location', 301);
		}
		
	}
	
	public function index($proj_no = 1)
	{
		$this->project($proj_no);
	}
	
	public function project($proj_no = 1)
	{
		$use_type = $this->config->item('use_type');
		
		$proj_nums = $this->get_proj_nums();
		if ($proj_no > $proj_nums) {
			$proj_no = 1;
		}
		
		$this->load->view('user/header', array(
			'username' => $this->session->userdata('user_id'),
			'use_type' => $use_type,
			'proj_nums' => $proj_nums,
			'present_proj_no' => $proj_no
		));
		if ($this->user->has_privilege($this->user_id, 'is_upload') != 1) {
			$this->load->view('user/not_allowed');
		} else {
			$this->load->view('user/upexcel');
		}
		$this->load->view('user/footer');
	}
	
	public function test()
	{
//		var_dump($this->user->has_privilege($this->user_id, 'is_upload'));
	}
	
	public function new_proj()
	{
		$new_proj_id = $this->get_proj_nums() + 1;
		$this->projects->projs_new(array(
			'user_id' => $this->user_id,
			'proj_id' => $new_proj_id,
			'excel_id' => $this->user_id . '_' . $new_proj_id . '_1'
		));
		redirect('/user/upexcel/project/' . $new_proj_id, 'location');
	}
	
	public function get_proj_nums()
	{
		return $this->projects->proj_nums($this->user_id);
	}
	
	public function excel_create()
	{
		//  创建excel表 涉及数据库: new table, projs
		//  form data
		$type = $this->input->post('type');
		$expense_side = $this->input->post('expense_side');
		$income_side = $this->input->post('income_side');
		$amount = $this->input->post('amount');
		$values = json_decode($this->input->post('table'));
		$proj_id = $this->input->post('proj_id');
		
		$excel_nums = $this->projects->get_excel_nums($this->user_id, $proj_id);
		
		$table_name = $this->user_id . '_' . $proj_id . '_' . ($excel_nums + 1);
		
		//  配置projs表
		if ($excel_nums == 0) {
			//  第1个excel
			$this->projects->projs_complete($table_name, $type); //  补全表信息
		} else {
			//  第2+的excel
			//  建立新表信息
			$this->projects->projs_new(array(
				'proj_id' => $proj_id,
				'user_id' => $this->user_id,
				'excel_id' => $table_name,
				'type' => $type
			));
		}
		//  创建数据库
//		echo $table_name;
		$this->excels->create_table($table_name, array(
			'expense_side' => $expense_side,
			'income_side' => $income_side,
			'amount' => $amount,
			'values' => $values
		));
		
		echo json_encode(array(
			'status' => 1
		));
	}
}
