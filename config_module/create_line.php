<?php
include("../database_config.php");

    $name = $_POST['name'];

	if ($name != "") {
        $name = $_POST['name'];
        $priority_order = $_POST['priority_order'];
        $enabled = $_POST['enabled'];
        $sql0 = "INSERT INTO `cam_line`(`line_name`,`priority_order` , `enabled` , `created_at`) VALUES ('$name' , '$priority_order' , '$enabled', '$chicagotime')";
        $result0 = mysqli_query($db, $sql0);
        if ($result0) {
            $_SESSION['message_stauts_class'] = 'alert-success';
            $_SESSION['import_status_message'] = 'Station Created Sucessfully.';
        } else {
			$_SESSION['message_stauts_class'] = 'alert-danger';
			$_SESSION['import_status_message'] = 'Error: Station with this Name Already Exists';
        }
    }

header("Location:line.php");
?>
