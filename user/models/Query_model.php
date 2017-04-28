<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Query_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->dbforge();
	}
	
	public function inserts($data)
	{
		$this->db->insert('data_query', $data);
	}
	
	public function search($query_arr, $num, $offset)
	{
		foreach ($query_arr as $key => $val) {
			if (empty($val)) {
				continue;
			}
			//  location like keyword like
			switch ($key) {
				case 'startDate':
					$this->db->where('gmt_create >=', $val);
					break;
				case 'endDate':
					$this->db->where('gmt_create <=', $val);
					break;
				case 'location':
					$this->db->like('city', $val, 'both');
					break;
				case 'keyword':
					$this->db->like('content', $val, 'both');
					break;
				default:
					$this->db->where($key, $val);
			}
		}
		$query = $this->db->get('data_query', $num, $offset);
		return $query;
	}
	
	public function search_row_num($query_arr)
	{
		foreach ($query_arr as $key => $val) {
			if (empty($val)) {
				continue;
			}
			//  location like keyword like
			switch ($key) {
				case 'startDate':
					$this->db->where('gmt_create >=', $val);
					break;
				case 'endDate':
					$this->db->where('gmt_create <=', $val);
					break;
				case 'location':
					$this->db->like('city', $val, 'both');
					break;
				case 'keyword':
					$this->db->like('content', $val, 'both');
					break;
				default:
					$this->db->where($key, $val);
			}
		}
		$nums = $this->db->count_all_results('data_query');
		return $nums;
	}
	
	public function get_incremental()
	{
		//  获取每日增量
		$this->db->select(['qq', 'weixin', 'gmt_create']);
		$this->db->order_by('gmt_create', 'ASC');
		$query = $this->db->get('data_query');
		return $query;
	}
	
	public function city_top10_qq()
	{
		$this->db->select(['qq', 'city']);
		$this->db->order_by('qq', 'DESC');
		$this->db->limit(10);
		$query = $this->db->get('data_query');
		return $query;
	}
	
	public function city_top10_weixin()
	{
		$this->db->select(['weixin', 'city']);
		$this->db->order_by('weixin', 'DESC');
		$this->db->limit(10);
		$query = $this->db->get('data_query');
		return $query;
	}
}
