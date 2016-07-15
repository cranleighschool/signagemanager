	<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
<?php 
	include('head.php');
	include('conn.php');
	include('functions.php');
	
	if(!isset($_REQUEST['id'])) {
		$id = 1;
	} else {
		$id = $_REQUEST['id'];
	}
	
	$screenName = $_REQUEST['screenName'];
	$screen = fnglobalquery($PDO, '*', 'screens', 'id', $screenName, 1, 1, 1, 1, 'id', 'ASC');
	$defaultTitle = $screen[0]['defaultTitle'];
	$tableName = 'screen' . $screenName;
	
	$slides = fnglobalquery($PDO, '*', $tableName, 'id', $id, 1, 1, 1, 1, 'id', 'ASC');
	
	$screens = fnglobalquery($PDO, '*', 'screens', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	
?>

<title>Edit Slide</title>
	
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
				</ul>
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
		<h1>Edit Slide</h1>
	</div>
		
		<form name="editscreenform" action="updateslide.php" method="post">
			<div class="col-sm-12">
			
					<div class="form-group">
						<input type="hidden" value="<?php echo $tableName; ?>" id="screenTable" name="screenTable">
						<input type="hidden" value="<?php echo $id; ?>" id="id" name="id">
						<label for="template">Template</label>
						<select type="text" class="form-control" id="template" name="template" required>
						
						<?php 
						$templateName = fnglobalquery($PDO, 'name', 'templates', 'className', $slides[0]['template'], 1, 1, 1, 1, 'id', 'ASC');
						?>
						<option value="<?php echo $slides[0]['template']; ?>"><?php echo $templateName[0]['name']; ?></option>
						<?php foreach($templates as $templaterows) {
							?>
							
							<option value="<?php echo $templaterows['className']; ?>"><?php echo $templaterows['name']; ?></option>
							
							<?php
						}
							?>
						</select>
					</div>
					<br />
					<div class="form-group">
						<label for="orderNumber">Order</label>
						<input type="text" class="form-control" id="orderNumber" name="orderNumber" value="<?php echo $slides[0]['orderNumber']; ?>" required>
					</div>
					
					<div class="form-group">
						<label for="title">Title</label>
						<input type="text" class="form-control" id="title" name="title" value="<?php echo fncheckfortitle($slides[0]['title'], $defaultTitle); ?>" required>
					</div>
					
					<div class="form-group">
						<label for="department">Picture</label>
						<input type="text" class="form-control" id="picture" name="picture" value="<?php echo $slides[0]['picture']; ?>" required>
					</div>
					
					<div class="row">
						<br /><br />
						<div class="col-sm-6">
							<div class="form-group">
								<label for="message">Message</label>
								<textarea rows=6 class="form-control" id="message" name="message"><?php echo $slides[0]['message']; ?></textarea>
							</div>
						</div>
						
						
						<div class="col-sm-6">
							<div class="form-group">
								<label for="fontSize">Font Size</label>
								<input type="range" min="40" max="140" class="form-control" id="fontSize" name="fontSize" value="<?php echo $slides[0]['fontSize']; ?>" required>
								<output name="fontSizeOutname" id="fontSizeOutid"><?php echo $slides[0]['fontSize']; ?></output>
							</div>
							
							<div class="form-group">
								<label for="lineHeight">Line Height</label>
								<input type="range" min="40" max="140" class="form-control" id="lineHeight" name="lineHeight" value="<?php echo $slides[0]['lineHeight']; ?>" required>
								<output name="lineHeightOutname" id="lineHeightOutid"><?php echo $slides[0]['fontSize']; ?></output>
							</div>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="startDate">Start Date &amp; Time</label>
								<input rows=3 class="form-control date_class" id="startDate" name="startDate" value="<?php echo $slides[0]['startDate']; ?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="endDate">End Date &amp; Time</label>
								<input rows=3 class="form-control date_class" id="endDate" name="endDate" value="<?php echo $slides[0]['endDate']; ?>">
							</div>
						</div>
					</div>							
							
					<br /><br />
					<div class="form-group">
						<label for="background">Background Image</label>
						<input rows=3 class="form-control" id="background" name="background" value="<?php echo $slides[0]['background']; ?>">
					</div>
					
					<br />
					<button type="submit" class="btn">Update</button>
			</div>
		
		</form>
		
	</div>
	<?php include('footer.php');
	
	var_dump($templateName);
	var_dump($slides);
	echo $slides[0]['template']; 
			?>
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
	</body>
	
	</html>