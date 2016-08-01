<?php
		require_once('conn.php');
		require_once('functions.php');
		
		if (isset($_POST['username'])) {
			if (isset($_POST['p'])) {
				fnlogin();
			}
		}
if (isset($_SESSION['user']['logged_in']) && $_SESSION['user']['logged_in']===true) {
	header('Location:signagemanager.php');
}
?><!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css" />
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="cranfont/style.css" />	
	<link rel="stylesheet" href="style.css" />

	
<style>
.testee {
	width: 800px;
	height: 600px;
	background-image: url(images/intro_image.jpg);
	background-position: center;
	background-repeat: no;
	margin: 0 auto;
	margin-top: 100px;
}



</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="testee">	
				<div class="col-md-6 col-md-offset-3" style="padding-top: 175px;">
					<div class="login-panel panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Sign In</h3>
						</div>
						<div class="panel-body">
							<form role="form" method="post">
								<fieldset>
									<div class="form-group">
										<input class="form-control" placeholder="User Name" name="username" type="text" autofocus="">
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Password" name="p" type="password" value="">
									</div>
									<div class="checkbox">
										<label>
											<input name="remember" type="checkbox" value="Remember Me">Remember Me
										</label>
									</div>
									<!-- Change this to a button or input when using this as a form -->
									<input type="submit" class="btn " value="LOGIN" />
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</body>

</html>