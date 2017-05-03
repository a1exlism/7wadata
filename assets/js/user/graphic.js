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
		.charge(-800)
		.on("tick", tick).start();
	
	var svg = d3.select("#graph")
		.append("svg:svg")
		.attr("width", width)
		.attr("height", height)
		.style('cursor', 'move')
		.append('svg:g')
		.call(d3.behavior.zoom()
			.scaleExtent([0.1, 10])
			.on('zoom', redraw)
		);
	
	svg.append('svg:rect')
		.attr('width', width)
		.attr('height', height)
		.style("fill", "none")
		.style("pointer-events", "all");
	
	var vis = svg.append('svg:g');
	
	function redraw() {
		vis.attr('transform',
			'translate(' + d3.event.translate + ')' +
			' scale(' + d3.event.scale + ')');
	}
	
	// build the arrow.
	vis.append("svg:defs")    // Different link/path types can be defined here
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
	var path = vis.append("svg:g")
		.selectAll("path")
		.data(force.links())
		.enter()
		.append("svg:path")
		.attr("class", "link")
		.attr("marker-end", "url(#end)");
	
	//  node drag start && highlight
	var nodeDrag = d3.behavior.drag()
		.origin(function (d) {
			return d;
		})
		.on("dragstart", dragstarted)
		.on("drag", dragged)
		.on("dragend", dragended);
	
	var node = vis.selectAll(".node")
		.data(force.nodes())
		.enter()
		.append("g")
		.attr("class", "node")
		.call(nodeDrag);
	
	var linkedByIndex = {};
	links.forEach(function (d) {
		linkedByIndex[d.source.index + "," + d.target.index] = 1;
	});
	
	function isConnected(a, b) {
		return linkedByIndex[a.index + "," + b.index] || linkedByIndex[b.index + "," + a.index];
	}
	
	node.on("mouseover", function (d) {
		
		node.classed("node-active", function (o) {
			thisOpacity = isConnected(d, o) ? true : false;
			this.setAttribute('fill-opacity', thisOpacity);
			return thisOpacity;
		});
		
		path.classed("link-active", function (o) {
			return o.source === d || o.target === d ? true : false;
		});
		
		d3.select(this).classed("node-active", true);
		d3.select(this).select("circle").transition()
			.duration(200)
			.attr("r", d.weight * 2 + 8);
	})
		.on("mouseout", function (d) {
			
			node.classed("node-active", false);
			path.classed("link-active", false);
			
			d3.select(this).select("circle").transition()
				.duration(200)
				.attr("r", 8);
		});
	
	
	function dragstarted(d) {
		d.fixed = false;
		d3.event.sourceEvent.stopPropagation();
		
		d3.select(this)
			.classed("dragging", true);
		force.start();
	}
	
	function dragged(d) {
		
		d3.select(this)
			.attr("cx", d.x = d3.event.x)
			.attr("cy", d.y = d3.event.y);
		
	}
	
	function dragended(d) {
		d.fixed = true;
		d3.select(this)
			.classed("dragging", false);
	}
	
	//  node drag end
	
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
