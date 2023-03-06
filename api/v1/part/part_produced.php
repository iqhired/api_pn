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

include_once '../../../classes/v1/Part_Produced.php';

$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];
if($jwt){
    try {

        $decoded = JWT::decode($jwt,  new Key($secretkey, 'HS256'));

        // Access is granted. Add code of the operation here

        $database = new Database();
        $db = $database->getConnection();

        $item = new Part_Produced($db);

        $data = json_decode(file_get_contents("php://input"));

        $tc =  $_POST['total_count'];
        $item->part_number = $_POST['part_number'];
        $pcx = $_POST['part_number_extra'];
        $pc = $_POST["part_count"];
        for($i = 1; $i <= $tc; $i++) {

            $item->part_number_extra = $pcx[$i];
            $item->part_count = $pc[$i];
            $sgPart = $item->getPartProduced();
        }

        if($sgPart != null){
            http_response_code(200);
            echo json_encode(array("STATUS" => "Success" , "part_number" => $sgPart));
        } else{
            http_response_code(401);
            echo json_encode(array("message" => "Part number failed"));
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
