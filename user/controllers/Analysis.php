<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Analysis extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		if ($this->session_check() != 1) {
			echo '认证失败, 请重新登录';
			sleep(0.3);
			redirect('/user/login', 'location', 301);
		}
		$this->load->model('query_model');
	}
	
	public function index()
	{
		$this->load->view('user/header', array(
			'username' => $this->session->userdata('user_id')
		));
		$this->load->view('user/analysis');
		
		$this->load->view('user/footer');
	}
	
	public function get_incremental()
	{
		echo json_encode($this->query_model->get_incremental()->result());
	}
	
	public function get_city_top10()
	{
		echo json_encode(array(
			'qq' => $this->query_model->city_top10_qq()->result(),
			'wechat' => $this->query_model->city_top10_weixin()->result()
		));
	}
}