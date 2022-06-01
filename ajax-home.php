<?php

session_start();
include "db-connection.php";

$response = [
    "success" => false,
    "message" => "",
    "data" => null
];

try{
    $total_recordsvalue = $conn->query("select count(*) as total_users from users;");
    $total_users = $total_recordsvalue->fetch_assoc()['total_users'];

    $total_recordsResult = $conn->query("select count(*) as total_pages from pages;");
    $total_pages = $total_recordsResult->fetch_assoc()['total_pages'];

    $response = [
        "success" => true,
        "message" => "Records fetched successfully!",
        "data" => [
            'total_users' => $total_users,
            'total_pages' => $total_pages,

        ]
    ];
}catch (Exception $e){

}

echo json_encode($response);