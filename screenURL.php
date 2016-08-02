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
</head>

<body>
	<div class="container tjb_container">
		<div class="page_title">	
			<h1>View Screen URL</h1>
		</div>
		
			<h2>Copy and Paste the URL below into a web browser to view the screen. This is the URL required for Planet eStream to schedule the Screen.</h2>
			<br />
			<h3>
			http://signagemanager.cranleigh.org/previewscreen.php?screenName=<?php echo $id; ?></h3>
			<br />
		</div>
		
		
	</div>
</body>
</html>