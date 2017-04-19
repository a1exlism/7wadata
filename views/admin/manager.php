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
					<?php
					foreach ($list as $key => $val) {
						echo "<th>$list[$key]</th>";
					}
					?>
				</tr>
				</thead>
				<tbody>
				<?php
				for ($i = 0; $i < sizeof($results); $i++) {
					echo "<tr>";
					foreach ($list as $key => $val) {
						
						?>
						<th>
							<span>
								<?= $results[$i]->{$key} ?>
							</span>
							<?php
							if (preg_match('/is_/', $key)) {
								$auth = $key;
								$url = '/admin/manager/pri_toggle/' .
									$results[$i]->{$key} . '/' .
									$results[$i]->{'proj_id'} . '/' .
									$results[$i]->{'user_id'} . '/' .
									$key;
								echo '<span><a url="' . $url . '">更改权限</a></span>';
							}
							?>
						</th>
						<?php
					}
					echo "</tr>";
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="/assets/3rd/jquery.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script>
	$(function () {
		$('a').each(function () {
			$(this).click(function (e) {
				e.preventDefault();
				$.ajax({
					type: 'GET',
					url: $(this).attr('url'),
					success: function () {
						console.log('success');
						location.reload();
					}
				});
			});
		})
	});
</script>
</body>
</html>