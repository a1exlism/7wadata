<!-- Sidebar -->
<div id="nav-left" class="col-sm-2 container">
	<div class="row">
		<div class="projects col-xs-12">
			<h3 class="text-center">数据查询</h3>
			<div class="dividing-line"></div>
		</div>
	</div>
</div>
<!-- Main Container -->
<div id="main" class="col-sm-10 container">
	<div class="row">
		<div class="col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-10 col-lg-offset-2 col-lg-8">
			<form id="query-conditions" class="form-horizontal" style="padding-top: 15px;">
				<fieldset>
					<legend>查询条件:</legend>
					<div class="form-group">
						<label for="startDate" class="col-sm-1 control-label">日期:</label>
						<div class="col-sm-3">
							<input type="text" class="form-control input-sm input-datedropper"
							       data-theme="darken"
							       data-lang="zh"
							       data-large-mode="true"
							       data-large-default="true"
							       id="startDate"
							       autocomplete="off">
						</div>
						<label for="endDate" class="col-sm-1 control-label">至</label>
						<div class="col-sm-3">
							<input type="text" class="form-control input-sm input-datedropper"
							       data-theme="darken"
							       data-lang="zh"
							       data-large-mode="true"
							       data-large-default="true"
							       id="endDate"
							       autocomplete="off">
						</div>
						<label for="location" class="col-sm-1 control-label">城市/地区:</label>
						<div class="col-sm-3">
							<input type="text" class="form-control input-sm" id="location" autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<label for="qq" class="col-sm-1 control-label">QQ:</label>
						<div class="col-sm-3">
							<input type="text" class="form-control input-sm" id="qq" autocomplete="off">
						</div>
						<label for="wechat" class="col-sm-1 control-label">微信</label>
						<div class="col-sm-3">
							<input type="text" class="form-control input-sm" id="wechat" autocomplete="off">
						</div>
						<label for="goods-type" class="col-sm-1 control-label">类型:</label>
						<div class="col-sm-3 select-sm">
							<select class="form-control input-sm" id="goods-type">
								<!-- todo: 对应一个defined.php -->
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							</select>
							<br>
						</div>
					</div>
					
					<div class="form-group">
						<label for="keyword" class="col-sm-1 control-label">关键词</label>
						<div class="col-sm-11">
							<input type="text" class="form-control input-sm" id="keyword" autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-6 col-sm-offset-4">
							<button type="reset" class="btn btn-default">条件重置</button>
							<button type="button" class="btn btn-primary">查询</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>