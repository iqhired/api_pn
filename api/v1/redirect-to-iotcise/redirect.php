<?php
	require "../../../vendor/autoload.php";
	require "../../../config/config.php";

	use Firebase\JWT\JWT;
	use Firebase\JWT\Key;
	
	$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];
	if ($jwt) {
		try {
            
			$decoded = JWT::decode($jwt, new Key($secretkey, 'HS256'));

            $url = $iotBaseUrl . "external-auth";
            $redirectUrl = $url . "?token=" . $jwt;

            header("Location: $redirectUrl");

		} catch (Exception $e) {
			
			http_response_code(401);
			
			echo json_encode(array(
				"message" => "Access denied.",
				"error" => $e->getMessage()
			));
		}
	}

?>