<?php

// Database connection parameters

//server

$host = "localhost";
$username = "ashams001";
$password = "iqHired@123";
$database = "pn";

// local
// $host = "localhost";
// $username = "root";
// $password = "1221";
// $database = "saargummi";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}