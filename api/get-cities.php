<?php
include "../db-connection.php";

$response = [
    'success' => false,
    'message' => "",
    "data" => null
];

$state_id = $_GET['state_id'];

if (!empty($state_id)) {

    $citiesResult = $conn->query("select * from cities where state_id='$state_id'");

    $cityes = [];

    while ($cities = $citiesResult->fetch_assoc()) {
        $cityes[] = [
            'id' => $cities['id'],
            'state_id' => $cities['state_id'],
            'name' => $cities['name']
        ];
    }

    $response['data'] = $cityes;
    $response['message'] = "cityes fetched successfully";
    $response['success'] = true;
} else {
    $response['message'] = "Please provide country code";
}


echo json_encode($response);
die();