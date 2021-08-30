<?php
include("../database_config.php");

        $name = $_POST['name'];

  if ($name != "") {
        $description = $_POST['description'];
        $unit_of_measurement = $_POST['unit_of_measurement'];
        
        $sql0 = "INSERT INTO `form_measurement_unit`(`name`,`description` , `unit_of_measurement` , `created_at`) VALUES ('$name' , '$description' , '$unit_of_measurement', '$chicagotime')";
        $result0 = mysqli_query($db, $sql0);
        if ($result0) {
            $_SESSION['message_stauts_class'] = 'alert-success';
            $_SESSION['import_status_message'] = 'Form Unit Created Sucessfully.';
        } else {
			$_SESSION['message_stauts_class'] = 'alert-danger';
			$_SESSION['import_status_message'] = 'Error: Form Unit with this Name Already Exists';
        }
    }

header("Location:form_measurement_unit.php");
?>
