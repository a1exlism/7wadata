<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Excels extends CI_Model {
	public function proj_nums($username)
	{
		$user_id = $this->db->query('SELECT user_id FROM users WHERE username = "'.$username.'"')->row()->user_id;
		$this->db->where('user_id', $user_id);
		return $this->db->count_all_results('projs');
	}
	
	public function new_proj($user_id) {
		//  创建新项目只涉及到 table projs
		$data = array(
			'user_id' => $user_id
		);
		$this->db->insert('projs', $data);
	}
}
