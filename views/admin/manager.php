<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Projects Manager</title>
	<link rel="stylesheet" type="text/css" href="/assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/admin_manager.css">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<h1 class="text-center">Manager Header</h1>
			<table class="table table-hover">
				<thead>
				<tr>
					<th>
						<div class="btn-group btn-group-xs">
							<a href="#" class="btn btn-xs btn-default">用户ID</a>
							<a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
							</ul>
						</div>
					</th>
					<th>用户名</th>
					<th>项目No</th>
					<th>create</th>
					<th>drop</th>
					<th>select</th>
					<th>alter</th>
					<th>insert</th>
					<th>update</th>
				</tr>
				</thead>
				<tbody>
				<?php
				//					var_dump($results);
				foreach ($results as $key => $val) {
					?>
					<th><?= $val ?></th>
					<?php
				}
				?>
				<tr>
					<th>111</th>
					<th>111</th>
					<th>111</th>
					<th>111</th>
					<th>111</th>
					<th>111</th>
					<th>111</th>
					<th>111</th>
				</tr>
				<tr>
					<th>222</th>
					<th>222</th>
					<th>222</th>
					<th>222</th>
					<th>222</th>
					<th>222</th>
					<th>222</th>
					<th>222</th>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="/assets/3rd/jquery.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>