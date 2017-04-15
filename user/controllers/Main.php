<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller
{
	
	public function index()
	{
		if ($this->session_check() != 1) {
			echo '认证失败, 请重新登录';
			sleep(0.3);
			redirect('/user/login', 'location', 301);
		}
		$this->load->view('user/main');
	}
	
	
}
