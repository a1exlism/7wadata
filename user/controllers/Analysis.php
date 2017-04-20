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
	}
	
	public function index()
	{
		$this->load->view('user/header', array(
			'username' => $this->session->userdata('user_id')
		));
		$this->load->view('user/analysis');
		
		$this->load->view('user/footer');
	}
	
	
}