<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Query extends MY_Controller
{
	private $user_id;
	
	public function __construct()
	{
		parent::__construct();
		
		if ($this->session_check() != 1) {
			echo '认证失败, 请重新登录';
			sleep(0.3);
			redirect('/user/login', 'location', 301);
		}
		
		
		$this->load->model('user');
		$this->load->model('query_model');
		$this->config->load('search_type');
		
		$this->user_id = $this->user->get_user_id($this->session->userdata('user_id'));
	}
	
	public function to_timestamp($unix_time)
	{
		return date("Y-m-d H:m:s", $unix_time);
	}
	
	public function index()
	{
		$this->load->view('user/header', array(
			'username' => $this->session->userdata('user_id'),
		));
		
		if ($this->user->has_privilege($this->user_id, 'is_query') != 1) {
			$this->load->view('user/error');
		} else {
			$search_type = $this->config->item('search_type');
			$search_type_reverse = $this->config->item('search_type_reverse');
			
			$this->load->view('user/query', array(
				'search_type' => $search_type,
				'search_type_reverse' => $search_type_reverse,
			));
		}
		$this->load->view('user/footer');
	}
	
	public function search($offset_page = 0)
	{
		$per_page = 15;
		$offset = $offset_page * $per_page;
		$conditions = array(
			'startDate' => $this->to_timestamp($this->input->post('startDate')),
			'endDate' => $this->to_timestamp($this->input->post('endDate')),
			'location' => $this->input->post('location'),
			'qq' => $this->input->post('qq'),
			'weixin' => $this->input->post('wechat'),
			'type' => $this->input->post('search-type'),
			'keyword' => $this->input->post('keyword')
		);
		$results = $this->query_model->search($conditions, $per_page, $offset)->result();
		
		echo json_encode($results);
	}
	
	public function get_search_nums()
	{
		$conditions = array(
			'startDate' => $this->to_timestamp($this->input->post('startDate')),
			'endDate' => $this->to_timestamp($this->input->post('endDate')),
			'location' => $this->input->post('location'),
			'qq' => $this->input->post('qq'),
			'weixin' => $this->input->post('wechat'),
			'type' => $this->input->post('search-type'),
			'keyword' => $this->input->post('keyword')
		);
		echo json_encode(array(
			"nums" => $this->query_model->search_row_num($conditions)
		));
	}
	
	public function data_import()
	{
		$salt = md5(sha1('import'));
		$post_salt = $this->input->post('salt');
		$data = array(
			'type' => $this->input->post('type'),
			'city' => $this->input->post('city'),
			'qq' => $this->input->post('qq'),
			'weixin' => $this->input->post('weixin'),
			'mobile' => $this->input->post('mobile'),
			'phone' => $this->input->post('phone'),
			'real_name' => $this->input->post('real_name'),
			'id_card' => $this->input->post('id_card'),
			'content' => $this->input->post('content'),
			'source_url' => $this->input->post('source_url'),
			'gmt_create' => $this->input->post('gmt_create'),
			'gmt_modify' => $this->input->post('gmt_modify')
		);
		
		if ($post_salt == $salt) {
			$this->query_model->inserts($data);
			echo json_encode(array(
				'status' => '1'
			));
		} else {
			echo json_encode(array(
				'salt' => $post_salt,
				'status' => '0',
			));
		}
	}
	
	public function test()
	{
//		$results = $this->query_model->search(array(
//			'startDate' => $this->to_timestamp('2736000'),
//			'endDate' => $this->to_timestamp('1492790400'),
//			'location' => $this->input->post('location'),
//			'qq' => $this->input->post('qq'),
//			'weixin' => $this->input->post('wechat'),
//			'type' => $this->input->post('search-type'),
//			'keyword' => $this->input->post('keyword')
//		)); //  data是从数据库查询到的数据
//		$rows_num = 0;
//		foreach ($results as $key => $val) {
//			$rows_num++;
//		}
//		$this->load->library('pagination');
//		$config['base_url'] = $_SERVER['PHP_SELF'];
//		$config['total_rows'] = $rows_num;
//		$config['per_page'] = 15;
//		$config['uri_segment'] = 3;
//		$config['use_page_numbers'] = TRUE;
//		$config['full_tag_open'] = '<ul class=pagination>';
//		$config['full_tag_close'] = '</ul>';
//		$this->pagination->initialize($config);
//		echo $this->pagination->create_links();
	}
}