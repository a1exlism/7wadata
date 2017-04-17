<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller
{
	
	public function index()
	{
		if ($this->session_check() == 1) {
			redirect('/user/analysis', 'location', 301);
		}
		$this->load->view('user/register');
	}
	
	public function regi_check()
	{
		$this->load->model('user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$query_user = $this->user->select_one($username)->row();
		if (!empty($query_user)) {
			$res = array(
				'statusCode' => 0,
				'errMsg' => '用户已存在'
			);
		} else if (strlen($password) < 6) {
			$res = array(
				'statusCode' => 0,
				'errMsg' => '密码至少6位'
			);
		} else if (!(preg_match('/[a-z]/i', $password) == 1 && preg_match('/[0-9]/', $password))) {
			$res = array(
				'statusCode' => 0,
				'errMsg' => '密码至少包含字母和数字'
			);
		} else {
			$this->user->register($username, $password);
			$res = array(
				'statusCode' => 1
			);
		}
		
		echo json_encode($res);
	}
}
