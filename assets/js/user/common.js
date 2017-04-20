$('#nav-toggle').click(function(e) {
	e.preventDefault();
	var divLeft = $('#nav-left');
	var divMain = $('#main');
	if($(this).text().search('隐藏') != -1) {
		$(this).text('显示侧边栏');
	} else {
		$(this).text('隐藏侧边栏');
	}
	if(divMain.hasClass('col-sm-10')) {
		divMain.removeClass('col-sm-10').addClass('col-sm-12');
		divLeft.hide();
	} else {
		divMain.removeClass('col-sm-12').addClass('col-sm-10');
		divLeft.show();
	}
});