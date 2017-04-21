<!-- Sidebar -->
<div id="nav-left" class="col-sm-2 container">
	<div class="row">
		<div class="projects col-xs-12">
			<h3 class="text-center">数据分析</h3>
			<div class="dividing-line"></div>
			<ul id="nav-ul" class="list-group">
				<li class="list-group-item active">
					<a class="" href="#changes" data-toggle="tab"
					   aria-expanded="false" id="getIncremental">每日涨幅</a>
				</li>
				<li class="list-group-item">
					<a class="" href="#top10" data-toggle="tab"
					   aria-expanded="true">地区Top10</a>
				</li>
				<li class="list-group-item">
					<a class="" href="#visial" data-toggle="tab"
					   aria-expanded="false">可视化查询</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<!-- Main Container -->
<div id="main" class="col-sm-10 container">
	<div class="row">
		<div class="col-sm-offset-1 col-sm-10">
			<div id="myTabContent" class="tab-content row">
				<div class="tab-pane fade active in">
					<h1 class="echart-header text-center">每日涨幅</h1>
					<div id="user-changes" class="echarts">
					
					</div>
				</div>
				<div class="tab-pane fade">
					<h1 class="echart-header text-center">地区Top10</h1>
					<div id="top10" class="echarts">
					
					</div>
				</div>
				<div class="tab-pane fade">
					<h1 class="echart-header text-center">可视化查询</h1>
					<div id="visial" class="echarts">
					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>