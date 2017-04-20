$(function () {
	function toTimestamp(ori) {
		return Math.round((new Date(ori)).getTime() / 1000);
	}
	
	$('.input-datedropper').dateDropper();
	$('#search').click(function () {
		//  form data collection
		var startDate = document.getElementsByName('startDate');
		var endDate = document.getElementsByName('endDate');
		$(startDate).val(toTimestamp($('#startDate').val()));
		$(endDate).val(toTimestamp($('#endDate').val()));
		//  test time
		console.log($(startDate).val());
		console.log($(endDate).val());
		//  submit
		setTimeout(function () {
			$('#query-conditions').submit();
		}, 500);
	});
});
