$(function () {
	$('#btn_submit').click(function () {
		var username = $('#username').val();
		var password = $('#password').val();
		$('#msg_success').empty();
		$('#msg_error').empty();
		$.ajax({
			type: 'POST',
			url: '/admin/login/login_check',
			data: {
				username: username,
				password: password
			},
			dataType: 'json',
			success: function (data) {
				if (data && data.statusCode == 1) {
					$('form').addClass('success');
					$('#msg_success').append('<span>登录成功</span>');
					setTimeout(function () {
						window.location.replace('/admin/manager');
					}, 200);
				} else {
					$('form').addClass('error');
					$('#msg_error').append('<span>登录失败,请重试</span>');
				}
			}
		})
	})
});
