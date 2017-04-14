<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user');
	}
	
	public function index()
	{
		$this->load->model('session_check');
		if ($this->session_check->check() === 1) {
			redirect('/admin/manager', 'location', 301);
		}
		$this->load->view('admin/login');
	}
	
	public function login_check()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password') . 'admin');
		$query_admin = $this->user->get_admin()->row();
		if ($username == $query_admin->username && $password == $query_admin->password) {
			$this->session->set_userdata('user_id', $username);
			$this->session->set_userdata('is_login', 1);
			$res = array('statusCode' => 1);
		} else {
			$res = array('statusCode' => 0);
		}
		
		echo json_encode($res);
	}
}
