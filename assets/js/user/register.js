$(function () {
	$('#btn_submit').click(function () {
		var username = $('#username').val();
		var password = $('#password').val();
		var repassword = $('#repassword').val();
		$('#msg_success').empty();
		$('#msg_error').empty();
		if (password != repassword) {
			$('form').addClass('error');
			$('#msg_error').append('<span>两次密码输入不一致</span>');
		} else {
			$.ajax({
				type: 'POST',
				url: '/user/register/regi_check',
				data: {
					username: username,
					password: password
				},
				dataType: 'json',
				success: function (data) {
					if (data && data.statusCode == 1) {
						$('form').addClass('success');
						$('#msg_success').append('<span>注册成功</span>');
						setTimeout(function () {
							window.location.replace('/user/login');
						}, 200);
					} else {
						$('form').addClass('error');
						$('#msg_error').append('<span>' + data.errMsg + '</span>');
					}
				}
			});
		}
	});
});