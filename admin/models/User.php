<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model
{
	private $salt = 'admin';
	
	public function get_admin()
	{
		$query_str = 'SELECT * FROM users WHERE is_admin = 1 LIMIT 1';
		$result = $this->db->query($query_str);
		return $result;
	}
	
	public function pass_check($name, $pass)
	{
		$query_admin = $this->get_admin($name)->row();
		if (
			$name == $query_admin->username &&
			$query_admin->password == md5(sha1($pass . 'admin'))
		) {
			return 1;
		} else {
			return 0;
		}
	}
}
