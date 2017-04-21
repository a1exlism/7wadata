<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['search_type'] = array(
	'假烟' => 1,
	'假酒' => 2,
	'假电器' => 3,
	'欺诈' => 4,
	'其他' => 999
);

$config['search_type_reverse'] = array(
	1 => '假烟',
	2 => '假酒',
	3 => '假电器',
	4 => '欺诈',
	999 => '其他'
);

$config['table_header'] = array(
	'id' => '',
	'type' => '类型',
	'city' => '城市/地区',
	'qq' => 'QQ',
	'weixin' => '微信',
	'mobile' => '手机',
	'phone' => '电话',
	'real_name' => '姓名',
	'id_card' => '身份证',
	'content' => '内容',
	'source_url' => '源地址',
	'gmt_create' => '创建时间',
	'gmt_modify' => '修改时间'
);