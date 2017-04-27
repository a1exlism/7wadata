<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Graphic extends MY_Controller
{
	private $user_id;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('excels');
		$this->load->model('user');
		$this->load->model('proj_model');
		
		$this->user_id = $this->user->get_user_id($this->session->userdata('user_id'));
		
		if ($this->session_check() != 1) {
			echo '认证失败, 请重新登录';
			sleep(0.3);
			redirect('/user/login', 'location', 301);
		}
	}
	
	public function index($proj_id = null)
	{
		$this->project($proj_id);
	}
	
	public function project($proj_id)
	{
		$this->load->view('user/header', array(
			'username' => $this->session->userdata('user_id')
		));
		
		$projs = $this->proj_model->get_projs($this->user_id)->result();
		//  todo: 这里有问题
		
		$proj_now = $this->proj_model->get_proj($this->user_id, $proj_id)->row();
		if ($this->user->has_privilege($this->user_id, 'is_graphic') != 1) {
			$this->load->view('user/error');
		} else if (empty($projs)) {
			//  no projs
			$this->load->view('user/error', array(
				'type' => 'empty_proj'
			));
		} else {
			if (empty($proj_now)) {
				$proj_now = $projs[0];
				$proj_id = $proj_now->{'proj_id'};
			}
			if (sizeof($this->get_excel_id_arr($proj_id)) < 1) {
				//  判断是否有数据
				$has_data = false;
			} else {
				$has_data = true;
			}
			$this->load->view('user/graphic', array(
				'projs' => $projs,
				'proj_id' => $proj_id,
				'proj_name' => $proj_now->{'proj_name'},
				'has_data' => $has_data,
			));
		}
		$this->load->view('user/footer');
	}
	
	public function get_excel_id_arr($proj_id)
	{
		$res = $this->proj_model->get_excel_ids($this->user_id, $proj_id)->result();
		$arr = [];
		foreach ($res as $val) {
			array_push($arr, $val->{'excel_id'});
		}
		return $arr;
	}
	
	public function get_excels_results()
	{
		$proj_id = $this->input->get('proj_id');
		$excel_arr = $this->get_excel_id_arr($proj_id);
		$contents = $this->excels->select_excels($excel_arr);
		
		echo json_encode($contents);
	}
	
	
	public function test($proj_id = null)
	{
		echo "<pre>";
		var_dump($this->proj_model->get_projs($this->user_id)->result());
		echo "</pre>";
	}
}
