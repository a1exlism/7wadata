<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Query extends MY_Controller
{
	private $user_id;
	
	public function __construct()
	{
		parent::__construct();
		
		if ($this->session_check() != 1) {
			echo '认证失败, 请重新登录';
			sleep(0.3);
			redirect('/user/login', 'location', 301);
		}
		$this->load->model('user');
		$this->load->model('projects');
		$this->load->model('query_model');
		
		$this->user_id = $this->user->get_user_id($this->session->userdata('user_id'));
		$this->config->load('search_type');
	}
	
	public function index()
	{
		$search_type = $this->config->item('search_type');
		$this->load->view('user/header', array(
			'username' => $this->session->userdata('user_id'),
		));
		$this->load->view('user/query', array(
			'search_type' => $search_type
		));
		
		$this->load->view('user/footer');
	}
	
	public function search($data_arr)
	{
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');
		$location = $this->input->post('location');
		$qq = $this->input->post('qq');
		$wechat = $this->input->post('wechat');
		$search_type = $this->input->post('search-type');
		//  todo: multi keyword NOT NULL (even just need exploded
		$keyword = $this->input->post('keyword');
		$data = '';           //  data是从数据库查询到的数据
	}
}