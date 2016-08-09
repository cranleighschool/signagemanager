<?php
include "conn.php";
include "functions.php";

$newgroupname = $_POST['newgroupname'];

$stmt = $PDO->prepare("INSERT INTO groups (groupName) VALUES (:newgroupname)");

$stmt->bindParam(':newgroupname', $newgroupname);

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
$userName = strtoupper($_SESSION['user']['username']);
$action =  $userName . ' New Group Created' . $newgroupname;
fnaddtolog($PDO, $action, $userName, $date);
/* END OF LOG INFO */

$latestID = fnglobalquery($PDO, 'id', 'groups', 1, 1, 1, 1, 1, 1, 'id', 'DESC');

header("Location:permissions.php?groupid=" . $latestID[0]['id']);
?>
