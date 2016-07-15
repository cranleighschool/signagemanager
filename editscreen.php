<!DOCTYPE html>
<html>
<head>

<?php 
	include('head.php');
	include('conn.php');
	include('functions.php');
	if(!isset($_REQUEST['id'])) {
		$id = 1;
	} else {
		$id = $_REQUEST['id'];
	}
	
	$screen = fnglobalquery($PDO, '*', 'screens', 'id', $id, 1, 1, 1, 1, 'id', 'ASC');
	$screens = fnglobalquery($PDO, '*', 'screens', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$tableName = 'screen' . $id;
	$slides = fnglobalquery($PDO, '*', $tableName, 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$defaultTitle = $screen[0]['defaultTitle'];
?>

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
					<li><a  href="signagemanager.php">Home</a></li>				
					<li class="dropdown active">
						<a href="reporting.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage Screen<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<?php foreach($screens as $navscreens) {
									?>
									<li><a href="editscreen.php?id=<?php echo $navscreens['id']; ?>"><?php echo $navscreens['screenName']; ?></a></li>
									
									<?php
								} ?>
								
								
							</ul>
					</li>
					<li class="dropdown ">
						<a href="reporting.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Preview Screen<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="reporting.php">Dining Hall Screens</a></li>
								<li><a href="report_budget.php">History Screen</a></li>
								<li><a href="report_supplier.php">Music Screen</a></li>
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
	
	<h1><?php echo $screen[0]['screenName']; ?> - Slides</h1>
	<br />
	
	<div class="addnew">
		<a href="#">Add New Slide</a>
	</div>
	
		<div class="table-responsive">
			<table class="table text-center table-striped table-hover">
				<tr>
					<th class="text-center">Title</th>
					<th class="text-center">Picture</th>
					<th class="text-center">Message</th>
					<th class="text-center">Start Date</th>
					<th class="text-center">Start Time</th>
					<th class="text-center">End Date</th>
					<th class="text-center">End Time</th>
					<th class="text-center">Edit</th>
					<th class="text-center">Preview</th>
					<th class="text-center">Delete</th>
				</tr>
				<tr>
					<?php foreach($slides as $row) {
						?>
						<td><?php echo fncheckfortitle($row['title'], $defaultTitle); ?></td>
						<td><?php echo $row['picture']; ?></td>
						<td><?php echo $row['message']; ?></td>
						<td><?php echo $row['startDate']; ?></td>
						<td><?php echo $row['startTime']; ?></td>
						<td><?php echo $row['endDate']; ?></td>
						<td><?php echo $row['endTime']; ?></td>
						<td><a href="editslide.php?id=<?php echo $row['id']; ?>&screenName=<?php echo $id; ?>"><i class="fa fa-pencil-square-o"></i></a></td>
						<td><a href="previewslide.php?id=<?php echo $row['id']; ?>&screenName=<?php echo $id; ?>"><i class="fa fa-play-circle-o"></i></a></td>
						<td><a href="deleteslide.php?id=<?php echo $row['id']; ?>"><i class="fa fa-trash-o"></i></a></td>
						
					
					
				</tr>
					<?php
					} ?>
			</table>
		</div>
	

		

	
	
	
	

	<?php #var_dump($screenDetails); ?>
	</div>
	<?php include('footer.php'); ?>

	
	
	</body>
	</html>
	