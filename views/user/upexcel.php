<div id="nav-left" class="col-sm-2 container">
	<div class="row">
		<div class="projects col-xs-12">
			<h3 class="text-center">项目组</h3>
			<div class="dividing-line"></div>
			<?php
			$i = 0;
			while ($i++ < $proj_nums) {
				echo "<p class='proj'>
						<a href='/user/upexcel/index/$i'>项目$i</a>
						</p>";
			}
			
			?>
			<p id="proj-add"><a class="btn-sm btn-default" href="#">添加新项目</a></p>
		</div>
	</div>
</div>
<div id="main" class="col-sm-10 container">
	<div class="row">
		<h2 class="text-center">Excel | <?= $present_proj_no; ?></h2>
		<?php var_dump($use_type); ?>
		<div id="drop">Drop a spreadsheet file here to see sheet data</div>
		<p><input type="file" name="xlfile" id="xlf"/> ... or click here to select a file</p>
		<a href="#" class="btn btn-default btn-sm" id="db_insert">插入数据库/pre显示</a>
		<pre id="out"></pre>
	</div>
</div>