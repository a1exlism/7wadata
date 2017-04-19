<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upexcel extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('excels');
	}
	
	public function index($proj_no = 1)
	{
		$use_type = $this->config->item('use_type');
		$proj_nums = $this->get_projs_nums();
		if ($proj_no > $proj_nums) {
			$proj_no = 1;
		}
		
		if ($this->session_check() != 1) {
			echo '认证失败, 请重新登录';
			sleep(0.3);
			redirect('/user/login', 'location', 301);
		}
		
		$this->load->view('user/header', array(
			'username' => $this->session->userdata('user_id'),
			'use_type' => $use_type,
			'proj_nums' => $proj_nums,
			'present_proj_no' => $proj_no
		));
		
		$this->load->view('user/upexcel');
		$this->load->view('user/footer');
	}
	
	public function new_proj() {
	
	}
	
	public function get_projs_nums()
	{
		$username = $this->session->userdata('user_id');
		return $this->excels->proj_nums($username);
	}
	
	
}
