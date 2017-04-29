<!-- Sidebar -->
<div id="nav-left" class="col-sm-2 container">
	<div class="row">
		<div class="projects col-xs-12">
			<h3 class="text-center">项目组</h3>
			<div class="dividing-line"></div>
			<?php
			foreach ($projs as $no => $proj) {
				echo "<p class='proj'>
					<a href='/user/graphic/project/$proj->proj_id'>$proj->proj_name</a>
				</p>";
			}
			?>
		</div>
	</div>
</div>
<!-- Main Container -->
<div id="main" class="col-sm-10 container">
	<div class="row">
		<div class="col-sm-offset-1 col-sm-10">
			<div id="myTabContent" class="tab-content row">
				<div class="row">
					<h1 class="text-center" data-projid="<?= $proj_id ?>">可视化查询 | <?= $proj_name ?></h1>
					<?php
					if ($has_data == true) {
						?>
						<div class="col-lg-12">
							<div id="graph">
							
							</div>
						</div>
						<div id="excel-details" class="col-lg-offset-1 col-lg-offset-10">
							<table class="table table-hover">
								<thead>
								
								</thead>
								<tbody>
								
								</tbody>
							</table>
						</div>
						<?php
					} else {
						?>
						<div class="row">
							<div class="col-md-offset-3 col-md-6">
								<h3>请到<a href='/user/upexcel/project/<?= $proj_id ?>'>Excel上传点</a>上传该项目的excel表格</h3>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>