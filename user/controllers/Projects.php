<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Projects extends MY_Controller
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
	
	public function index()
	{
		$this->load->view('user/header', array(
			'username' => $this->session->userdata('user_id')
		));
		if ($this->user->has_privilege($this->user_id, 'is_manage') != 1) {
			$this->load->view('user/error');
		} else {
			$this->load->view('user/projects');
		}
		
		$this->load->view('user/footer');
	}
}
