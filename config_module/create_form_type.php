<?php
include("../database_config.php");

    $name = $_POST['name'];
//create
    if ($name != "") {
        $name = $_POST['name'];
        $sqlquery = "INSERT INTO `form_type`(`form_type_name`,`created_at`,`updated_at`) VALUES ('$name','$chicagotime','$chicagotime')";
        if (!mysqli_query($db, $sqlquery)) {
			$_SESSION['message_stauts_class'] = 'alert-danger';
			$_SESSION['import_status_message'] = 'Error: Form Type with this Name Already Exists';
        } else {
            $_SESSION['message_stauts_class'] = 'alert-success';
            $_SESSION['import_status_message'] = 'Form Type Created Sucessfully.';
        }
    }

header("Location:form_type.php");
?>
