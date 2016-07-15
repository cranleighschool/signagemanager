
<!DOCTYPE html>
<html>
<head>

<?php include('functions.php'); ?>
<?php include('conn.php'); ?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css" />
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="cranfont/style.css" />	
	<link rel="stylesheet" href="style.css" />
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
<title>Digital Signage Manager</title>
	
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
					<li class="active"><a  href="signagemanager.php">Home</a></li>				
					<li class="dropdown ">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage Screen<span class="caret"></span></a>
							<ul class="dropdown-menu">	
																	<li><a href="screenmanager.php?id=1">Dining Hall Screen</a></li>
									
																		<li><a href="screenmanager.php?id=2">Music Screen</a></li>
									
																		<li><a href="screenmanager.php?id=3">History Screen</a></li>
									
																		<li><a href="screenmanager.php?id=5">Art Screen 1</a></li>
									
																		<li><a href="screenmanager.php?id=6">Art Screen 2</a></li>
									
																	<li class="divider"></li>
								<li><a href="addscreen.php">Add Screen</a></li>
							</ul>
					</li>
					<li class="dropdown ">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Preview Screen<span class="caret"></span></a>
							<ul class="dropdown-menu">
																	<li><a href="previewscreen.php?screenName=1">Dining Hall Screen</a></li>
									
																		<li><a href="previewscreen.php?screenName=2">Music Screen</a></li>
									
																		<li><a href="previewscreen.php?screenName=3">History Screen</a></li>
									
																		<li><a href="previewscreen.php?screenName=5">Art Screen 1</a></li>
									
																		<li><a href="previewscreen.php?screenName=6">Art Screen 2</a></li>
									
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
	
	
	
	<?php 
	$id = 32;
	$screenInfo = fnglobalquery($PDO, '*', 'screens', 'id', $id, 1, 1, 1, 1, 'id', 'ASC');
	var_dump($screenInfo);
	$screenName = $screenInfo[0]['screenName'];
$screenID = $screenInfo[0]['id'];
$action = 'Deleted Screen' . $screenName . ' / Screen ID = ' . $screenID;
echo $action;
	?>
	
	
	
	
	
	
	
	
	
	
		</div>
		
		
		
	<script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>	
	
</body>