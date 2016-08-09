<?php
include "conn.php";
include "functions.php";

$groupID = $_POST['groupid'];
$newMember = $_POST['newMember'];

$stmt = $PDO->prepare("INSERT INTO permissions (groupID, username) VALUES (:groupID, :newMember)");

$stmt->bindParam(':groupID', $groupID);
$stmt->bindParam(':newMember', $newMember);

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
$action =  $userName . ' Added Member to Group with ID => ' . $groupID . '// New Member => ' . $newMember;
fnaddtolog($PDO, $action, $userName, $date);
/* END OF LOG INFO */

header("Location:permissions.php?groupid=" . $groupID);
?>