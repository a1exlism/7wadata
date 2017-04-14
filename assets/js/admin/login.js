$(function () {
	$('#btn_submit').click(function () {
		var username = $('#username').val();
		var password = $('#password').val();
		$.ajax({
			type: 'POST',
			url: '/admin/login/login_check',
			data: {
				username: username,
				password: password
			},
			dataType: 'json',
			success: function (data) {
				console.log(data.statusCode);
				if (data && data.statusCode == 1) {
					$('form').addClass('success');
					$('#msg_success').append('<span>登录成功</span>');
					setTimeout(function () {
						window.location.replace('/admin/manager');
					}, 300);
				} else {
					$('form').addClass('error');
					$('#msg_error').append('<span>登录失败,请重试</span>');
				}
			}
			// ,
			// error: function (XMLHttpRequest, textStatus, errorThrown) {
			// 	alert(XMLHttpRequest.status);
			// 	alert(XMLHttpRequest.readyState);
			// 	alert(textStatus);
			// }
		})
	})
	
});
