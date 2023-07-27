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

include_once '../../../classes/v1/Quality_Alert.php';

$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];
if ($jwt) {
    try {

        $decoded = JWT::decode($jwt, new Key($secretkey, 'HS256'));

        // Access is granted. Add code of the operation here

        $database = new Database();
        $db = $database->getConnection();

        $item = new Quality_Alert($db);

        $data = json_decode(file_get_contents("php://input"));

        $item->qa = $_POST['qa'];
        $item->part_number = $_POST["part_number"];
        $item->station = $_POST["station"];
        $item->part_family = $_POST["part_family"];
        $item->prod_area = $_POST["prod_area"];
        $item->internal = $_POST["internal"];
        $item->customer = $_POST["customer"];
        $item->external = $_POST["external"];
        $item->dependent_ans = $_POST['dependent_ans'];
        $item->user = $_POST["user"];
        $item->closed_by = $_POST["closed_by"];
        $item->created_at = $_POST['created_at'];
        $item->updated_at = $_POST['updated_at'];
        $item->closed_date = $_POST['closed_date'];
        $item->ok_image = $_POST['ok_image'];
        $item->nok_image = $_POST['nok_image'];

        $sgPartp = $item->getQualityAlert();

        if ($sgPartp != null) {
            http_response_code(200);
            echo json_encode(array("STATUS" => "Success", "qaID" => $sgPartp));
        } else {
            http_response_code(401);
            echo json_encode(array("message" => "Quality Alert create Failed. Please retry."));
        }

    } catch (Exception $e) {

        http_response_code(401);

        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
    }

}

