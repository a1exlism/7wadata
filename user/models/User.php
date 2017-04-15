<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model
{
	private $salt = 'admin';
	
	public function select_one($name)
	{
		if (empty($name)) {
			return 0;
		}
		$this->db->where('username', $name);
		$query = $this->db->get('users');
		return $query;
	}
	
	public function register($name, $pass)
	{
		$this->db->insert('users', array(
			'username' => $name,
			'password' => md5(sha1($pass . $this->salt))
		));
	}
}