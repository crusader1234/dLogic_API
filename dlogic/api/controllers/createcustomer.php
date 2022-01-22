<?php
include_once '../../models/api.keys.class.php';
include_once '../../models/api.user.class.php';
include_once '../../models/customer.class.php';
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Access-Control-Allow-Methods, Authorization, X-Requested-With");

$api = new API_KEY();
$apiuser = new API_USER();
$customer = new CUSTOMER();



//get raw posted data
$incoming_data = json_decode(file_get_contents("php://input"), true);


if($customer->create($incoming_data)){

    echo json_encode(
        array(
            'code' => 200,
            'message' =>"customer created successfully"
        )
        );
}else{

    echo json_encode(
        array(
            'code' => 400,
            'message' =>"failed"
        )
        );
}






