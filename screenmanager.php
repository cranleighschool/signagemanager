<?php
	require_once('conn.php');
	require_once('functions.php');	
?>
<!DOCTYPE html>
<html>
<head>

<?php 
	include('head.php');
	
	if(!isset($_REQUEST['id'])) {
		$id = $screens[0]['id'];
	} else {
		$id = $_REQUEST['id'];
	}
	
	$screen = fnglobalquery($PDO, '*', 'screens', 'id', $id, 1, 1, 1, 1, 'id', 'ASC');
	
	$tableName = 'screen' . $id;
	$slides = fnglobalquery($PDO, '*', $tableName, 1, 1, 1, 1, 1, 1, 'orderNumber', 'ASC');
	$defaultTitle = $screen[0]['defaultTitle'];
?>

<title>Digital Signage Manager</title>
	
	<style>
	</style>
	
</head>

<body>
	
	<div class="container tjb_container">
<div class="page_title">	
	<h1><?php echo $screen[0]['screenName']; ?> - Slides</h1>
</div>
	
	<div class="addnew">
		<a href="slidewizard1.php?screenName=<?php echo $id; ?>">Add New Slide</a>
	</div>
	
		<div class="table-responsive">
			<table class="table text-center table-striped table-hover">
				<tr>
					<th class="text-center">Active</th>
					<th class="text-center">Order</th>
					<th class="text-center">Title</th>
					<th class="text-center">Picture</th>
					<th class="text-center">Message</th>
					<th class="text-center">Start Date &amp; Time</th>
					<th class="text-center">End Date &amp; Time</th>
					<th class="text-center">Edit</th>
					<th class="text-center">Preview</th>
					<th class="text-center">Delete</th>
				</tr>
				<tr>
					<?php foreach($slides as $row) {
						?>
						<td class="text-center"><i class="fa fa-circle" <?php $sD = $row['startDate']; $eD = $row['endDate']; fncheckslideActive($PDO, $sD, $eD, $tableName); ?> ></i></td	>
						<td><?php echo $row['orderNumber']; ?></td>
						<td><?php echo fncheckfortitle($row['title'], $defaultTitle); ?></td>
						<td><?php echo $row['picture']; ?></td>
						<td><?php echo $row['message']; ?></td>
						<td><?php echo $row['startDate']; ?></td>
						<td><?php echo $row['endDate']; ?></td>
						<td><a href="editslide.php?id=<?php echo $row['id']; ?>&screenName=<?php echo $id; ?>"><i class="fa fa-pencil-square-o"></i></a></td>
						<td><a href="previewslide.php?id=<?php echo $row['id']; ?>&screenName=<?php echo $id; ?>"><i class="fa fa-play-circle-o"></i></a></td>
						<td><a href="deleteslide.php?id=<?php echo $row['id']; ?>&screenName=<?php echo $id; ?>"><i class="fa fa-trash-o"></i></a></td>
						
					
					
				</tr>
					<?php
					} ?>
			</table>
		</div>
		
		<div class="row" style="margin-top: 100px">
			<div class="preview-controls">
			<ul class="list-unstyled list-inline text-center">
			<li><a href="managescreen.php?id=<?php echo $id; ?>">Edit Screen</a></li>
			<li><a href="previewscreen.php?screenName=<?php echo $id; ?>">Preview Screen</a></li>

			</ul>
			</div>
		</div>
		
		</div>
		
		
		


	<?php #var_dump($screenDetails); ?>
	</div>
	<?php include('footer.php'); ?>

	
	
	</body>
	</html>
	