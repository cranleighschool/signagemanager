<!-- grouppermissions.php -->
<?php

if(!isset($_POST['groupName'])) {
	// Error Return
} else {
$id = $_POST['groupName'];
}

header("Location:permissions.php?groupid=" . $id)

?>