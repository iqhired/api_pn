<?php
include("../database_config.php");

    $edit_name = $_POST['edit_name'];
    if ($edit_name != "") {
        $id = $_POST['edit_id'];
        $sql = "update form_measurement_unit set name='$_POST[edit_name]', description ='$_POST[edit_description]' , unit_of_measurement ='$_POST[edit_unit_of_measurement]'  where form_measurement_unit_id='$id'";
        $result1 = mysqli_query($db, $sql);
        if ($result1) {
            $_SESSION['message_stauts_class'] = 'alert-success';
            $_SESSION['import_status_message'] = 'Form Unit Updated successfully.';
        } else {
			$_SESSION['message_stauts_class'] = 'alert-danger';
			$_SESSION['import_status_message'] = 'Error: Please Retry';
        }
    }

header("Location:form_measurement_unit.php");
?>
