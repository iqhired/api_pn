<?php
require "../../../vendor/autoload.php";
use Firebase\JWT\JWT;


    $secretkey = "SupportPassHTSSgmmi";
    $payload = array(
        'credentials' => $_GET['username'],
        "author" => "Saargummi to HTS",
        "exp" => time()+1000
    );
    $jwt = JWT::encode($payload, $secretkey, 'HS256');
    $externalDomain = "http://127.0.0.1:8000/external-auth";
    $redirectUrl = $externalDomain . "?token=" . $jwt;
    header("Location: $redirectUrl");
    echo $jwt;
?>