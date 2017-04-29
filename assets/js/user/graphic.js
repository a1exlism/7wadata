var globalData; //  存储dump下来的所有数据
var links = []; //  d3 svg数据
var dataThead = $('#excel-details thead');
var dataTbody = $('#excel-details tbody');

function jsonParse(data) {
	var singleData = {};
	var result = [];
	for (i in data) {
		singleData = data[i];
		result.push({
			'source': singleData['expense_side'],
			'target': singleData['income_side'],
			'value': parseFloat(singleData['amount'] / 1000)
		});
	}
	return result;
}

function render(links) {
	var width = $('#graph').width();  //  svg size
	var height = 680;
	var isMouseDown, oldScale = 1;
	var curPos_x, curPos_y, mousePos_x, mousePos_y;
	var viewBox_x = 0, viewBox_y = 0;
	
	var nodes = {};
	// Compute the distinct nodes from the links.
	links.forEach(function (link) {
		link.source = nodes[link.source] || (nodes[link.source] = {
				name: link.source
				
			});
		link.target = nodes[link.target] || (nodes[link.target] = {
				name: link.target
			});
		link.value = +link.value;
	});
	
	var force = d3.layout.force()
		.nodes(d3.values(nodes))
		.links(links)
		.size([width, height])
		.linkDistance(60)
		.charge(-300)
		.on("tick", tick).start();
	
	var svg = d3.select("#graph")
		.append("svg")
		.attr("width", width)
		.attr("height", height)
		.style('cursor', 'move')
		.call(d3.behavior.zoom()
			//  缩放
				.scaleExtent([0.1, 10])
				.on('zoom', function () {
					if (oldScale !== d3.event.scale) {
						var scale = oldScale / d3.event.scale;
						oldScale = d3.event.scale;
						viewBox_x = curPos_x - scale * (curPos_x - viewBox_x);
						viewBox_y = curPos_y - scale * (curPos_y - viewBox_y);
						svg.attr("viewBox", viewBox_x + " " + viewBox_y + " " + width / oldScale + " " + height / oldScale);
					}
				})
		);
	
	svg.on("mousedown", function () {
		isMouseDown = true;
		mousePos_x = d3.mouse(this)[0];
		mousePos_y = d3.mouse(this)[1];
	});
	
	svg.on("mouseup", function () {
		isMouseDown = false;
		viewBox_x = viewBox_x - d3.mouse(this)[0] + mousePos_x;
		viewBox_y = viewBox_y - d3.mouse(this)[1] + mousePos_y;
		svg.attr("viewBox", viewBox_x + " " + viewBox_y + " " + width / oldScale + " " + height / oldScale);
	});
	
	svg.on("mousemove", function () {
		curPos_x = d3.mouse(this)[0];
		curPos_y = d3.mouse(this)[1];
		if (isMouseDown) {
			viewBox_x = viewBox_x - d3.mouse(this)[0] + mousePos_x;
			viewBox_y = viewBox_y - d3.mouse(this)[1] + mousePos_y;
			svg.attr("viewBox", viewBox_x + " " + viewBox_y + " " + width / oldScale + " " + height / oldScale);
		}
	});
	// build the arrow.
	svg.append("svg:defs")    // Different link/path types can be defined here
		.selectAll("marker")
		.data(["end"])
		.enter()
		.append("svg:marker") // This section adds in the arrows
		.attr("id", String)
		.attr("viewBox", "0 -5 10 10")
		.attr("refX", 15)
		.attr("refY", -1.5)
		.attr("markerWidth", 6)
		.attr("markerHeight", 6)
		.attr("orient", "auto")
		.append("svg:path")
		.attr("d", "M0,-5L10,0L0,5");
	
	// add the links and the arrows
	var path = svg.append("svg:g")
		.selectAll("path")
		.data(force.links())
		.enter()
		.append("svg:path")
		//    .attr("class", function(d) { return "link " + d.type; })
		.attr("class", "link")
		.attr("marker-end", "url(#end)");
	
	// define the nodes
	force.drag()
		.on('dragstart', function (d) {
			d3.event.sourceEvent.stopPropagation();
		});
	
	var node = svg.selectAll(".node")
		.data(force.nodes())
		.enter()
		.append("g")
		.attr("class", "node")
		.call(force.drag);
	
	node.on("click", function (d) {
		if (d3.event.defaultPrevented) {
			return;
		}
	});
	
	var color = d3.scale.category20();
	// add the nodes
	node.append("circle")
		.attr("r", 8)
		.style('fill', function (d, i) {
			return color(i)
		});
	
	// add the text
	node.append("text")
		.attr("x", 12)
		.attr("dy", ".35em")
		.style('cursor', 'pointer')
		.on('click', function () {
			//  todo: callback(val)
			showSingleDetails(this.innerHTML);
		})
		.text(function (d) {
			return d.name;
		});
	
	// add the curvy lines
	function tick() {
		path.attr("d", function (d) {
			var dx = d.target.x - d.source.x,
				dy = d.target.y - d.source.y,
				dr = Math.sqrt(dx * dx + dy * dy);
			return "M" + d.source.x + "," + d.source.y + "A" + dr + "," + dr + " 0 0,1 " + d.target.x + "," + d.target.y;
		});
		
		node.attr("transform", function (d) {
			return "translate(" + d.x + "," + d.y + ")";
		});
	}
	
}

//  tables render
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
	$(dataTbody).append('<tr><td>---</td><td>---</td><td>---</td><td>---</td></tr>');
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

$.ajax({
	type: 'GET',
	dataType: 'JSON',
	data: {
		'proj_id': $('h1').data('projid')
	},
	url: '/user/graphic/get_excels_results',
	success: function (data) {
		globalData = data;  //  for table shows
		links = jsonParse(data);  //  for svg shows
		render(links);
		showAllDetails();
	}
});

