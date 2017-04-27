<!-- Sidebar -->
<div id="nav-left" class="col-sm-2 container">
	<div class="row">
		<div class="projects col-xs-12">
			<h3 class="text-center">项目管理</h3>
			<div class="dividing-line"></div>
			<?php
			if (!empty($projs)) {
				foreach ($projs as $no => $proj) {
					echo "<p class='proj'>
					<a href='/user/projects/select/$proj->proj_id'>$proj->proj_name</a>
				</p>";
				}
			}
			?>
			<p id="proj-add">
				<a class="btn-sm btn-default" style="cursor: pointer;">添加新项目</a>
			</p>
		</div>
	</div>
</div>
<!-- Main Container -->
<div id="main" class="col-sm-10 container">
	<div class="row">
		<div class="col-sm-offset-1 col-sm-10">
			<?php
			if (!empty($proj_name)) {
				?>
				<h2 class="text-center" data-projid="<?= $proj_id ?>">项目名: <?= $proj_name ?></h2>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">项目描述</h3>
					</div>
					<div class="panel-body">
						<?= $proj_description ?>
					</div>
				</div>
				<div>
					<ul class="nav nav-pills">
						<li class="active"><a href="#proj-update" data-toggle="tab" aria-expanded="true">更改当前项目</a></li>
						<li class=""><a href="#proj-delte" data-toggle="tab" aria-expanded="false">删除当前项目</a></li>
					</ul>
					<div id="tab-project" class="tab-content" style="margin-top: 30px">
						<div class="tab-pane fade active in" id="proj-update">
							<form class="form-horizontal">
								<fieldset>
									<div class="form-group">
										<label for="inputProjName" class="col-lg-2 control-label">项目名称</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" id="inputProjName">
										</div>
									</div>
									<div class="form-group">
										<label for="inputProjDetails" class="col-lg-2 control-label">项目描述</label>
										<div class="col-lg-10">
											<textarea class="form-control" rows="3" id="inputProjDetails"></textarea>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-10 col-lg-offset-2">
											<button type="reset" class="btn btn-default">重置</button>
											<button id="btnUpdate" type="button" class="btn btn-primary">更改</button>
										</div>
									</div>
								</fieldset>
							</form>
						</div>
						<div class="tab-pane fade" id="proj-delte">
							<form class="form-horizontal">
								<fieldset>
									<div class="form-group">
										<div class="col-lg-10 col-lg-offset-2">
											<p>当前项目名为:<span style="font-weight: bold;"><?= $proj_name ?></span></p>
											<button type="button" id="btnDelete" class="btn btn-danger">确认删除</button>
										</div>
									</div>
								</fieldset>
							</form>
						</div>
						<div class="form-group">
							<p class="text-center" id="msg"></p>
						</divcl>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>