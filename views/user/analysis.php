<div id="nav-left" class="col-md-2 container">
	<div class="row">
		<div class="projects col-xs-12">
			<h3 class="text-center">项目组</h3>
			<div class="dividing-line"></div>
			<p class="proj">项目1</p>
			<p class="proj">项目2</p>
			<p id="proj-add"><a class="btn-sm btn-default" href="#">添加新项目</a></p>
		</div>
	</div>
</div>
<div id="main" class="col-md-10 container">
	<div class="row">
		<h1 class="text-center">数据分析 | 项目A</h1>
		<!--Output Format:
				<select class="select" name="format" onchange="setfmt()">
					<option value="json" selected> JSON</option>
					<option value="csv"> CSV</option>
					<option value="form"> FORMULAE</option>
				</select><br/> -->
		<div id="drop">Drop a spreadsheet file here to see sheet data</div>
		<p><input type="file" name="xlfile" id="xlf"/> ... or click here to select a file</p>
		<a href="#" class="btn btn-default btn-sm" id="db_insert">插入数据库/pre显示</a>
		<pre id="out"></pre>
	
	</div>
</div>