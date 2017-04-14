<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {
	public function get_admin () {
		$query_str = 'SELECT * FROM users WHERE is_admin = 1 LIMIT 1';
		$result = $this->db->query($query_str);
		return $result;
	}
}
