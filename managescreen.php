<?php
	require_once('conn.php');
	require_once('functions.php');
?><!DOCTYPE html>
<html>
<head>

<?php 
	include('head.php');
	
	$screens = fnglobalquery($PDO, '*', 'screens', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	if(!isset($_REQUEST['id'])) {
		$id = $screens[0]['id'];
	} else {
		$id = $_REQUEST['id'];
	}
	$screen = fnglobalquery($PDO, '*', 'screens', 'id', $id, 1, 1, 1, 1, 'id', 'ASC');
	$tableName = 'screen' . $id;
	$slides = fnglobalquery($PDO, '*', $tableName, 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$defaultTitle = $screen[0]['defaultTitle'];
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$Tname = $screen[0]['defaultTemplate'];
	$templateName = fnglobalquery($PDO, 'name', 'templates', 'className', $Tname, 1, 1, 1, 1, 'id', 'ASC');
	
	
?>

<title>Digital Signage Manager</title>

</head>
<body>
	
	<div class="container tjb_container">
	<div class="page_title">	
	<h1><?php echo $screen[0]['screenName']; ?> - Manage Screen</h1>
	</div>
	
	<div class="addnew">
		<a href="#">Add New Slide</a>
	</div>
	
		<div class="table-responsive">
			<table class="table text-center table-striped table-hover">
				<tr>
					<th class="text-center">Screen Name</th>
					<th class="text-center">Default Title</th>
					<th class="text-center">Slide Duration</th>
					<th class="text-center">Default Background</th>
					<th class="text-center">Default Template</th>
					<th class="text-center">Manage Slides</th>
					<th class="text-center">Preview</th>
					<th class="text-center">Delete</th>
				</tr>
				<tr>
					<?php foreach($screen as $row) {
						?>
						<td><?php echo $row['screenName']; ?></td>
						<td><?php echo $row['defaultTitle']; ?></td>
						<td><?php echo $row['slideDuration']; ?></td>
						<td><?php echo $row['defaultBackground']; ?></td>
						<td><?php echo $templateName[0]['name']; ?></td>
						<td><a href="screenmanager.php?id=<?php echo $row['id']; ?>"><i class="fa fa-th-list"></i></a></td>
						<td><a href="previewscreen.php?screenName=<?php echo $row['id']; ?>"<i class="fa fa-play-circle-o"></i></a></td>
						<td><a href="deleteslide.php?id=<?php echo $row['id']; ?>"><i class="fa fa-trash-o"></i></a></td>
						
					
					
				</tr>
					<?php
					} ?>
			</table>
		</div>
		<br />
			<hr />
		<br />
		<form name="addsnewscreen" action="updatescreen.php" method="post">
			
			<div class="col-sm-6">
			
				
			
				<div class="form-group">
					<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['id'] ?>">
					<label for="screenName">Screen Name</label>
					<input type="text" class="form-control" id="screenName" name="screenName" value="<?php echo $row['screenName'] ?>"/>
				</div>
				
				<div class="form-group">
					<label for="slideDuration">Slide Duration (Seconds)</label>
					<input type="text" class="form-control" id="slideDuration" name="slideDuration" value="<?php echo $row['slideDuration'] ?>"/>
				</div>
			<br />
				<button style="margin-top: 3px;" type="submit" class="btn">Update</button>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group">
					<label for="defaultTitle">Default Title</label>
					<input type="text" class="form-control" id="defaultTitle" name="defaultTitle" value="<?php echo $row['defaultTitle'] ?>"/>
				</div>
				
				<div class="form-group">
					<label for="defaultBackground">Default Background</label>
					<input type="text" class="form-control" id="defaultBackground" name="defaultBackground" value="<?php echo $row['defaultBackground'] ?>"/>
				</div>
				
				<div class="form-group">
					<label for="defaultTemplate">Default Template</label>
					<select type="text" class="form-control" id="defaultTemplate" name="defaultTemplate" value="<?php echo $row['defaultTemplate']; ?>">
						<?php 
						$dtSelected = $row['defaultTemplate'];
						$templateName = fnglobalquery($PDO, 'name', 'templates', 'className', $row['defaultTemplate'], 1, 1, 1, 1, 'id', 'ASC');
						
						foreach($templates as $templatelist) {
						if ($dtSelected == $templatelist['className']) {
							?>
							<option value="<?php echo $templatelist['className']; ?>" selected="selected"><?php echo $templatelist['name']; ?></option>
							<?php
						} else {
						?>
						
						<option value="<?php echo $templatelist['className']; ?>" ><?php echo $templatelist['name']; ?></option>
						<?php	
						}
						
						} ?>
					</select>
				</div>
			</div>
		</form>
		

	
	
	
	

	<?php #var_dump($templates); ?>
	</div>
	<?php include('footer.php'); ?>

	
	
	</body>
	</html>
	