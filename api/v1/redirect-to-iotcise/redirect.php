<?php

require '../../../vendor/autoload.php';

use \Firebase\JWT\JWT;

// secret key
$key = "aseqw5844q734aqqweFADFd54GE456A";

// Payload data
$payload = array(
    "credentials" => $_GET['credential'],
    "username" => "example_user",
    "exp" => time()+1000
);


$jwt = JWT::encode($payload, $key, 'HS256');
$externalDomain = "http://127.0.0.1:8000/external-auth";
$redirectUrl = $externalDomain . "?token=" . $jwt;
header("Location: $redirectUrl");

?>
