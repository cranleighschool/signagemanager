<!DocType HTML>
<?php
include('conn.php');
include('functions.php');
$returnUrl = $_REQUEST['returnUrl'];

$returnUrlTemplate = $_REQUEST['returnUrlTemplate'];
if(!isset($returnUrlTemplate)) {
	$returnUrlTemplate = 'na';
}
$returnUrlName = $_REQUEST['returnUrlName'];
if(!isset($returnUrlName)) {
	$returnUrlName = 'na';
}
$id = $_REQUEST['id'];
date_default_timezone_set('Europe/London');
$date = date('Y-m-d H:i:s');
$date1 = explode(' ', $date);
$time = str_replace(':', '-', $date1[1]);
$newdate = $time . '-' . $date1[0];
echo $newdate;

$imagequery = fnglobalquery($PDO, '*', 'gallery', 'id', $id, 1, 1, 1, 1, 'id', 'ASC');
$fileName = $imagequery[0]['fileName'];
/* LOG INFO */
$action = 'Deleted Image ID ' . $id . ' / Filename is ' . $fileName;
$userName = strtoupper($_SESSION['user']['username']);
/* END OF LOG INFO */
$stmt = $PDO->prepare("DELETE FROM gallery WHERE id=:id");
	
$stmt->bindParam(':id', $id);
$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

rename('images/slideimages/' . $fileName, 'images/slideimages/deleted/'. $newdate . '-' . $fileName);

try {
$stmt->execute();
}catch(PDOException $e){
	print 'Error!: Failed' . $e->getMessage();
    die();
}

/* LOG ACTION */
fnaddtolog($PDO, $action, $userName, $date);
/* END OF LOG ACTION */
header("Location: " . $returnUrl . ".php?template=" . $returnUrlTemplate . "&screenName=" . $returnUrlName);
?>