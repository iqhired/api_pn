<?php
@ob_start();
session_start();
ini_set('display_errors', FALSE);

$servername = "localhost";
$username = "umvc1ebnftglp";
$password = "holliiszwida";
$dbname = "dbzdwexbkd5orw";

// to check whether pin is updated or not 

$db = mysqli_connect('localhost','root','','saargummi');
$mysqli = new mysqli('localhost', 'root', '', 'saargummi');

//$db = mysqli_connect('localhost','sg_crew_assign_mgr','sg_crew_assign_mgr@2020','sg_crew_assign_mgmt');
//$mysqli = new mysqli('localhost', 'sg_crew_assign_mgr', 'sg_crew_assign_mgr@2020', 'sg_crew_assign_mgmt');

date_default_timezone_set("America/chicago");

$sitename = "SaarGummi";

$scriptName = "http://localhost/saargummi/";

?>