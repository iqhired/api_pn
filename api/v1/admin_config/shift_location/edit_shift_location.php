<?php
require "../../../../vendor/autoload.php";
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

include_once '../../../../config/database.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../../../classes/v1/Shift_Location.php';

$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];
if($jwt){
    try {

        $decoded = JWT::decode($jwt,  new Key($secretkey, 'HS256'));

        // Access is granted. Add code of the operation here

        $database = new Database();
        $db = $database->getConnection();

        $item = new Shift_Location($db);

        $data = json_decode(file_get_contents("php://input"));

        $item->shift_id = $_POST['shift_id'];
        $item->shift_name = $_POST['shift_name'];
        $item->updated_at = $_POST['updated_at'];

        $sgShift = $item->getEditShiftLocation();

        if($sgShift != null){
            http_response_code(200);
            echo json_encode(array("STATUS" => "Success" , "shift_id" => $sgShift));
        } else{
            http_response_code(401);
            echo json_encode(array("message" => "Shift Location Updated failed"));
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
