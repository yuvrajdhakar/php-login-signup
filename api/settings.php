<?php

include "../db-connection.php";

$results = $conn->query("select * from settings");

$response = [
    'success' => true,
    'message' => "Settings retrieved successfully!",
    "data" => null
];

$settings = [];

while($row = $results->fetch_assoc()){
    $settings[] = [
        'name' => $row['name'],
        'value' => $row['value']
    ];
}

$response['data'] = $settings;

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
die();