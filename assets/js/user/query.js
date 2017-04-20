$(function () {
	function toTimestamp(ori) {
		return Math.round((new Date(ori)).getTime() / 1000);
	}
	$('.input-datedropper').dateDropper();
	
});
