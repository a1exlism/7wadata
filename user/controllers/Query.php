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
		
		$this->config->load('search_type');
	}
	
	public function to_timestamp($unix_time)
	{
		return date("Y-m-d H:m:s", $unix_time);
	}
	
	public function index()
	{
		$search_type = $this->config->item('search_type');
		$search_type_reverse = $this->config->item('search_type_reverse');
		$table_header = $this->config->item('table_header');
		$this->load->view('user/header', array(
			'username' => $this->session->userdata('user_id'),
		));
		
		//  todo: multi keyword NOT NULL (even just need exploded
		$results = $this->query_model->search(array(
			'startDate' => $this->to_timestamp($this->input->post('startDate')),
			'endDate' => $this->to_timestamp($this->input->post('endDate')),
			'location' => $this->input->post('location'),
			'qq' => $this->input->post('qq'),
			'weixin' => $this->input->post('wechat'),
			'type' => $this->input->post('search-type'),
			'keyword' => $this->input->post('keyword')
		)); //  data是从数据库查询到的数据
		
		$this->load->view('user/query', array(
			'search_type' => $search_type,
			'search_type_reverse' => $search_type_reverse,
			'table_header' => $table_header,
			'results' => $results,
		));
		
		$this->load->view('user/footer');
		
	}
	
//	public function search()
//	{
//
//	}
	
	public function test()
	{
		//  todo: multi keyword NOT NULL (even just need exploded
		$results = $this->query_model->search(array(
			'startDate' => $this->to_timestamp($this->input->post('startDate')),
			'endDate' => $this->to_timestamp($this->input->post('endDate')),
			'location' => $this->input->post('location'),
			'qq' => $this->input->post('qq'),
			'wechat' => $this->input->post('wechat'),
			'type' => $this->input->post('search-type'),
			'keyword' => $this->input->post('keyword')
		)); //  data是从数据库查询到的数据
		
		var_dump($results);
	}
}