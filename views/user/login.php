<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login | 7wadata</title>
	<link rel="stylesheet" type="text/css" href="/assets/3rd/semantic/dist/semantic.min.css">
	<style type="text/css">
		
		
		.vertical-center {
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
<div class="ui container center aligned vertical-center">
	<div class="ui centered three column doubling stackable grid container">
		<div class="column center aligned">
			<h2 class="ui teal image header">
				<img src="/assets/imgs/logo.png" class="image">
				<div class="content">
					用户登录
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
					<button type="button" id="btn_submit" class="ui fluid large teal submit button">登录</button>
				</div>
				<div id="msg_success" class="ui success message"></div>
				<div id="msg_error" class="ui error message"></div>
				<div class="ui message">
					<p>加入我们=> <a href="/user/register">注册</a></p>
				</div>
			</form>
		</div>
	</div>

</div>
<script src="/assets/3rd/jquery.min.js"></script>
<script src="/assets/3rd/semantic/dist/semantic.min.js"></script>
<script src="/assets/js/user/login.js"></script>
</body>
</html>