<!DocType HTML>
<?php
include('conn.php');
include('functions.php');
$owner = strtoupper($_SESSION['user']['username']);
$id = $_REQUEST['id'];
/* LOG INFO */
date_default_timezone_set('Europe/London');
$date = date('Y-m-d H:i:s');
$screenID = $_REQUEST['id'];
$thescreen = fnglobalquery($PDO, '*', 'screens', 'id', $screenID, 1, 1, 1, 1, 'id', 'ASC');
$screenName = $thescreen[0]['screenName'];
/* END OF LOG INFO */

$stmt = $PDO->prepare("DELETE FROM screens WHERE id=:id");
	
$stmt->bindParam(':id', $id);
$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
$stmt->execute();
}catch(PDOException $e){
	print 'Error!: Failed' . $e->getMessage();
    die();
}
/* LOG INFO */
$action = 'Deleted Screen ' . $screenName . ' / Screen ID = ' . $screenID;
$userName = $owner;
fnaddtolog($PDO, $action, $userName, $date);
/* END OF LOG INFO */


header("Location: signagemanager.php");
?>