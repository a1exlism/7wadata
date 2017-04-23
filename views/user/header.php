<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo ucfirst(explode('/', uri_string())[0]) . ' Page'; ?> | 7wadata</title>
	<link rel="stylesheet" type="text/css" href="/assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/common.css">
	
	<?php if (preg_match('/query/i', $_SERVER['PHP_SELF'])) {
		echo '<link rel="stylesheet" href="/assets/3rd/datedropper3/datedropper.min.css">';
		echo '<link rel="stylesheet" href="/assets/3rd/datedropper3/darken.css">';
	}
	?>

</head>
<body>

<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
			        data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<span class="navbar-brand" style="padding:6.5px;">
				<img class="brand-logo" width="32" height="32" src="/assets/imgs/logo.png" alt=""></span>
			<span class="navbar-brand"> 7娃数据 </span>
		</div>
		
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav" id="header-tags">
				<li class=""><a href="/user/upexcel">数据入库</a></li>
				<li class=""><a href="/user/query">数据查询</a></li>
				<li class=""><a href="/user/analysis">数据分析</a></li>
				<li class=""><a href="/user/graphic">可视化查询</a></li>
			
			</ul>
			<ul class="nav navbar-nav navbar-right">
				
				<li><a id="nav-toggle" href="#">隐藏侧边栏</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<?php echo $username; ?>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="/user/login/logout">Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>

<div class="container-fluid" style="margin-bottom: 10%;">
	<div class="row">
