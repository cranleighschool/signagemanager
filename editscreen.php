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
</head>

<body>
 	
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
	