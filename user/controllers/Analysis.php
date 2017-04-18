<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Analysis extends MY_Controller
{
	
	public function index()
	{
		$use_type = $this->config->item('use_type');
		if ($this->session_check() != 1) {
			echo '认证失败, 请重新登录';
			sleep(0.3);
			redirect('/user/login', 'location', 301);
		}

		$this->load->view('user/header', array(
			'username' => $this->session->userdata('user_id'),
			'use_type' => $use_type
		));
		$this->load->view('user/analysis');
		$this->load->view('user/footer');
	}
}
