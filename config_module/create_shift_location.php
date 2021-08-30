<?php
include("../database_config.php");

    $name = $_POST['name'];

  if ($name != "") {
        $name = $_POST['name'];
        $sqlquery = "INSERT INTO `cam_shift`(`shift_name`,`created_at`,`updated_at`) VALUES ('$name','$chicagotime','$chicagotime')";
        if (!mysqli_query($db, $sqlquery)) {
			$_SESSION['message_stauts_class'] = 'alert-danger';
			$_SESSION['import_status_message'] = 'Error: Shift/Location with this Name Already Exists';
        } else {
            $_SESSION['message_stauts_class'] = 'alert-success';
            $_SESSION['import_status_message'] = 'Shift/Location Created Sucessfully.';
        }
    }

header("Location:shift_location.php");
?>
