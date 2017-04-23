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
	
	public function get_user_id($username)
	{
		$user_id = $this->db->query('SELECT user_id FROM users WHERE username = "' . $username . '"')->row()->user_id;
		return $user_id;
	}
	
	public function grant_privilege($user_id)
	{
		$this->db->insert('user_privilege', array(
			'user_id' => $user_id
		));
	}
	
	public function has_privilege($user_id, $auth) {
		$this->db->select($auth);
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('user_privilege');
		return $query->row()->$auth;
	}
}