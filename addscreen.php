<?php
	require_once('conn.php');
	require_once('functions.php');
?>	<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
<?php 
	include('head.php');
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
?>
<title>Add Screen</title>

</head>

<body>
 
	<div class="container tjb_container">	
	<div class="page_title">
		<h1>Add New Screen</h1>
	</div>
		
		<form name="addsnewscreen" action="insertscreen.php" method="post">
			
			<div class="col-sm-6">
			
				<div class="form-group">
					<label for="screenName">Screen Name</label>
					<input type="text" class="form-control" id="screenName" name="screenName"  maxlength="20"/>
					<input type="hidden" class="form-control" id="owner" name="owner" value="<?php echo strtoupper($_SESSION['user']['username']); ?>"/>
				</div>
				
				<div class="form-group">
					<label for="slideDuration">Slide Duration (Seconds)</label>
					<input type="text" class="form-control" id="slideDuration" name="slideDuration" value="10"/>
				</div>
			<br />
				<button style="margin-top: 3px;" type="submit" class="btn">Update</button>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group">
					<label for="defaultTitle">Default Title</label>
					<input type="text" class="form-control" id="defaultTitle" name="defaultTitle" maxlength="100"/>
				</div>
				
				<div class="form-group">
					<label for="defaultBackground">Default Background</label>
					<input type="text" class="form-control" id="defaultBackground" name="defaultBackground" value="bg1.jpg"/>
				</div>
				
				<div class="form-group">
					<label for="defaultTemplate">Default Template</label>
					<select type="text" class="form-control" id="defaultTemplate" name="defaultTemplate">
						<?php foreach($templates as $templatelist) {
						?>
						<option value="<?php echo htmlspecialchars($templatelist['className'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($templatelist['name'], ENT_QUOTES); ?></option>
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