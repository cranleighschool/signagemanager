<?php
		require_once('conn.php');
		require_once('functions.php');
		if (isset($_POST['username'])) {
			if (isset($_POST['p'])) {
				fnlogin();
			}
		}
if ($_SESSION['user']['logged_in']===true) {
	header('Location:signagemanager.php');
}
?><!DOCTYPE html>
<html>
<head>
<?php
	require_once 'head.php'; 
?>
</head>
<body>
	<div class="container">
		
		<div class="row">
		
			<div class="col-md-4">
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
                                <input type="submit" class="btn btn-sm btn-success" value="Login" />
                            </fieldset>
                        </form>
                    </div>
                </div>
</div>
			
		</div>
		
		
	</div>
	
</body>

</html>