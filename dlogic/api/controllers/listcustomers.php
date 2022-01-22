<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Content-Type: application/json');

include_once '../../models/api.keys.class.php';
include_once '../../models/api.user.class.php';
include_once '../../models/customer.class.php';

$customer = new CUSTOMER();


//list all customers
echo json_encode(
    array(
        'code' => 200,
        'message' =>"success",
        'data'=>$customer->findAll() //$data
    )
    );

//retreive single customer
// echo json_encode(
//     array(
//         'code' => 200,
//         'message' =>"success",
//         'data'=>$customer->find(3) //$data
//     )
//     );


