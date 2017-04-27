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
		$this->load->model('proj_model');
		
		$this->user_id = $this->user->get_user_id($this->session->userdata('user_id'));
		
		if ($this->session_check() != 1) {
			echo '认证失败, 请重新登录';
			sleep(0.3);
			redirect('/user/login', 'location', 301);
		}
		
	}
	
	public function index($proj_no = null)
	{
		$this->project($proj_no);
	}
	
	public function project($proj_id = null)
	{
		
		$this->load->view('user/header', array(
			'username' => $this->session->userdata('user_id'),
			'use_type' => $this->config->item('use_type'),  //  定义的文件
		));
		if ($this->user->has_privilege($this->user_id, 'is_upload') != 1) {
			$this->load->view('user/error');
		} else if (empty($this->proj_model->get_projs($this->user_id)->num_rows())) {
			$this->load->view('user/error', array(
				'type' => 'empty_proj',
			));
		} else {
			
			$projs = $this->proj_model->get_projs($this->user_id)->result();
			$proj_got = $this->proj_model->get_proj($this->user_id, $proj_id)->row();
			if (empty($proj_id) || empty($proj_got)) {
				//  No such proj_id, and there should be a proj at least
				$proj_now = $projs[0];
			} else {
				$proj_now = $proj_got;
			}
			
			$this->load->view('user/upexcel', array(
				'projs' => $projs,
				'proj_id' => $proj_now->{'proj_id'},
				'proj_name' => $proj_now->{'proj_name'},
			));
		}
		$this->load->view('user/footer');
	}
	
	public function test()
	{
		echo "<pre>";
//		$projs = $this->proj_model->get_projs($this->user_id)->result();
//		var_dump($projs[0]->{'proj_id'});
		echo "</pre>";
	}
	
	public function excel_create()
	{
		//  创建excel表 涉及数据库: new table, projs
		//  form data
		$type = $this->input->post('type');
		//  下面是三列No.
		$expense_side = $this->input->post('expense_side');
		$income_side = $this->input->post('income_side');
		$amount = $this->input->post('amount');
		
		$values = json_decode($this->input->post('table'));
		$proj_id = $this->input->post('proj_id');
		
		$excel_nums = $this->proj_model->get_excel_nums($this->user_id, $proj_id);
		
		$table_name = $this->user_id . '_' . $proj_id . '_' . ($excel_nums + 1);
		
		//  配置projs表
		$this->proj_model->excel_new(array(
			'proj_id' => $proj_id,
			'user_id' => $this->user_id,
			'excel_id' => $table_name,
			'type' => $type
		));
		//  创建数据库
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
