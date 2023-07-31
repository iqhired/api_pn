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

include_once '../../../../classes/v1/Material_Config.php';

$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];
if($jwt){
    try {

        $decoded = JWT::decode($jwt,  new Key($secretkey, 'HS256'));

        // Access is granted. Add code of the operation here

        $database = new Database();
        $db = $database->getConnection();

        $item = new Material_Config($db);

        $data = json_decode(file_get_contents("php://input"));

        $item->material_id = $_POST['material_id'];
        $item->teams = $_POST['teams'];
        $item->users = $_POST['users'];
        $item->material_type = $_POST['material_type'];
        $item->serial_num_required = $_POST['serial_num_required'];
        $item->created_at = $_POST['created_at'];

        $sgMat = $item->getEditMaterialConfig();

        if($sgMat != null){
            http_response_code(200);
            echo json_encode(array("STATUS" => "Success" , "material_id" => $sgMat));
        } else{
            http_response_code(401);
            echo json_encode(array("message" => "Material Config Updated failed"));
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
