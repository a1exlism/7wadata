$(function () {
	
	$('#nav-toggle').click(function (e) {
		e.preventDefault();
		var divLeft = $('#nav-left');
		var divMain = $('#main');
		if ($(this).text().search('隐藏') != -1) {
			$(this).text('显示侧边栏');
		} else {
			$(this).text('隐藏侧边栏');
		}
		if (divMain.hasClass('col-sm-10')) {
			divMain.removeClass('col-sm-10').addClass('col-sm-12');
			divLeft.hide();
		} else {
			divMain.removeClass('col-sm-12').addClass('col-sm-10');
			divLeft.show();
		}
		//  header active
	});
	var tagName = /user\/(.*)((\/project\/)?.*$)/.exec(window.location.href)[1].split('/')[0];
	var headerLi = $('#header-tags > li');
	headerLi.each(function (index) {
		if (new RegExp(tagName).test($(this).children().attr('href'))) {
			$(this).addClass('active');
		}
	});
});
