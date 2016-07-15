
<!DocType HTML>
<?php
include('conn.php');
include('functions.php');

$screenid = $_POST['screenid'];
$screenTable = 'screen' . $screenid;
$id = $_POST['id'];
$template = $_POST['template'];

/* LOG INFO */
date_default_timezone_set('Europe/London');
$date = date('Y-m-d H:i:s');
/* END OF LOG INFO */


$stmt = $PDO->prepare("UPDATE $screenTable
SET
template=:template
WHERE id=:id");

$stmt->bindParam(':id', $id);
$stmt->bindParam(':template', $template);

$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
$stmt->execute();
}catch(PDOException $e){
	print 'Error!: Failed' . $e->getMessage();
    die();
}
/* LOG INFO */
$action = 'Changed Slide Template id' . $id . ' / Screen ID = ' . $screenid . ' / Template = ' . $template;
$userName = 'tbc';
fnaddtolog($PDO, $action, $userName, $date);
/* END OF LOG INFO */


header("Location:editslide.php?id=" . $id . "&screenName=" . $screenid);
?>
