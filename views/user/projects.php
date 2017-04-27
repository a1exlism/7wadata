<!-- Sidebar -->
<div id="nav-left" class="col-sm-2 container">
	<div class="row">
		<div class="projects col-xs-12">
			<h3 class="text-center">项目管理</h3>
			<div class="dividing-line"></div>
			<?php
			foreach ($projs as $no => $proj) {
				echo "<p class='proj'>
					<a href='/user/projects/select/$proj->proj_id'>$proj->proj_name</a>
				</p>";
			}
			?>
			<p id="proj-add">
				<a class="btn-sm btn-default" href="/user/projects/create">添加新项目</a>
			</p>
		</div>
	</div>
</div>
<!-- Main Container -->
<div id="main" class="col-sm-10 container">
	<div class="row">
		<div class="col-sm-offset-1 col-sm-10">
			<div class="jumbotron">
				<h1>Jumbotron</h1>
				<p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
				<p><a class="btn btn-primary btn-lg">Learn more</a></p>
			</div>
<!--			<h2 class="text-center">项目名: --><?//= $proj_name ?><!--</h2>-->
<!--			<p>-->
<!--				<>项目描述:</>--><?//= $proj_description ?>
<!--			</p>-->
		</div>
	</div>
</div>