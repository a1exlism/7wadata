function toMdy(date) {
	date = new Date(date);
	var year = date.getFullYear();
	var month = (1 + date.getMonth()).toString();
	month = month.length > 1 ? month : '0' + month;
	var day = date.getDate().toString();
	day = day.length > 1 ? day : '0' + day;
	return month + '/' + day + '/' + year;
}
$(function () {
	$('#getIncremental').click(function () {
		var userChanges = echarts.init(document.querySelector('#user-changes'));
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
				console.log(row);
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
			userChanges.setOption(option);
			// console.log(timestamps);
		});
	});
	$('#getIncremental').click();
});