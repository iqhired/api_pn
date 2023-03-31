<?php
require "../../../vendor/autoload.php";
use Firebase\JWT\JWT;
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../../config/database.php';
include_once '../../../classes/v1/station.php';
//$jwt ='';
$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];
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
if($jwt){
	try {

		$decoded = JWT::decode($jwt, $secretkey, array('HS256'));

		// Access is granted. Add code of the operation here

		$database = new Database();
		$db = $database->getConnection();

		$item = new Station($db);

		$data = json_decode(file_get_contents("php://input"));

		$item->line_name = $data->line_name;
		$item->priority_order = $data->priority_order;
		$item->enabled = $data->enabled;
		$chicagotime = date("Y-m-d H:i:s");
		$item->created_at = $chicagotime;

		if($item->createStation()){
			echo 'Station created successfully.JWT = ' . $jwt;
		} else{
			echo 'Station could not be created.';
		}

	}catch (Exception $e){

		http_response_code(401);

		echo json_encode(array(
			"message" => "Access denied.",
			"error" => $e->getMessage()
		));
	}

}

?>