<?php
require "../../../vendor/autoload.php";
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

include_once '../../../config/database.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../../classes/v1/Tm_Equipment.php';

$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];
if($jwt){
    try {

        $decoded = JWT::decode($jwt,  new Key($secretkey, 'HS256'));

        // Access is granted. Add code of the operation here

        $database = new Database();
        $db = $database->getConnection();

        $item = new Tm_Equipment($db);

        $data = json_decode(file_get_contents("php://input"));

        $item->tm_equipment_name = $_POST['tm_equipment_name'];
        $item->created_by = $_POST['created_by'];

        $sgEquipment = $item->getTmEquipment();

        if($sgEquipment != null){
            http_response_code(200);
            echo json_encode(array("STATUS" => "Success" , "tm_equipment_name" => $sgEquipment));
        } else{
            http_response_code(401);
            echo json_encode(array("message" => "Equipment failed"));
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
