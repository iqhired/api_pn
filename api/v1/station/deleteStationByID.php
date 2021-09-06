<?php
require "../../../vendor/autoload.php";
use \Firebase\JWT\JWT;
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../../config/database.php';
include_once '../../../classes/v1/station.php';

$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];

if($jwt){
	try {

		$decoded = JWT::decode($jwt, $secretkey, array('HS256'));

		// Access is granted. Add code of the operation here

		$database = new Database();
		$db = $database->getConnection();

		$item = new Station($db);

		$data = json_decode(file_get_contents("php://input"));

		$item->line_id = $data->line_id;

		if($item->deleteStationByID()){
			echo json_encode("Station deleted.");
		} else{
			echo json_encode("Station could not be deleted");
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