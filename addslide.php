	<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
<?php 
	include('head.php');
	include('conn.php');
	include('functions.php');
	
	$screenName = $_REQUEST['screenName'];
	$screen = fnglobalquery($PDO, '*', 'screens', 'id', $screenName, 1, 1, 1, 1, 'id', 'ASC');
	$defaultTitle = $screen[0]['defaultTitle'];
	$screenid = $screen[0]['id'];
	$tableName = 'screen' . $screen[0]['id'];
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
?>
<title>Add Slide</title>
</head>

<body>
 	
	<div class="container tjb_container">	
	<div class="page_title">
		<h1>Add New Slide - <?php echo $screen[0]['screenName']; ?></h1>
	</div>
		
		<form name="editscreenform" action="insertslide.php" method="post">
			<div class="col-sm-12">
			
					<div class="form-group">
						<input type="hidden" value="<?php echo $screenid; ?>" id="screenid" name="screenid">
						<input type="hidden" value="<?php echo strtoupper($_SESSION['user']['username']); ?>" id="username" name="username">
						<label for="template">Template</label>
						<select type="text" class="form-control" id="template" name="template" required>
						<?php foreach($templates as $templaterows) {
							?>
							<option value="<?php echo $templaterows['className']; ?>"><?php echo $templaterows['name']; ?></option>
							<?php
						}
							?>
						</select>
					</div>	
					
					<div class="form-group">
						<label for="orderNumber">Order</label>
						<input type="text" class="form-control" id="orderNumber" name="orderNumber" value="<?php echo fnnextorder($PDO, $tableName, 'orderNumber', 'ASC'); ?>" required>
					</div>
					
					<div class="form-group">
						<label for="title">Title</label>
						<input type="text" class="form-control" id="title" name="title" value="<?php echo $defaultTitle; ?>" required>
					</div>
					
					<div class="form-group">
						<label for="department">Picture</label>
						<input type="text" class="form-control" id="picture" name="picture" value="" required>
					</div>
					
					<div class="row">
						<br /><br />
						<div class="col-sm-6">
							<div class="form-group">
								<label for="message">Message</label>
								<textarea rows=6 class="form-control" id="message" name="message"></textarea>
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="form-group">
								<label for="fontSize">Font Size</label>
								<input type="range" min="40" max="140" class="form-control" id="fontSize" name="fontSize" value="80" required>
								<output name="fontSizeOutname" id="fontSizeOutid">80</output>
							</div>
							
							<div class="form-group">
								<label for="lineHeight">Line Height</label>
								<input type="range" min="40" max="140" class="form-control" id="lineHeight" name="lineHeight" value="80" required>
								<output name="lineHeightOutname" id="lineHeightOutid">80</output>
							</div>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="startDate">Start Date &amp; Time</label>
								<input class="form-control date_class" id="startDate" name="startDate" value="" required>
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="form-group">
								<label for="endDate">End Date &amp; Time</label>
								<input class="form-control date_class" id="endDate" name="endDate" required>
							</div>
						</div>
					</div>
							
					<br /><br />
					<div class="form-group">
						<label for="background">Background Image</label>
						<input class="form-control" id="background" name="background" value="<?php echo $screen[0]['defaultBackground']; ?>">
					</div>
					
					<br />
					<button type="submit" class="btn">Update</button>
			</div>
		
		</form>
		

	</div>
	<?php include('footer.php'); 
	
	echo 'Table Name is ... ' . $tableName;?>
		
		


	
	</body>
	<script> 
	document.editscreenform.lineHeight.oninput = function(){
    document.editscreenform.lineHeightOutid.value = document.editscreenform.lineHeight.value;
 }	 
	document.editscreenform.fontSize.oninput = function(){
    document.editscreenform.fontSizeOutid.value = document.editscreenform.fontSize.value;
 }
 </script>
 	<script src="./jquery.js"></script>
<script src="build/jquery.datetimepicker.full.js"></script>
 <script>/*
window.onerror = function(errorMsg) {
	$('#console').html($('#console').html()+'<br>'+errorMsg)
}*/

$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
	$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
	$.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'1986/01/05'
});


$('.date_class').datetimepicker();


</script>

	</html>