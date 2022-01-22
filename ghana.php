<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once 'models/api.keys.class.php';
include_once 'models/api.user.class.php';

$api = new API_KEY();

$apiuser = new API_USER();

$user_id = $_GET["user_id"];
$api_key = $_GET["api_key"];
$fields = $_GET["fields"];

if(!isset($api_key)){
    echo json_encode(
        array(
            'code' => 1,
            'message' => "API key required"
        )
        );

        die();
}

if(strlen($api_key) != 15){
    echo json_encode(
        array(
            'code' => 2,
            'message' => "API key not valid"
        )
        );

        die();
}
 
if($api->validateApiKey($api_key)["row"] == 0){
    echo json_encode(
        array(
            'code' => 3,
            'message' => $api->validateApiKey($api_key)["message"]
        )
        );

        die();
}

//validate if api date is valid / diactivate it
if(strtotime(date("Y-m-d H:i:s")) > strtotime($api->validateApiKey($api_key)["data"]->date_expire)){
    echo strtotime($date);
    $api->diactivateApiKey($api_key);
    
}


//validate for user id
if(!isset($user_id)){
    echo json_encode(
        array(
            'code' => 4,
            'message' => "user id required"
        )
        );

        die();
}


if($apiuser->validateUserId($user_id)["row"] == 0){
    echo json_encode(
        array(
            'code' => 5,
            'message' => $apiuser->validateUserId($user_id)["message"]
        )
        );

        die();
}


