var X = XLSX;
var XW = {
	/* worker message */
	msg: 'xlsx',
	/* worker scripts */
	rABS: '/assets/3rd/xlsx/xlsxworker2.js',
	norABS: '/assets/3rd/xlsx/xlsxworker1.js',
	noxfer: '/assets/3rd/xlsx/xlsxworker.js'
};

var rABS = typeof FileReader !== "undefined" &&
	typeof FileReader.prototype !== "undefined" &&
	typeof FileReader.prototype.readAsBinaryString !== "undefined";
var use_worker = typeof Worker !== 'undefined';
var transferable = use_worker;

var wtf_mode = false;

function fixdata(data) {
	var o = "", l = 0, w = 10240;
	for (; l < data.byteLength / w; ++l) o += String.fromCharCode.apply(null, new Uint8Array(data.slice(l * w, l * w + w)));
	o += String.fromCharCode.apply(null, new Uint8Array(data.slice(l * w)));
	return o;
}

function ab2str(data) {
	var o = "", l = 0, w = 10240;
	for (; l < data.byteLength / w; ++l) o += String.fromCharCode.apply(null, new Uint16Array(data.slice(l * w, l * w + w)));
	o += String.fromCharCode.apply(null, new Uint16Array(data.slice(l * w)));
	return o;
}

function s2ab(s) {
	var b = new ArrayBuffer(s.length * 2), v = new Uint16Array(b);
	for (var i = 0; i != s.length; ++i) v[i] = s.charCodeAt(i);
	return [v, b];
}

function xw_noxfer(data, cb) {
	var worker = new Worker(XW.noxfer);
	worker.onmessage = function (e) {
		switch (e.data.t) {
			case 'ready':
				break;
			case 'e':
				console.error(e.data.d);
				break;
			case XW.msg:
				cb(JSON.parse(e.data.d));
				break;
		}
	};
	var arr = rABS ? data : btoa(fixdata(data));
	worker.postMessage({d: arr, b: rABS});
}

function xw_xfer(data, cb) {
	var worker = new Worker(rABS ? XW.rABS : XW.norABS);
	worker.onmessage = function (e) {
		switch (e.data.t) {
			case 'ready':
				break;
			case 'e':
				console.error(e.data.d);
				break;
			default:
				xx = ab2str(e.data).replace(/\n/g, "\\n").replace(/\r/g, "\\r");
				console.log("done");
				cb(JSON.parse(xx));
				break;
		}
	};
	if (rABS) {
		var val = s2ab(data);
		worker.postMessage(val[1], [val[1]]);
	} else {
		worker.postMessage(data, [data]);
	}
}

function xw(data, cb) {
	if (transferable) xw_xfer(data, cb);
	else xw_noxfer(data, cb);
}

function to_json(workbook) {
	var result = {};
	workbook.SheetNames.forEach(function (sheetName) {
		var roa = X.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
		if (roa.length > 0) {
			result[sheetName] = roa;
		}
	});
	return result;
}

//  处理输出问题
var global_wb;
var globalOutput;
function process_wb(wb) {
	global_wb = wb;
	globalOutput = JSON.stringify(to_json(wb), null, 2);
	
	if (typeof console !== 'undefined')
		console.log("output", new Date());
}

var drop = document.getElementById('drop');
function handleDrop(e) {
	e.stopPropagation();
	e.preventDefault();
	var files = e.dataTransfer.files;
	var f = files[0];
	{
		var reader = new FileReader();
		var name = f.name;
		reader.onload = function (e) {
			if (typeof console !== 'undefined')
				console.log("onload", new Date(), rABS, use_worker);
			var data = e.target.result;
			if (use_worker) {
				xw(data, process_wb);
			} else {
				var wb;
				if (rABS) {
					wb = X.read(data, {type: 'binary'});
				} else {
					var arr = fixdata(data);
					wb = X.read(btoa(arr), {type: 'base64'});
				}
				process_wb(wb);
			}
			//  add file name
			$('.fullFileName').text(f.name);
			console.log("input tag: " + f.name);
		};
		if (rABS)
			reader.readAsBinaryString(f);
		else
			reader.readAsArrayBuffer(f);
	}
	console.log('drop handle done');
}

function handleDragover(e) {
	e.stopPropagation();
	e.preventDefault();
	e.dataTransfer.dropEffect = 'copy';
}

if (drop.addEventListener) {
	drop.addEventListener('dragenter', handleDragover, false);
	drop.addEventListener('dragover', handleDragover, false);
	drop.addEventListener('drop', handleDrop, false);
}

var xlf = document.getElementById('xlf');
function handleFile(e) {
	var files = e.target.files;
	var f = files[0];
	{
		var reader = new FileReader();
		var name = f.name;
		reader.onload = function (e) {
			if (typeof console !== 'undefined')
				console.log("onload", new Date(), rABS, use_worker);
			var data = e.target.result;
			if (use_worker) {
				xw(data, process_wb);
			} else {
				var wb;
				if (rABS) {
					wb = X.read(data, {type: 'binary'});
				} else {
					var arr = fixdata(data);
					wb = X.read(btoa(arr), {type: 'base64'});
				}
				process_wb(wb);
			}
			//  add file name
			$('.fullFileName').text(f.name);
			console.log("drop tag: " + f.name);
		};
		if (rABS)
			reader.readAsBinaryString(f);
		else
			reader.readAsArrayBuffer(f);
	}
}

if (xlf.addEventListener)
	xlf.addEventListener('change', handleFile, false);

document.querySelector('#db_insert').addEventListener('click', function () {
	var out = document.querySelector('#out');
	if (out.innerText === undefined)
		out.textContent = globalOutput;
	else
		out.innerText = globalOutput;
}, false);

//  output
// console.log(globalOutput);

//  表单提交
//  添加表单数据

$('#form-submit').click(function () {
	$('#msg').empty();
	var tables = '';
	var tmp = JSON.parse(globalOutput);
	for (var i in tmp) {
		tables = tmp[i];
	}
	$('#table').val(JSON.stringify(tables));
	$.ajax({
		type: "POST",
		url: '/user/upexcel/excel_create',
		data: $('#form-upload').serialize(),
		async: false,
		success: function (data) {
			$('#msg').text('入库成功');
			setTimeout(function () {
				$('#msg').empty();
			}, 800);
		},
		error: function (data) {
			$('#msg').text('操作失败, 请重试');
			setTimeout(function () {
				$('#msg').empty();
			}, 800);
		}
	});
	globalOutput = ''; //重置
	$('.fullFileName').empty();
});
