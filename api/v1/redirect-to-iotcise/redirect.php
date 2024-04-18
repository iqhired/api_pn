<?php
	require "../../../vendor/autoload.php";
	
	use Firebase\JWT\JWT;
	use Firebase\JWT\Key;
	
	$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];
	if ($jwt) {
		try {
            
			
            $key = "aseqw5844q734aqqweFADFd54GE456A";
			$decoded = JWT::decode($jwt, new Key($secretkey, 'HS256'));

            // Payload data
            $payload = array(
                "credentials" => $decoded->credentials,
                "exp" => time()+100
            );


            $jwt = JWT::encode($payload, $key, 'HS256');
            $externalDomain = "http://av:8888/external-auth";
            $redirectUrl = $externalDomain . "?token=" . $jwt;
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