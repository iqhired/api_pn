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

include_once '../../../classes/v1/Iot_Device.php';

$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];
if($jwt){
    try {

        $decoded = JWT::decode($jwt,  new Key($secretkey, 'HS256'));

        // Access is granted. Add code of the operation here

        $database = new Database();
        $db = $database->getConnection();

        $item = new Iot_Device($db);

        $data = json_decode(file_get_contents("php://input"));

        $item->c_id = $_POST['c_id'];
        $item->device_id = $_POST['device_id'];
        $item->device_name = $_POST['device_name'];
        $item->device_description = $_POST['device_description'];
        $item->device_location = $_POST['device_location'];
        $item->is_active = $_POST['is_active'];
        $item->created_by = $_POST['created_by'];
        $item->created_on = $_POST['created_on'];

        $sgDevice = $item->getIotDevice();

        if($sgDevice != null){
            http_response_code(200);
            echo json_encode(array("STATUS" => "Success" , "device_id" => $sgDevice));
        } else{
            http_response_code(401);
            echo json_encode(array("message" => "Iot Device failed"));
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
