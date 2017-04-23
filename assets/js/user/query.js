var globalVal;
$(function () {
	
	function toTimestamp(ori) {
		return Math.round((new Date(ori)).getTime() / 1000);
	}
	
	function toMdy(date) {
		var year = date.getFullYear();
		var month = (1 + date.getMonth()).toString();
		month = month.length > 1 ? month : '0' + month;
		var day = date.getDate().toString();
		day = day.length > 1 ? day : '0' + day;
		return month + '/' + day + '/' + year;
	}
	
	function colorActive(i) {
		var paginationGrp = $('#pagination-grp');
		paginationGrp.find('li').removeClass();
		$(i).addClass('active');
	}
	
	$('#reset').click(function () {
		setTimeout(function () {
			var st = toMdy(new Date(3150720));
			var nt = toMdy(new Date());
			// console.log(st);
			// console.log(nt);
			$('#startDate').val(st);
			$('#endDate').val(nt);
		}, 50);
	});
	
	//  jquery plugin date-dropper
	$('.input-datedropper').dateDropper();
	
	//  table_header creator start
	var table_header = {
		'type': '类型',
		'city': '城市/地区',
		'qq': 'QQ',
		'weixin': '微信',
		'mobile': '手机',
		'phone': '电话',
		'real_name': '姓名',
		'id_card': '身份证',
		'content': '内容',
		'source_url': '源地址',
		'gmt_create': '创建时间',
		'gmt_modify': '修改时间'
	};
	
	function theadCreate() {
		var i = 0;
		var tr = $('<tr></tr>');
		for (i in table_header) {
			tr.append($('<th>' + table_header[i] + '</th>'));
		}
		$('thead').append(tr);
	}
	
	//  table_header creator end
	
	//  query arr start
	var startDate = document.querySelector('#startDate');
	var endDate = document.querySelector('#endDate');
	var location = document.querySelector('#location');
	var qq = document.querySelector('#qq');
	var wechat = document.querySelector('#wechat');
	var searchType = document.querySelector('#search-type');
	var keyword = document.querySelector('#keyword');
	
	var queryArr = {
		'startDate': toTimestamp(startDate.value),
		'endDate': toTimestamp(endDate.value),
		'location': location.value,
		'qq': qq.value,
		'wechat': wechat.value,
		'search-type': searchType.value,
		'keyword': keyword.value
	};
	//  query arr end
	
	//  searchBy offset
	function searchBy(offsetPage) {
		$.ajax({
			type: 'POST',
			url: '/user/query/search/' + offsetPage,
			data: queryArr,
			dataType: 'JSON',
			success: function (data) {
				if (data) {
					var tbody = $('tbody');
					$(tbody).empty();
					for (var i in data) {
						var singleRow = data[i];
						var tr = $('<tr></tr>');
						for (var j in table_header) {
							$(tr).append($('<td>' + singleRow[j] + '</td>'));
						}
						$(tbody).append(tr);
					}
				}
			}
		})
	}
	
	$('#search').click(function () {
		//  form data collection
		
		//  1. Generate pagination group
		var perPage = 15;
		var pages = 1;
		var pageGrp = $('#pagination-grp');
		$.ajax({
			type: 'POST',
			url: '/user/query/get_search_nums',
			data: queryArr,
			dataType: 'JSON',
			success: function (data) {
				if (data) {
					//  create  tag
					$(pageGrp).empty();
					pages = Math.ceil(data.nums / perPage);
					
					for (var i = 0; i < pages; i++) {
						(function (i) {
							var tagA = $('<a href="#">' + (i + 1) + '</a>');
							var tagLi = $('<li></li>');
							
							if(i == 0) {
								$(tagLi).addClass('active');
							}
							tagA.click(function () {
								searchBy(i);
							});
							$(tagLi).append($(tagA));
							$(tagLi).click(function () {
								colorActive(this);
							});
							$(pageGrp).append(tagLi);
						})(i);
					}
				}
			}
		});
		
		//  2. create thead
		if ($('thead').find('tr').length == 0) {
			theadCreate();
		}
		
		//  3. Generate result doms
		searchBy(0);
		
	});
	
	
});
