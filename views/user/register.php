<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="/assets/3rd/semantic/dist/semantic.min.css">
	<style type="text/css">
		
		.vertical_center {
			position: relative;
			top: 50%;
			-webkit-transform: translateY(-50%);
			-ms-transform: translateY(-50%);
			transform: translateY(-50%);
		}
		
		form {
			height: 300px;
		}
	
	</style>

</head>
<body>
<div class="ui container center aligned vertical_center">
	<div class="ui centered three column grid">
		<div class="column center aligned">
			<h2 class="ui teal image header">
				<img src="/assets/imgs/logo.png" class="image">
				<div class="content">
					用户注册
				</div>
			</h2>
			<form class="ui large form">
				<div class="ui stacked segment">
					<div class="field">
						<div class="ui left icon input">
							<i class="user icon"></i>
							<input type="text" id="username" name="username" placeholder="帐号">
						</div>
					</div>
					<div class="field">
						<div class="ui left icon input">
							<i class="lock icon"></i>
							<input type="password" id="password" name="password" placeholder="密码">
						</div>
					</div>
					<div class="field">
						<div class="ui left icon input">
							<i class="lock icon"></i>
							<input type="password" id="repassword" name="repassword" placeholder="重复密码">
						</div>
					</div>
					<button type="button" id="btn_submit" class="ui fluid large teal submit button">注册</button>
				</div>
				<div id="msg_success" class="ui success message"></div>
				<div id="msg_error" class="ui error message"></div>
				<div class="ui message">
					<a href="/user/login">点此登录</a>
				</div>
			</form>
		</div>
	</div>

</div>
<script src="/assets/3rd/jquery.min.js"></script>
<script src="/assets/3rd/semantic/dist/semantic.min.js"></script>
<script src="/assets/js/user/register.js"></script>
</body>
</html>
