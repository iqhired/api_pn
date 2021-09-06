<?php
require "../../../vendor/autoload.php";
use \Firebase\JWT\JWT;
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../../config/database.php';
include_once '../../../classes/v1/station.php';

$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];

if($jwt){
	try {
		$secretkey = "SupportPassHTSSgmmi";
		$decoded = JWT::decode($jwt, $secretkey, array('HS256'));

		// Access is granted. Add code of the operation here


		$database = new Database();
		$db = $database->getConnection();

		$items = new Station($db);

		$stmt = $items->getAllStations();
		$itemCount = $stmt->rowCount();


		echo json_encode($itemCount);

		if($itemCount > 0){

			$stationArr = array();
			$stationArr["body"] = array();
			$stationArr["itemCount"] = $itemCount;

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				$e = array(
					"line_id" => $line_id,
					"line_name" => $line_name,
					"priority_order" => $priority_order,
					"enabled" => $enabled
				);

				array_push($stationArr["body"], $e);
			}
			echo json_encode($stationArr);
		}

		else{
			http_response_code(404);
			echo json_encode(
				array("message" => "No record found.")
			);
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