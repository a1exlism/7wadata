<!-- Sidebar -->
<div id="nav-left" class="col-sm-2 container">
	<div class="row">
		<div class="projects col-xs-12">
			<h3 class="text-center">项目组</h3>
			<div class="dividing-line"></div>
			<?php
			foreach ($projs as $no => $proj) {
				echo "<p class='proj'>
					<a href='/user/upexcel/project/$proj->proj_id'>$proj->proj_name</a>
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
			<h2 class="text-center">项目名: <?= $proj_name ?></h2>
			<?php
			//			var_dump($use_type);
			?>
			<div id="drop">将文件拖至该区域或者选择"上传文件"完成上传</div>
			<div class="file-upload">
				<span class="btn btn-sm btn-primary">上传文件</span>
				<input class="input-hidden" type="file" name="xlfile" id="xlf"/>
			</div>
			<a style="cursor: pointer;" class="btn btn-default btn-sm" id="db_insert">查询导入的数据</a>
			<form id="form-upload" class="form-horizontal">
				<fieldset>
					<legend>文件名: <span class="fullFileName"></span></legend>
					<div class="form-group">
						<label class="col-sm-2 control-label">交易类型:</label>
						<div class="col-sm-8">
							<?php
							foreach ($use_type as $key => $val) {
								?>
								<div class="radio">
									<label>
										<input type="radio" name="type" value="<?= $val ?>"
											<?php if ($val == 1) {
												echo "checked";
											}
											?>
										>
										<?= $key ?>
									</label>
								</div>
								<?php
							}
							?>
						</div>
					</div>
					<div class="form-group">
						<label for="select" class="col-sm-2 control-label">付款方:</label>
						<div class="col-sm-4">
							<select class="form-control" id="expense-side" name="expense_side">
							
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="select" class="col-sm-2 control-label">收款方:</label>
						<div class="col-sm-4">
							<select class="form-control" id="income-side" name="income_side">
							
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="select" class="col-sm-2 control-label">金额:</label>
						<div class="col-sm-4">
							<select class="form-control" id="amount" name="amount">
							
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-2 col-sm-offset-2">
							<button id="form-submit" type="button" class="btn btn-primary">确定入库</button>
						</div>
						<div class="col-sm-2">
							<span id="msg"></span>
						</div>
					</div>
					<div class="form-group-sm">
						<input type="hidden" id="proj_id" name="proj_id" value="<?= $proj_id ?>">
					</div>
					<div class="form-group-sm">
						<input type="hidden" id="table" name="table" value="">
					</div>
				
				</fieldset>
			</form>
			
			<pre id="out">
				<h4 class="text-center">文件内容</h4>
			</pre>
		</div>
	</div>
</div>