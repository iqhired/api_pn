<?php
include("../database_config.php");
$delete_check = $_POST['delete_check'];
if ($delete_check != "") {
	$cnt = count($delete_check);
	for ($i = 0; $i < $cnt;) {
		$sql1 = "DELETE FROM `events_category` WHERE `events_cat_id`='$delete_check[$i]'";
		if (!mysqli_query($db, $sql1)) {
			echo "Invalid Data";
		} else {
			$_SESSION['message_stauts_class'] = 'alert-success';
			$_SESSION['import_status_message'] = 'Event Category Deleted Sucessfully.';
		}
		$i++;
	}
} else {
	$_SESSION['message_stauts_class'] = 'alert-danger';
	$_SESSION['import_status_message'] = 'Please Select Event Category.';
}
header("Location:event_category.php");
?>
