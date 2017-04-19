<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends MY_Controller
{
	private $list = array(
		'user_id' => '用户ID',
		'username' => '用户名',
		'proj_id' => '项目ID',
		'is_create' => 'create',
		'is_drop' => 'drop',
		'is_select' => 'select',
		'is_alter' => 'alter',
		'is_insert' => 'insert',
		'is_update' => 'update'
	);
	
	public function __construct()
	{
		parent::__construct();
		
		if ($this->session_check() != 1) {
			echo('验证失败, 请重新登录');
			redirect('/admin/login', 'location', 301);
		}
		
		$this->load->model('projects', 'projs');
	}
	
	public function index($user_id = null)
	{
		//  todo: 用户筛选, 暂时放一下
		if (empty($user_id)) {
			$results = $this->projs->select()->result();
		} else {
			$results = $this->projs->select($user_id)->result();
		}
		$this->load->view('/admin/manager', array(
			'results' => $results,
			'list' => $this->list
		));
	}
	
	public function pri_toggle($val, $proj_id, $user_id, $auth)
	{
		if ($val == 1) {
			$this->projs->disable($proj_id, $user_id, $auth);
		} else {
			$this->projs->enable($proj_id, $user_id, $auth);
		}
	}
	
}
