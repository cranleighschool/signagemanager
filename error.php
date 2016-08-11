<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
<?php 
	include('conn.php');
	include('head.php');
	include('functions.php');

	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'theOrder', 'ASC');	
	$error = $_REQUEST['error'];
	
	if($error == 'error-filenotset') {
		$errorResult = 'The image you have selected is too large.';
	} else {
		if($error == 'error-returnUrl') {
			$errorResult = 'Fatal Error, please contact Support from the menu above if this continues to happen.';
		} else {
		if($error == 'error-returnUrlName') {
			$errorResult = 'Fatal Error, please contact Support from the menu above if this continues to happen.';
		} else {
		if($error == 'error-returnUrlTemplate') {
			$errorResult = 'Fatal Error, please contact Support from the menu above if this continues to happen.';
		} else {
		if($error == 'error-notanimage') {
			$errorResult = 'The image you have selected is not a valid image type';
		}  else {
		if($error == 'error-fileexists') {
			$errorResult = 'The image you have selected already exists. If it is a different file please rename it.';
		} else {
		if($error == 'error-filetoolarge') {
			$errorResult = 'The image you have selected is too large. Please resize it, for instructions please follow this <a href="userguide.php?subject=resizeimage">guide</a>.';
		} else {
		if($error == 'error-error') {
			$errorResult = 'Fatal Error, please contact Support from the menu above if this continues to happen.';
		} else {
		if($error == 'error-notvalid') {
			$errorResult = 'The image you have selected is not valid. It may be too large. You could try resizing it or saving it a in another format, for instructions please follow these <a href="userguide.php">guides</a>.';
		}
	}
	}}}}}
	}}

?>

<title>Error</title>
	

	
</head>

<body>
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
				<a class="navbar-brand" href="index.php"><i class="cranfont cranfont-logo"></i> Digital Signage Manager</a>
			</div>
			
				<div id="navbar" class="navbar-collapse collapse">
						
				<ul class="nav navbar-nav">
					<li><a href="#menu-toggle" id="menu-toggle" onClick="setPadding()"><i class="fa fa-bars"></i></a></li>
					<li><a  href="index.php">Home</a></li>				
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage Screen<span class="caret"></span></a>
							<ul class="dropdown-menu">	
								<?php foreach($screens as $navscreens) {
									?>
									<li><a href="screenmanager.php?id=<?php echo $navscreens['id']; ?>"><?php echo $navscreens['screenName']; ?></a></li>
									
									<?php
								} ?>
								<li class="divider"></li>
								<li><a href="addscreen.php">Add Screen</a></li>
							</ul>
					</li>
					<li class="dropdown ">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Preview Screen<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<?php foreach($screens as $navscreens) {
									?>
									<li><a href="previewscreen.php?screenName=<?php echo $navscreens['id']; ?>"><?php echo $navscreens['screenName']; ?></a></li>
									
									<?php
								} ?>
							</ul>
					</li>
					
					<li class="active"><a href="gallery.php">Gallery</a></li>
					
					<li class="dropdown ">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Support<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="about.php">About</a></li>
								<li><a href="userguide.php">User Guide</a></li>
								<li><a href="https://help.cranleigh.org">Submit Ticket</a></li>
								<li><a href="requestfeature.php">Request Feature</a></li>
							</ul>
					</li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
					<li><a href="?logout">Sign Out (TJB) <i class="fa fa-fw fa-sign-out"></i></a></li>
					<li style="padding-top: 8px;">
					

					</li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	
	
	<div class="container tjb_container">
	<?php if(isset($alert)){ echo $alert; } ?>
	<div class="page_title">
		<h1>Error</h1>
	</div>

	<?php
	
		echo $errorResult;
	?>

	
</body>


</html>