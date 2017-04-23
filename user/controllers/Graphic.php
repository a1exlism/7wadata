<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Graphic extends MY_Controller
{
	private $user_id;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('excels');
		$this->load->model('user');
		$this->load->model('projects');
		
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
		
		$proj_nums = $this->get_proj_nums();
		
		if ($this->user->has_privilege($this->user_id, 'is_graphic') != 1) {
			$this->load->view('user/not_allowed');
		} else {
			$this->load->view('user/graphic', array(
				'proj_nums' => $proj_nums,
			
			));
		}
		$this->load->view('user/footer');
	}
	
	public function get_proj_nums()
	{
		return $this->projects->proj_nums($this->user_id);
	}
	
}

?>