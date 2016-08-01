<?php require_once('conn.php'); ?>
<!DOCTYPE html>
<html>
<head>
<title>404 Error</title>
</head>

<body>

	<h2>Wow, that's embarrassing ... something has gone wrong</h2>
	
	<p>Please go back and try again. If this continues to be a problem then please submit a helpdesk ticket with the steps that led to the error</p>
	
	<a href="http://help.cranleigh.org">Click Here to Visit Helpdesk and Submit a Ticket</a><br /><br />
	<a href="mailto:helpdesk@cranleigh.org">Click Here to Email Helpdesk and Submit a Ticket</a><br /><br />
	
	<a href="http://signagemanager.cranleigh.org">Return to Signage Manager</a><br />
	
	
	
	<!-- Yes Fred i am aware that this PHP function should be in a separate doc eg. Functions.php... i had my reasons for declaring it here. No functions.php included above :) -->
	<?php
	$action = '404 Page Triggered, Page requested was:' . $_SERVER['REQUEST_URI'];
	date_default_timezone_set('Europe/London');
	$date = date('Y-m-d H:i:s');
	if(isset($_SESSION['user']['username'])) {
		$userName = strtoupper($_SESSION['user']['username']);
	} else {
		$userName = 'Guest';
	}
	fnaddtolog($PDO, $action, $userName, $date);
	function fnaddtolog($PDO, $action, $userName, $date) {
		$stmt = $PDO->prepare("INSERT INTO userlog (action, userName, dateStamp) VALUES (:action, :userName, :date)");	
		$stmt->bindParam(':action', $action);
		$stmt->bindParam(':userName', $userName);
		$stmt->bindParam(':date', $date);
		$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
		$stmt->execute();
		}catch(PDOException $e){
			print 'Error!: Failed' . $e->getMessage();
			die();
		}	
	}
 ?>
	
</body>
</html>