<?php
	require_once('conn.php');
	require_once('functions.php');
?><!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
<?php
	include('head.php');
	$screens = fnglobalquery($PDO, '*', 'screens', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'theOrder', 'ASC');
	$logQuery = fnglobalquery($PDO, '*', 'userlog', 1, 1, 1, 1, 1, 1, 'id', 'DESC');
?>

<title>Log</title>
	<style>
    #theframe { width: 1920px; height: 1080px; border: 2px solid black;	box-shadow: 3px 3px 5px black;}
    #theframe {
        -ms-zoom: 0.4;
        -moz-transform: scale(0.4);
        -moz-transform-origin: 0 0;
        -o-transform: scale(0.4);
        -o-transform-origin: 0 0;
        -webkit-transform: scale(0.4);
        -webkit-transform-origin: 0 0;
    }
</style>
	
</head>

<body>
	
	<div class="container tjb_container">
	<?php if(isset($alert)){ echo $alert; } ?>
	
	<div class="page_title">
		<h1>View Log Entries</h1>
	</div>
	
	
	
		
			<div class="table-responsive">
				<table class="table text-center table-striped table-hover">
					<tr>
						<th class="text-center">Username</th>
						<th class="text-center">Action</th>
						<th class="text-center">Date Stamp</th>
					</tr>
					
			<?php foreach($logQuery as $rows) {
			?>
				</tr>
					<td><?php echo $rows['userName']; ?></td>
					<td><?php echo $rows['action']; ?></td>
					<td><?php echo $rows['dateStamp']; ?></td>
				</tr>
			
			<?php
		} ?>
				</table>
			</div>
	
	
	
	</div>

	<?php include('footer.php'); ?>	

	
</body>


</html>