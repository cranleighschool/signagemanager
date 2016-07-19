<?php
	require_once('conn.php');
	require_once('functions.php');
?><!DOCTYPE html>
<html>
<head>
<?php 
	include('head.php');

		if(empty($_REQUEST['alert'])) {
			//
	} else {
		$alert = $_REQUEST['alert'];
	}
?>

<title>Digital Signage Manager</title>
	
	<style>
	</style>
	
</head>

<body>
	
	<div class="container tjb_container">
		<?php if(isset($alert)){ echo $alert; } ?>
	<div class="addnew">
		<a href="addscreen.php">Add New Screen</a>
	</div>
	
	<div class="page_title">
		<h1>Current Screens</h1>
	</div>
	
	<div class="screen_table">
			<div class="table-responsive screen_table">
				<table class="table text-center table-striped table-hover">
					<tr>
						<th class="text-center">Screen Name</th>
						<th class="text-center">Owner</th>
						<th class="text-center">Default Title</th>
						<th class="text-center">Slide Duration</th>
						<th class="text-center">Active Slides</th>
						<th class="text-center">Edit Screen Settings</th>
						<th class="text-center">Manage Slides</th>
						<th class="text-center">Preview</th>
						<th class="text-center">Delete</th>
					</tr>
					<tr>
						<?php foreach($screens as $row) {
							$screenName = 'screen' . $row['id'];
							?>
							<td><?php echo $row['screenName']; ?></td>
							<td><?php echo strtoupper($row['owner']); ?></td>
							<td><?php echo $row['defaultTitle']; ?></td>
							<td><?php echo $row['slideDuration']; ?>s</td>
							<td><?php echo fncountactiveslides($PDO, $screenName); ?></td>
							<td><a href="managescreen.php?id=<?php echo $row['id']; ?>"><i class="fa fa-pencil-square-o"></i></a></td>
							<td><a href="screenmanager.php?id=<?php echo $row['id']; ?>"><i class="fa fa-th-list"></i></a></td>
							<td><a href="previewscreen.php?screenName=<?php echo $row['id']; ?>"><i class="fa fa-play-circle-o"></i></a></td>
							<td><a href="deletescreen.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this Screen?')"><i class="fa fa-trash-o"></i></a></td>
					</tr>
						<?php } ?>
				</table>
			</div>
		</div>
	
	<div class="screen_titles_wrapper">
		<?php 
			foreach($screens as $tiles) {
			$tableName = 'screen' . $tiles['id'];
			?>
			
			<div class="col-sm-4 padbox">
				
				<div class="col-sm-12 screen-select  text-center">
				<a data-toggle="tooltip" title="Manage Slides" href="screenmanager.php?id=<?php echo $tiles['id']; ?>">
						<div class="screen_tile_name">
							<h1><?php echo strtoupper($tiles['screenName']); ?></h1>
						</div>
						
						<div class="screen-info-wrap">
							<h4>
							Active Slides: <?php echo fncountactiveslides($PDO, $tableName); ?><br /><br />
							Slide Duration: <?php echo $tiles['slideDuration']; ?>s
							</h4>
						</div>
						
						
					<div class="screen-thumbnail-wrap">
						<img class="img-responsive center-block" style="border: 0px solid black" src="images\flatscreen_image.jpg" />
						
					</div>
					</a>
				<div class="screen_icons_wrap">
					<div class="col-xs-3 screen_icons"><a data-toggle="tooltip" title="Edit Screen Settings" href="managescreen.php?id=<?php echo $tiles['id']; ?>"><i class="fa fa-pencil-square-o fa-2x"></i></a></div>
					<div class="col-xs-3 screen_icons"><a data-toggle="tooltip" title="Manage Slides" href="screenmanager.php?id=<?php echo $tiles['id']; ?>"><i class="fa fa-th-list fa-2x"></i></a></div>
					<div class="col-xs-3 screen_icons"><a data-toggle="tooltip" title="Preview Screen" href="previewscreen.php?screenName=<?php echo $tiles['id']; ?>"><i class="fa fa-play-circle-o fa-2x"></i></a></div>
					<div class="col-xs-3 screen_icons"><a data-toggle="tooltip" title="Delete Screen" href="deletescreen.php?id=<?php echo $tiles['id']; ?>" onclick="return confirm('Are you sure you want to delete this Screen?')"><i class="fa fa-trash-o fa-2x"></i></a></div>
				</div>
				</div>
			</div>
			
			<?php
		}
			?>
	</div>		

	</div>

	<?php include('footer.php'); ?>	
	
</body>