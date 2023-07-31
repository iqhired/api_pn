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

include_once '../../../../classes/v1/Form_Type.php';

$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];
if($jwt){
    try {

        $decoded = JWT::decode($jwt,  new Key($secretkey, 'HS256'));

        // Access is granted. Add code of the operation here

        $database = new Database();
        $db = $database->getConnection();

        $item = new Form_Type($db);

        $data = json_decode(file_get_contents("php://input"));

        $item->form_type_id = $_POST['form_type_id'];
        $item->form_type_name = $_POST['form_type_name'];
        $item->wol = $_POST['wol'];
        $item->updated_at = $_POST['updated_at'];

        $sgForm = $item->getEditFormType();

        if($sgForm != null){
            http_response_code(200);
            echo json_encode(array("STATUS" => "Success" , "form_type_id" => $sgForm));
        } else{
            http_response_code(401);
            echo json_encode(array("message" => "Form Type Updated failed"));
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
