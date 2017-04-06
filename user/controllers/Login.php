<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	/*
	 * user client login
	 */
	public function index()
	{
		$this->load->view('login');
	}
}
