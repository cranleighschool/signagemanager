
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css" />
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="cranfont/style.css" />	
	<link rel="stylesheet" href="style.css" />
	
	
	<?php // $screens = fnscreens($PDO, $_SESSION['user']['username'], 'testteacher'); ?>
	<?php 
			$screens = fnnewscreens($PDO, $_SESSION['user']['username']); 
			$isadmin = fnisadmin($PDO,  $_SESSION['user']['username']);
	?>
	
	<?php
		if(isset($_SESSION['errors']['error5301'])){ ?>
			<!-- THIS IS NOW SET TJB -->
			<script type="text/javascript">
				alert('<?php echo $_SESSION['errors']['error5301']; ?>');
			</script>
<?php } else { echo ' <!-- Dont Worry be happy -->'; } ?>
	
	
	<!-- TEST TEACHER IS SET AS THE ADMIN ACCOUNT ABOVE -->
	<!-- Navigation -->
   <nav class="navbar navbar-default navbar-fixed-top" style="border-bottom: 1px solid #0C223F;">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="signagemanager.php"><i class="cranfont cranfont-logo"></i> Digital Signage Manager</a>
			</div>
			
				<div id="navbar" class="navbar-collapse collapse">
						
				<ul class="nav navbar-nav">
					<li><a href="#menu-toggle" id="menu-toggle" onClick="setPadding()"><i class="fa fa-bars"></i></a></li>
					<li class="<?php fnactivepage2('signagemanager.php') ?>"><a  href="index.php">Home</a></li>				
					<li class="dropdown <?php fnactivepage2('screenmanager.php'); fnactivepage2('addscreen.php'); ?>">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage Slides<span class="caret"></span></a>
							<ul class="dropdown-menu">	
								<?php foreach($screens as $navscreens) {
									?>
									<li><a href="screenmanager.php?id=<?php echo htmlspecialchars($navscreens['id'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($navscreens['screenName'], ENT_QUOTES); ?></a></li>
									
									<?php
								} ?>
								<li class="divider"></li>
								<li><a href="addscreen.php">Add Screen</a></li>
							</ul>
					</li>
					<li class="dropdown <?php fnactivepage2('previewscreen.php') ?>">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Preview Screen<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<?php foreach($screens as $navscreens) {
									?>
									<li><a href="previewscreen.php?screenName=<?php echo htmlspecialchars($navscreens['id'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($navscreens['screenName'], ENT_QUOTES); ?></a></li>
									
									<?php
								} ?>
							</ul>
					</li>
					
					<li class="<?php fnactivepage2('gallery.php'); ?>"><a href="gallery.php">Gallery</a></li>
					
					<li class="dropdown <?php fnactivepage2('about.php'); fnactivepage2('userguide.php'); fnactivepage2('requestfeature.php'); ?>">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Support<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="about.php">About</a></li>
								<li><a href="userguide.php">User Guide</a></li>
								<li><a href="https://help.cranleigh.org">Submit Ticket</a></li>
								<li><a href="requestfeature.php">Request Feature</a></li>
							</ul>
					</li>
				<!--ADMIN MENU / IF ADMIN -->
					<?php 
						if ($isadmin == 'true') {
							?>
					<li class="dropdown <?php fnactivepage2('permissions.php'); fnactivepage2('log.php'); ?>">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="permissions.php">Access / Permissions</a></li>	
								<li><a href="log.php">Log</a></li>
							</ul>
					</li>
							
							<?php
						}
						?>
					
				<!--END OF ADMIN MENU -->
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
					<li><a href="?logout">Sign Out (<?php echo htmlspecialchars(strtoupper($_SESSION['user']['username']), ENT_QUOTES); ?>) <i class="fa fa-fw fa-sign-out"></i></a></li>
					<li style="padding-top: 8px;">
					

					</li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>

 ?>