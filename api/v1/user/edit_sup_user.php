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

include_once '../../../classes/v1/supplierUsers.php';

$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];
if($jwt){
    try {

        $decoded = JWT::decode($jwt,  new Key($secretkey, 'HS256'));

        // Access is granted. Add code of the operation here

        $database = new Database();
        $db = $database->getConnection();

        $item = new supplierUsers($db);

        $data = json_decode(file_get_contents("php://input"));
        $item->sup_id = $_POST['sup_id'];
        $item->user_name = $_POST['edit_user_name'];
        $item->password = $_POST['edit_password'];
        $item->first_name = $_POST['edit_first_name'];
        $item->last_name = $_POST['edit_last_name'];
        $item->role = $_POST['edit_role'];
        $item->email = $_POST['edit_email'];
        $item->mobile = $_POST['edit_mobile'];
        $item->address = $_POST['edit_address'];
        $item->profile_pic = $_POST['edit_profile_pic'];
        $item->updated_at = $_POST['updated_at'];

        $sgPos = $item->updateSupplierUser();

        if($sgPos != null){
            http_response_code(200);
            echo json_encode(array("STATUS" => "Success" , "sup_id" => $sgPos));
        } else{
            http_response_code(401);
            echo json_encode(array("message" => "User Update failed"));
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
