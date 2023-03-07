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

        $item = new Supplier($db);

        $data = json_decode(file_get_contents("php://input"));

        $item->c_id = $data->c_id;

        // line values
        $item->order_name = $data->order_name;
        $item->order_desc = $data->order_desc;
        $item->order_status_id = $data->order_status_id;
        $item->order_active = $data->order_active;
        $item->shipment_details = $data->shipment_details;
        $item->created_on = $data->created_on;
        $item->created_by = $data->created_by;
        $item->modified_on = $data->modified_on;
        $item->modified_by = $data->modified_by;

        if($item->updateOrder()){
            echo json_encode("Order updated successfully.");
        } else{
            echo json_encode("Order Details could not be updated");
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