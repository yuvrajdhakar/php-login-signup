<?php
include "../db-connection.php";

$response = [
    'success' => false,
    'message' => "",
    "data" => null
];

$country_code = $_GET['country_code'];

if (!empty($country_code)) {

    $statesResult = $conn->query("select * from states where country_code='$country_code'");

    $states = [];

    while ($state = $statesResult->fetch_assoc()) {
        $states[] = [
            'id' => $state['id'],
            'country_code' => $state['country_code'],
            'name' => $state['name']
        ];
    }

    $response['data'] = $states;
    $response['message'] = "States fetched successfully";
    $response['success'] = true;
} else {
    $response['message'] = "Please provide country code";
}


echo json_encode($response);
die();