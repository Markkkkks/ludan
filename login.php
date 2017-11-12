<!DOCTYPE html>
<head>
	<title>欢迎登录卤蛋系统</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
	<link href="css/templatemo_style.css" rel="stylesheet" type="text/css">	
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<script type="text/javascript" src="js/Ajax.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
 	<script type="text/javascript" src="js/loginCheck.js"></script>

</head>
<body class="templatemo-bg-gray">
	<div class="container">
		<div class="col-md-12" id="loginForm">
			<div class="margin-bottom-15" align="center"><img src="img/logo_blue.png"></div>
			<form class="form-horizontal templatemo-container templatemo-login-form-1 margin-bottom-30" role="form" method="post">
		        <div class="form-group">
		          <div class="col-xs-12">		            
		            <div class="control-wrapper">
		            	<label for="username" class="control-label fa-label"><i class="fa fa-user fa-medium"></i></label>
		            	<input type="text" class="form-control" id="username" name="username" placeholder="Username">
		            </div>		            	            
		          </div>              
		        </div>
		        <div class="form-group">
		          <div class="col-md-12">
		          	<div class="control-wrapper">
		            	<label for="password" class="control-label fa-label"><i class="fa fa-lock fa-medium"></i></label>
		            	<input type="password" class="form-control" id="password" name="password" placeholder="Password">
		            </div>
		          </div>
		        </div>
		        <div class="form-group">
		          <div class="col-md-12">
		          	<label class="error" for="username" id="name_error"><p>用户名不能为空</p></label> 
		          	<label class="error" for="password" id="password_error"><p>密码不能为空</p></label> 
		          	<div class="control-wrapper" id="loginsubmit">
		          		<input type="submit" value="登录" class="button btn btn-info" name="submit">
		          	</div>
		          </div>
		          <div id="info"></div>
		        </div>
		      </form>
		</div>
	</div>
</body>
</html>