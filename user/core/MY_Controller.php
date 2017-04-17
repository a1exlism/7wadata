<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function session_check()
	{
		$is_login = $this->session->userdata('is_login');
		$user_id = $this->session->userdata('user_id');
		
		if (empty($is_login) || empty($user_id)) {
			return 0;
		} else {
			return 1;
		}
	}
	

}