<!-- Sidebar -->
<div id="nav-left" class="col-sm-2 container">
	<div class="row">
		<div class="projects col-xs-12">
			<h3 class="text-center">项目组</h3>
			<div class="dividing-line"></div>
			<?php
			$i = 0;
			while ($i++ < $proj_nums) {
				echo "<p class='proj'>
						<a href='/user/graphic/project/$i'>项目$i</a>
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
					<h1 class="text-center">可视化查询</h1>
					<div class="col-lg-offset-1 col-lg-offset-10">
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
				</div>
			</div>
		</div>
	</div>
</div>