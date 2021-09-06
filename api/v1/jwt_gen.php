<?php
require "../../vendor/autoload.php";
use \Firebase\JWT\JWT;

class JwtHelper {

	static function getJWT() {
		$jwt ='';
		$secretkey = "SupportPassHTSSgmmi";
		$payload = array(
			"author" => "Saargummi to HTS",
			"exp" => time()+1000
		);
		try{
			$jwt = JWT::encode($payload, $secretkey);
		}catch (UnexpectedValueException $e) {
			echo $e->getMessage();
		}
		return $jwt;
	}

}


?>