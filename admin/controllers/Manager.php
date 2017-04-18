<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Manager extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		if ($this->session_check() != 1) {
			echo('验证失败, 请重新登录');
			redirect('/admin/login', 'location', 301);
		}
		
		$this->load->model('projects', 'projs');
	}
	
	public function index ($user_id = null) {
		if (empty($user_id)) {
			$results = $this->projs->select()->result();
		} else {
			$results = $this->projs->select($user_id)->result();
		}
		$this->load->view('/admin/manager', array(
			'results' => $results
		));
	}
	
	public function proj_user($user_id) {
		//  todo: 这个功能暂时放着
		return $this->projs->select($user_id);
	}
}
