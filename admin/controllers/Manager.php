<?php
/**
 * Created by PhpStorm.
 * User: a1exlism
 * Date: 4/14/17
 * Time: 4:06 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Manager extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('session_check');
		
		if ($this->session_check->check() != 1) {
			echo('验证失败, 请重新登录');
			redirect('/admin/login', 'location', 301);
		}
	}
	
	public function index () {
		$this->load->view('/admin/manager');
	}
}
