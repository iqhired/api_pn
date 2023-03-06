<?php
include("../config.php");
$chicagotime = date("Y-m-d H:i:s");
$part_number = $_POST['part_number'];

if ($part_number != ""){
    $part_number = $_POST['part_number'];
    $part_number_extra = $_POST['part_number_extra'];
    $part_count = $_POST['part_count'];

    $sql0 = "Insert into `pno_vs_pProduced` (`part_number`,`part_number_extra`,`part_count`) VALUES ('$part_number','$part_number_extra','$part_count','$chicagotime')";
    $result0 = mysqli_query($db,$sql0);
    if ($result0) {
        $_SESSION['message_stauts_class'] = 'alert-success';
        $_SESSION['import_status_message'] = 'Part Number Added Sucessfully.';
    } else {
        $_SESSION['message_stauts_class'] = 'alert-danger';
        $_SESSION['import_status_message'] = 'Error: Part Number with this Name Already Exists';
    }

}