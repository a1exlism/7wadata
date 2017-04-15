<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
	
	private $salt = 'admin';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user');
	}
	
	public function index()
	{
		if ($this->session_check()) {
			redirect('/admin/manager', 'location', 301);
		}
		$this->load->view('admin/login');
	}
	
	public function login_check()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		if ($this->user->pass_check($username, $password) == 1) {
			$this->session->set_userdata('admin_id', $username);
			$this->session->set_userdata('is_login', 1);
			$res = array('statusCode' => 1);
		} else {
			$res = array('statusCode' => 0);
		}
		
		echo json_encode($res);
	}
}
