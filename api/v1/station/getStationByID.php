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

$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];

if($jwt){
	try {

		$decoded = JWT::decode($jwt, $secretkey, array('HS256'));

		// Access is granted. Add code of the operation here

		$database = new Database();
		$db = $database->getConnection();

		$item = new Station($db);

		$item->line_id = isset($_GET['line_id']) ? $_GET['line_id'] : die();

		$item->getStationByID();

		if($item->line_id != null){
			// create array
			$station_arr = array(
				"line_id" =>  $item->line_id,
				"line_name" => $item->line_name,
				"priority_order" => $item->priority_order,
				"enabled" => $item->enabled
			);

			http_response_code(200);
			echo json_encode($station_arr);
		}

		else{
			http_response_code(404);
			echo json_encode("Station not found.");
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