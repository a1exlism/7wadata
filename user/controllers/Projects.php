<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Projects extends MY_Controller
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
		$this->select($proj_id);
	}
	
	//  Main page
	public function select($proj_id = null)
	{
		$this->load->view('user/header', array(
			'username' => $this->session->userdata('user_id')
		));
		$projs = $this->proj_model->get_projs($this->user_id);
		$proj_query = $this->proj_model->get_proj($this->user_id, $proj_id);
		if ($this->user->has_privilege($this->user_id, 'is_manage') != 1) {
			$this->load->view('user/error');
		} else if (empty($projs->num_rows())) {
			//  项目为空
			$this->load->view('user/projects');
		} else {
			if (empty($proj_query->row())) {
				//  当前项目不存在
				$proj_now = $projs->row();
			} else {
				$proj_now = $proj_query->row();
			}
		}
		$this->load->view('user/projects', array(
			'projs' => $projs->result(),
			'proj_id' => $proj_now->{'proj_id'},
			'proj_name' => $proj_now->{'proj_name'},
			'proj_description' => $proj_now->{'proj_description'},
		));
		$this->load->view('user/footer');
	}
	
	//  创建
	public function create()
	{
		$proj_name = $this->input->post('proj_name');
		$proj_description = $this->input->post('proj_description');
		$proj_id = $this->proj_model->get_projs($this->user_id)->num_rows() + 1;
		$this->proj_model->proj_details_insert(array(
			'user_id' => $this->user_id,
			'proj_id' => $proj_id,
			'proj_name' => $proj_name,
			'proj_description' => $proj_description,
		));
		
		echo "<h1 class='text-center'>项目创建成功</h1>";
		sleep(0.1);
		redirect('/user/projects', 'location', 301);
	}
	
	//  更改
	public function update()
	{
		$proj_id = $this->input->post('proj_id');
		$name = $this->input->post('proj_name');
		$description = $this->input->post('proj_description');
		$data = array();
		if (!empty($name)) {
			$data['proj_name'] = $name;
		}
		if (!empty($description)) {
			$data['proj_description'] = $description;
		}
		$this->proj_model->proj_update($this->user_id, $proj_id, $data);
		
		echo json_encode(array(
			'status' => 1
		));
	}
	
	//  删除
	public function delete()
	{
		$proj_id = $this->input->post('proj_id');
		$excel_id_arr = $this->get_excel_ids($proj_id);
		//  delete the row of projs && proj_details
		$this->proj_model->proj_deletes($this->user_id, $proj_id);
		//  delete all excels belong to this proj
		$this->proj_model->excel_drops($excel_id_arr);
		
		echo json_encode(array(
			'status' => 1
		));
	}
	
	public function get_excel_ids($proj_id)
	{
		$excel_results = $this->proj_model->get_excel_ids($this->user_id, $proj_id)->result();
		$excel_arr = [];
		foreach ($excel_results as $key => $val) {
			array_push($excel_arr, $val->{'excel_id'});
		}
		return $excel_arr;
	}
}
