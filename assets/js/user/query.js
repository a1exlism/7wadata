$(function () {
	function toTimestamp(ori) {
		return Math.round((new Date(ori)).getTime() / 1000);
	}
	
	var startDate = document.getElementsByName('startDate');
	var endDate = document.getElementsByName('endDate');
	$('.input-datedropper').dateDropper();
	$('#search').click(function () {
		//  form data collection
		$(startDate).val(toTimestamp($('#startDate').val()));
		$(endDate).val(toTimestamp($('#endDate').val()));
		//  test time
		// console.log($(startDate).val());
		// console.log($(endDate).val());
		//  submit
		setTimeout(function () {
			$('#query-conditions').submit();
		}, 500);
	});
	function toMdy(date) {
		var year = date.getFullYear();
		var month = (1 + date.getMonth()).toString();
		month = month.length > 1 ? month : '0' + month;
		var day = date.getDate().toString();
		day = day.length > 1 ? day : '0' + day;
		return month + '/' + day + '/' + year;
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
});
