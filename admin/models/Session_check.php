<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Session_check extends CI_Model
{
	private $is_login;
	private $user_id;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->is_login = $this->session->userdata('is_login');
		$this->user_id = $this->session->userdata('user_id');
	}
	
	public function check()
	{
		if (empty($this->is_login) || empty($this->user_id)) {
			return 0;
		} else {
			return 1;
		}
	}
}
