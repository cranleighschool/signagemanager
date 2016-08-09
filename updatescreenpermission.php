<?php
	require_once('conn.php');
	require_once('functions.php');
?><!DocType HTML>
<?php

$id = $_POST['screenName'];
$owner = $_POST['owner'];

$stmt = $PDO->prepare("UPDATE screens SET id=:id, owner=:owner WHERE id=$id");

$stmt->bindParam(':id', $id);
$stmt->bindParam(':owner', $owner);

$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
$stmt->execute();
}catch(PDOException $e){
	print 'Error!: Failed' . $e;
    die();
}

/* LOG INFO */
date_default_timezone_set('Europe/London');
$date = date('Y-m-d H:i:s');
$action = 'Edited Permissions for Screen ID ->' . $id;
$userName = strtoupper($_SESSION['user']['username']);
fnaddtolog($PDO, $action, $userName, $date);
/* END OF LOG INFO */

header("Location:managescreen.php?id=" . $id)
?>
