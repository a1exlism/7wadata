var width = 600;
var height = 400;
var globalData; //  存储dump下来的所有数据
var dataThead = $('#excel-details thead');
var dataTbody = $('#excel-details tbody');

function getUserArr(data) {
	var obj = {};
	var arr = [];
	for (i in data) { //  get all data(duplicated)
		var singleObj = data[i];
		arr.push(singleObj['expense_side']);
		arr.push(singleObj['income_side']);
	}
	if (Array.isArray(arr) && arr.length > 0) {
		var len = arr.length;
		for (var i = 0; i < len; i++) {
			obj[arr[i]] = arr[i];
		}
		return Object.keys(obj);
	}
	return [];
}

function getUserNodes(dataArr) {
	var nodes = [];
	var objArr = dataArr.map(function (x) {
		nodes.push({
			name: x
		});
	});
	return nodes;
}

function getEdges(userArr, data) {
	var arr = [];
	for (i in data) {
		var singleObj = data[i];
		arr.push({
			source: userArr.indexOf(singleObj['expense_side']),
			target: userArr.indexOf(singleObj['income_side'])
		});
	}
	return arr;
}

function tdAppendTr(bodyTr, singleRow) {
	for (i in singleRow) {
		if (i == 'id') {
			continue;
		} else {
			$(bodyTr).append('<td>' + singleRow[i] + '</td>');
		}
	}
	$(dataTbody).append(bodyTr);
}

function showAllDetails() {
	var data = globalData;
	var singleRow;
	var headerTr = $('<tr></tr>');
	$(headerTr).append('<th>#</th>');
	var toZh = {
		'expense_side': '付款方',
		'income_side': '收款方',
		'amount': '金额'
	};
	//  thead
	for (i in data[0]) {
		//  table Header
		if (i == 'id') {
			continue;
		} else {
			$(headerTr).append('<th>' + toZh[i] + '</th>');
		}
	}
	$(dataThead).append(headerTr);
	//  tbody
	for (i in data) {
		//  Every single row data
		singleRow = data[i];
		//  table Header
		var bodyTr = $('<tr></tr>');
		$(bodyTr).append('<td>' + (parseInt(i) + 1) + '</td>');
		tdAppendTr(bodyTr, singleRow);
	
	}
}

function showSingleDetails(userName) {
	$(dataTbody).empty();
	var data = globalData;
	var singleRow;
	var exp = new RegExp(userName);
	var userExpense = [];
	var userIncome = [];
	
	//  1. 筛选 => a.expense_side
	for (i in data) {
		singleRow = data[i];
		
		var bodyTr = $('<tr></tr>');
		$(bodyTr).append('<td>' + (parseInt(i) + 1) + '</td>');
		
		if (exp.test(singleRow['expense_side'])) {
			tdAppendTr(bodyTr, singleRow);
		}
	}
	//  分割线
	$(dataTbody).append('<tr><td>---</td><td>---</td><td>---</td><td>---</td></tr>')
	//  2. 筛选 => b.income_side
	for (i in data) {
		singleRow = data[i];
		
		var bodyTr = $('<tr></tr>');
		$(bodyTr).append('<td>' + (parseInt(i) + 1) + '</td>');
		
		if (exp.test(singleRow['income_side'])) {
			tdAppendTr(bodyTr, singleRow);
		}
	}
	
}

$(function () {
	
	var nodes = [];
	var edges = [];
	
	//  force picture Initialized
	$.ajax({
		type: 'GET',
		// dataType: 'JSON',
		url: '/user/graphic/get_excels_results',
		success: function (data) {
			data = JSON.parse(data);
			globalData = data;
			nodesArr = getUserArr(data);
			nodes = getUserNodes(nodesArr);
			edges = getEdges(nodesArr, data);
			
			var svg = d3.select('#graph')
				.append('svg')
				.attr('width', width)
				.attr('height', height);
			
			var force = d3.layout.force()
				.nodes(nodes) //指定节点数组
				.links(edges) //指定连线数组
				.size([width, height]) //指定作用域范围
				.linkDistance(150) //指定连线长度
				.charge([-400]); //相互之间的作用力
			
			force.start();  //  作用力
			
			//添加连线
			var svg_edges = svg.selectAll("line")
				.data(edges)
				.enter()
				.append("line")
				.style("stroke", "#ccc")
				.style("stroke-width", 1);
			
			var color = d3.scale.category20();
			
			//添加节点
			var svg_nodes = svg.selectAll("circle")
				.data(nodes)
				.enter()
				.append("circle")
				.attr("r", 20)
				.style("fill", function (d, i) {
					return color(i);
				})
				.call(force.drag);//使得节点能够拖动
			//添加描述节点的文字
			var svg_texts = svg.selectAll("text")
				.data(nodes)
				.enter()
				.append("text")
				.style("fill", "black")
				.style('cursor', 'pointer')
				.style('font-weight', 'bold')
				.attr("dx", 20)
				.attr("dy", 8)
				.on('click', function () {
					// console.log(this.innerHTML);
					//  todo: callback(val)
					showSingleDetails(this.innerHTML);
				})
				.text(function (d) {
					return d.name;
				});
			
			
			force.on("tick", function () { //对于每一个时间间隔
				
				//更新连线坐标
				svg_edges.attr("x1", function (d) {
					return d.source.x;
				})
					.attr("y1", function (d) {
						return d.source.y;
					})
					.attr("x2", function (d) {
						return d.target.x;
					})
					.attr("y2", function (d) {
						return d.target.y;
					});
				
				//更新节点坐标
				svg_nodes.attr("cx", function (d) {
					return d.x;
				})
					.attr("cy", function (d) {
						return d.y;
					});
				
				//更新文字坐标
				svg_texts.attr("x", function (d) {
					return d.x;
				})
					.attr("y", function (d) {
						return d.y;
					});
			});
			
			showAllDetails(); //  默认显示所有内容
		}
	});
	
	//  force picture end
});
