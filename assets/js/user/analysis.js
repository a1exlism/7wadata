function toMdy(date) {
	date = new Date(date);
	var year = date.getFullYear();
	var month = (1 + date.getMonth()).toString();
	month = month.length > 1 ? month : '0' + month;
	var day = date.getDate().toString();
	day = day.length > 1 ? day : '0' + day;
	return month + '/' + day + '/' + year;
}

function obj2arr(obj) {
	return Object.keys(obj).map(function (key) {
		return obj[key];
	});
}

$(function () {
	var echartUserChanges = echarts.init($('#user-changes > .echarts').get(0));
	var echartTop10a = echarts.init($('#top10 > .echarts').get(0));
	var echartTop10b = echarts.init($('#top10 > .echarts').get(1));
	var echartVisial = echarts.init($('#visial > .echarts').get(0));
	
	function allHideBut(name) {
		$('#user-changes').hide();
		$('#top10').hide();
		$('#visial').hide();
		$(name).show();
	}
	
	$('#getIncremental').click(function () {
		allHideBut('#user-changes');
		$.get('/user/analysis/get_incremental').done(function (data) {
			console.log('#user-change success');
			// 指定图表的配置项和数据
			data = JSON.parse(data);
			// console.log(data);
			var qqNum = [];
			var wechatNum = [];
			var timestamps = [];
			var row;
			for (i in data) {
				row = data[i];
				// console.log(row);
				for (i in row) {
					qqNum.push(row['qq']);
					wechatNum.push(row['weixin']);
					timestamps.push(toMdy(row['gmt_create']));
				}
			}
			var option = {
				title: {
					text: '数量: QQ/微信'
				},
				tooltip: {},
				legend: {
					data: ['QQ', '微信']
				},
				xAxis: {
					boundaryGap: false,
					axisLabel: {
						interval: 1, // all infos
					},
					data: timestamps,
				},
				yAxis: {
					type: 'value',
					axisLabel: {
						formatter: '{value}'
					}
				},
				dataZoom: [
					{
						type: 'slider',
						xAxisIndex: 0,
						filterMode: 'empty'
					},
					{
						type: 'slider',
						yAxisIndex: 0,
						filterMode: 'empty'
					},
					{
						type: 'inside',
						xAxisIndex: 0,
						filterMode: 'empty'
					},
					{
						type: 'inside',
						yAxisIndex: 0,
						filterMode: 'empty'
					}
				],
				series: [
					{
						name: 'QQ',
						type: 'line',
						data: qqNum,
					},
					{
						name: '微信',
						type: 'line',
						data: wechatNum,
					}
				]
			};
			// 使用刚指定的配置项和数据显示图表。
			
			echartUserChanges.setOption(option);
			// console.log(timestamps);
		});
	});
	
	$('#getCityTop10').click(function () {
		allHideBut('#top10');
		
		var qqNum = [];
		var wechatNum = [];
		var citys1 = [];
		var citys2 = [];
		$.get('/user/analysis/get_city_top10').done(function (data) {
			console.log('#get_city_top10 success');
			data = JSON.parse(data);
			var row, row2;
			for (i in data) {
				row = data[i];
				if (i == 'qq') {
					for (i in row) {
						row2 = row[i];
						qqNum.push(row2['qq']);
						citys1.push(row2['city']);
					}
				} else {
					for (i in row) {
						row2 = row[i];
						wechatNum.push(row2['weixin']);
						citys2.push(row2['city']);
					}
				}
			}
			// console.log(qqNum);
			// console.log(citys1);
			
			var option1 = {
				color: ['#3398DB'],
				title: {
					text: '地区排名前十 | QQ'
				},
				grid: {
					left: '3%',
					right: '4%',
					bottom: '3%',
					containLabel: true
				},
				tooltip: {},
				legend: {
					data: ['QQ']
				},
				xAxis: {
					type: 'category',
					data: citys1,
					axisLabel: {
						interval: 0, //横轴信息全部显示
					},
				},
				yAxis: {
					type: 'value',
					axisLabel: {
						formatter: '{value}'
					}
				},
				series: [
					{
						name: 'QQ',
						type: 'bar',
						barWidth: '50%',
						data: qqNum,
					}
				]
			};
			echartTop10a.setOption(option1);
			
			var option2 = {
				color: ['#3398DB'],
				title: {
					text: '地区排名前十 | 微信'
				},
				grid: {
					left: '3%',
					right: '4%',
					bottom: '3%',
					containLabel: true
				},
				tooltip: {},
				legend: {
					data: ['QQ']
				},
				xAxis: {
					type: 'category',
					data: citys2,
					axisLabel: {
						interval: 0, //横轴信息全部显示
					},
				},
				yAxis: {
					type: 'value',
					axisLabel: {
						formatter: '{value}'
					}
				},
				series: [
					{
						name: 'QQ',
						type: 'bar',
						barWidth: '50%',
						data: wechatNum,
					}
				]
			};
			echartTop10b.setOption(option2);
		});
	});
	
	$('#getVisial').click(function () {
		allHideBut('#visial');
	});
	
	$('#getIncremental').click();
});