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
include_once '../../../classes/v1/assignedCrew.php';

$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];

if($jwt){
	try {

		$decoded = JWT::decode($jwt, $secretkey, array('HS256'));

		// Access is granted. Add code of the operation here

		$database = new Database();
		$database1 = new Database();
		$db = $database->getConnection();
		$db1 = $database1->getConnection();

		$item = new Station($db);
		$assignedCrew = new AssignedCrew($db1);

		$data = json_decode(file_get_contents("php://input"));

		$delete_check = $data->delete_check;
		if ($delete_check != "") {
			$cnt = count($delete_check);
			for ($i = 0; $i < $cnt;) {
				$assignedCrew->line_id = $delete_check[$i]->line_id;
				if($assignedCrew->isCrewAssignedForStation()){
					$item->line_id = $assignedCrew->line_id;
					$st = $item->getStationByID();
					echo json_encode("Crew Members needs to Unassigned before deleting the Station - " . $st->line_name . ".");
				}else{
					$item->line_id = $delete_check[$i]->line_id;
					$st = $item->getStationByID();
					if(!$item->deleteStationByID()){
						echo json_encode("Station - ( " . $st->line_name . " ) could not be deleted");
					}else{
						echo json_encode("Station - (" . $st->line_name . " ) deleted Successfully.");
					}
				}
				$i++;
			}
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