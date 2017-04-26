<?php
if (empty($type)) {
	$type = null;
}
switch ($type) {
	//  默认认为没有权限
	case 'empty_proj':
		echo "<h2 class='text-center'>项目为空, 请前往<a href='/user/upexcel'>Excel文件上传点</a>创建项目</h2>";
		break;
	case 'empty_excel':
		echo "<h2 class='text-center'>该项目数据库为空, 请前往<a href='/user/upexcel'>Excel文件上传点</a>在该项目上传excel表格</h2>";
		break;
	default:
		echo "<h2 class='text-center'>你没有权限使用该功能, 请使用其他功能或与管理员联系</h2>";
}
