<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
	/*
	 * user client login
	 */
	private $salt = 'admin';
	
	public function index()
	{
		if ($this->session_check() == 1) {
			redirect('/user/upexcel', 'location', 301);
		}
		$this->load->view('user/login');
	}
	
	public function login_check()
	{
		$this->load->model('user');
		
		$username = $this->input->post('username');
		$password = md5(sha1($this->input->post('password') . $this->salt));
		$query_user = $this->user->select_one($username)->row();
		if (empty($query_user)) {
			$res = array(
				'statusCode' => 0,
				'errMsg' => '用户不存在'
			);
		} else if ($username == $query_user->username && $password == $query_user->password) {
			$this->session->set_userdata('user_id', $username);
			$this->session->set_userdata('is_login', 1);
			$res = array('statusCode' => 1);
		} else {
			$res = array(
				'statusCode' => 0,
				'errMsg' => '帐号或密码不正确'
			);
		}
		
		echo json_encode($res);
	}
	
	public function logout()
	{
		session_destroy();
		redirect('/user/login', 'refresh', 301);
	}
}
