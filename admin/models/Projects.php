<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Model
{
	public function select($user_id = null)
	{
		if (!empty($user_id)) {
			$where = " WHERE user_privilege.user_id = $user_id";
		} else {
			$where = '';
		}
		
		$query_str = 'SELECT * FROM user_privilege LEFT JOIN (SELECT user_id, username FROM users) AS U
  ON user_privilege.user_id = U.user_id'.$where;
		
		$query = $this->db->query($query_str);
		
		return $query;
	}
	
	public function enable($proj_id, $user_id, $auth)
	{
		//		开启权限
		$data = array(
			$auth => 1
		);
		$this->db->where(array(
			'proj_id' => $proj_id,
			'user_id' => $user_id
		));
		$this->db->update('user_privilege', $data);
	}
	
	public function disable($proj_id, $user_id, $auth)
	{
		//		禁用权限
		$data = array(
			$auth => 0
		);
		$this->db->where(array(
			'proj_id' => $proj_id,
			'user_id' => $user_id
		));
		$this->db->update('user_privilege', $data);
	}
	
}
