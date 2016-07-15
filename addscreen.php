	<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
<?php 
	include('head.php');
	include('conn.php');
	include('functions.php');
	
	$screens = fnglobalquery($PDO, '*', 'screens', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	
	

?>

<title>Add Screen</title>
	
	<style>
	</style>
	
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
				<a class="navbar-brand" href="signagemanager.php"><i class="cranfont cranfont-logo"></i> Digital Signage Manager</a>
			</div>
			
				<div id="navbar" class="navbar-collapse collapse">
						
				<ul class="nav navbar-nav">
					<li><a href="#menu-toggle" id="menu-toggle" onClick="setPadding()"><i class="fa fa-bars"></i></a></li>
					<li><a  href="signagemanager.php">Home</a></li>				
					<li class="dropdown active">
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
					
					<li class=""><a href="gallery.php">Gallery</a></li>
					
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
	<div class="page_title">
		<h1>Add New Screen</h1>
	</div>
		
		<form name="addsnewscreen" action="insertscreen.php" method="post">
			
			<div class="col-sm-6">
			
				<div class="form-group">
					<label for="screenName">Screen Name</label>
					<input type="text" class="form-control" id="screenName" name="screenName"/>
				</div>
				
				<div class="form-group">
					<label for="slideDuration">Slide Duration (Seconds)</label>
					<input type="text" class="form-control" id="slideDuration" name="slideDuration" value="15"/>
				</div>
			<br />
				<button style="margin-top: 3px;" type="submit" class="btn">Update</button>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group">
					<label for="defaultTitle">Default Title</label>
					<input type="text" class="form-control" id="defaultTitle" name="defaultTitle"/>
				</div>
				
				<div class="form-group">
					<label for="defaultBackground">Default Background</label>
					<input type="text" class="form-control" id="defaultBackground" name="defaultBackground" value="background.jpg"/>
				</div>
				
				<div class="form-group">
					<label for="defaultTemplate">Default Template</label>
					<select type="text" class="form-control" id="defaultTemplate" name="defaultTemplate">
						<?php foreach($templates as $templatelist) {
						?>
						<option value="<?php echo $templatelist['className']; ?>"><?php echo $templatelist['name']; ?></option>
						<?php
						} ?>
					</select>
				</div>
			</div>
		</form>
	</div>
	<?php include('footer.php'); ;?>
		
		


	
	</body>
	<script> 
	document.editscreenform.lineHeight.oninput = function(){
    document.editscreenform.lineHeightOutid.value = document.editscreenform.lineHeight.value;
 }	 
	document.editscreenform.fontSize.oninput = function(){
    document.editscreenform.fontSizeOutid.value = document.editscreenform.fontSize.value;
 }
 </script>

	</html>