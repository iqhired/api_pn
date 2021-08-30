<?php
include("../database_config.php");

    $name = $_POST['name'];

    if ($name != "") {
        $name = $_POST['name'];
//mysqli_query($db, "INSERT INTO `position`(`position_name`,`id`,`line`,`status`) VALUES ('$name','$pstion_id','$line','$status' )");
        $sql0 = "INSERT INTO `cam_position`(`position_name`,`created_at`,`updated_at`) VALUES ('$name','$chicagotime','$chicagotime')";
        $result0 = mysqli_query($db, $sql0);
        if ($result0) {
            $_SESSION['message_stauts_class'] = 'alert-success';
            $_SESSION['import_status_message'] = 'Position Created Sucessfully.';
        } else {
			$_SESSION['message_stauts_class'] = 'alert-danger';
			$_SESSION['import_status_message'] = 'Error: Position with this Name Already Exists';
        }
    }


header("Location:position.php");
?>
