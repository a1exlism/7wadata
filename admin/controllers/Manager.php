<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends MY_Controller
{
	private $list = array(
		'user_id' => '用户ID',
		'username' => '用户名',
		'is_upload' => 'Excel上传',
		'is_query' => '数据查询',
		'is_graphic' => '图形化查询'
	);
	private $trans = array(
		1 => '有',
		0 => '无'
	);
	
	public function __construct()
	{
		parent::__construct();
		
		if ($this->session_check() != 1) {
			echo('验证失败, 请重新登录');
			redirect('/admin/login', 'location', 301);
		}
		
		$this->load->model('privilege');
	}
	
	public function index($user_id = null)
	{
		//  todo: 用户筛选, 暂时放一下
		if (empty($user_id)) {
			$results = $this->privilege->select()->result();
		} else {
			$results = $this->privilege->select($user_id)->result();
		}
		$this->load->view('/admin/manager', array(
			'results' => $results,
			'list' => $this->list,
			'trans' => $this->trans
		));
	}
	
	public function pri_toggle($val, $user_id, $auth_name)
	{
		if ($val == 1) {
			$this->privilege->disable($user_id, $auth_name);
		} else {
			$this->privilege->enable($user_id, $auth_name);
		}
	}
	
}
