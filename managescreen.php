<?php
	require_once('conn.php');
	require_once('functions.php');
?><!DOCTYPE html>
<html>
<head>

<?php 
	include('head.php');
	
	if(!isset($_REQUEST['id'])) {
		$id = $screens[0]['id'];
	} else {
		$id = $_REQUEST['id'];
	}
	$tableName = 'screen' . $id;
	$screen = fnglobalquery($PDO, '*', 'screens', 'id', $id, 1, 1, 1, 1, 'id', 'ASC');
	$slides = fnglobalquery($PDO, '*', $tableName, 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$defaultTitle = $screen[0]['defaultTitle'];
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$Tname = $screen[0]['defaultTemplate'];
	$templateName = fnglobalquery($PDO, 'name', 'templates', 'className', $Tname, 1, 1, 1, 1, 'id', 'ASC');
	$groups = fnglobalquery($PDO, '*', 'groups', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	
	$bgimages = fnglobalquery($PDO, '*', 'gallery', 'type', 'bgimage', 1, 1, 1, 1, 'id', 'ASC');
?>

<title>Digital Signage Manager</title>

</head>
<body>
	<?php include('nav.php'); ?>
	<div class="container tjb_container">
		<div class="page_title">	
			<h1><?php echo $screen[0]['screenName']; ?> - Manage Screen</h1>
		</div>
	
		<div class="addnew">
			<a href="slidewizard1.php?screenName=<?php echo $id; ?>">Add New Slide</a>
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
						<td><?php echo  htmlspecialchars($row['screenName'], ENT_QUOTES); ?></td>
						<td><?php echo htmlspecialchars($row['defaultTitle'], ENT_QUOTES); ?></td>
						<td><?php echo htmlspecialchars($row['slideDuration'], ENT_QUOTES); ?></td>
						<td><?php echo htmlspecialchars($row['defaultBackground'], ENT_QUOTES); ?></td>
						<td><?php echo htmlspecialchars($templateName[0]['name'], ENT_QUOTES); ?></td>
						<td><a href="screenmanager.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES); ?>"><i class="fa fa-th-list"></i></a></td>
						<td><a href="previewscreen.php?screenName=<?php echo htmlspecialchars($row['id'], ENT_QUOTES); ?>"<i class="fa fa-play-circle-o"></i></a></td>
						<td><a href="deleteslide.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES); ?>"><i class="fa fa-trash-o"></i></a></td>
				</tr>
					<?php
					} ?>
			</table>
		</div>
		<br />
		<hr />
		<br />
		
		<div class="row">
			<form name="addsnewscreen" action="updatescreen.php" method="post">
				<div class="col-sm-6">
					<div class="form-group">
						<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['id'] ?>">
						<label for="screenName">Screen Name</label>
						<input type="text" class="form-control" id="screenName" name="screenName" value="<?php echo htmlspecialchars($row['screenName'], ENT_QUOTES); ?>"/>
					</div>
					
					<div class="form-group">
						<label for="slideDuration">Slide Duration (Seconds)</label>
						<input type="text" class="form-control" id="slideDuration" name="slideDuration" value="<?php echo htmlspecialchars($row['slideDuration'], ENT_QUOTES); ?>"/>
					</div>
				<br />
					<button style="margin-top: 3px;" type="submit" class="btn">Update</button>
				</div>
				
				<div class="col-sm-6">
					<div class="form-group">
						<label for="defaultTitle">Default Title</label>
						<input type="text" class="form-control" id="defaultTitle" name="defaultTitle" value="<?php echo htmlspecialchars($row['defaultTitle'], ENT_QUOTES); ?>"/>
					</div>
					
					<div class="form-group">
						<label for="defaultBackground">Default Background</label>
						
						<select type="text" class="form-control" id="defaultBackground" name="defaultBackground" value="<?php echo htmlspecialchars($row['defaultBackground'], ENT_QUOTES); ?>">
						<?php 
							$bgselected = $row['defaultBackground'];
							foreach($bgimages as $option) {
								if($bgselected == $option['fileName']){
									?>
									<option value="<?php echo htmlspecialchars($option['fileName'], ENT_QUOTES); ?>" selected="selected"><?php echo htmlspecialchars($option['fileName'], ENT_QUOTES); ?></option>
								<?php
								} else { ?>
									<option value="<?php echo htmlspecialchars($option['fileName'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($option['fileName'], ENT_QUOTES); ?></option>
									<?php
								}
							}
						?>
						</select>
					</div>
					
					<div class="form-group">
						<label for="defaultTemplate">Default Template</label>
						<select type="text" class="form-control" id="defaultTemplate" name="defaultTemplate" value="<?php echo htmlspecialchars($row['defaultTemplate'], ENT_QUOTES); ?>">
							<?php 
							$dtSelected = $row['defaultTemplate'];
							$templateName = fnglobalquery($PDO, 'name', 'templates', 'className', $row['defaultTemplate'], 1, 1, 1, 1, 'id', 'ASC');
							
							foreach($templates as $templatelist) {
							if ($dtSelected == $templatelist['className']) {
								?>
								<option value="<?php echo $templatelist['className']; ?>" selected="selected"><?php echo htmlspecialchars($templatelist['name'], ENT_QUOTES); ?></option>
								<?php
							} else {
							?>
							
							<option value="<?php echo $templatelist['className']; ?>" ><?php echo htmlspecialchars($templatelist['name'], ENT_QUOTES); ?></option>
							<?php	
							}
							
							} ?>
						</select>
					</div>
				</div>
			</form>
		</div>
		
		
		<?php if ($isadmin == "true") {
			?>
		
		<hr />
		<div class="row">
			<div class="col-md-12">
			<h2>Screen Editing Permissions</h2>
				<form name="updatepermissions" action="updatescreenpermission.php?screenName=<?php echo $id; ?>" method="post" >
				<div class="form-group">
				
				<input type="text" value="<?php echo $id; ?>" name="screenName" id="screenName" hidden>
				
				<label for="groupSel">Select which User Group has access to the screen</label>
					<select type="text" class="form-control" id="owner" name="owner" onchange="this.form.submit()">
						
						<?php
							foreach($groups as $group) {
								
								if($group['id'] == $screen[0]['owner']) {
									?>
									<option value="<?php echo $group['id']; ?>" selected="selected"><?php echo htmlspecialchars($group['groupName'], ENT_QUOTES); ?></option>
									<?php
								} else {
									?>
									<option value="<?php echo $group['id']; ?>"><?php echo htmlspecialchars($group['groupName'], ENT_QUOTES); ?></option>
									<?php
								}
							}
						?>
					</select>
				</form>		
				</div>
			</div>
		</div>
			
		<div class="row">
			<div class="col-md-12">
				<hr />
				<h4><b>
					This is the URL required for Planet eStream to schedule the Screen.
				</b></h4>
				<p>
					https://signagemanager.cranleigh.org/previewscreen.php?screenName=<?php echo $id; ?>
				</p>
				
			</div>
		</div>
		
		<?php
		}
		?>
	</div>
		
		


	<?php #var_dump($templates); ?>
	<?php include('footer.php'); ?>

	
	
	</body>
	</html>
	