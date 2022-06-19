<?php

session_start();

 

if ($_SESSION['role'] != 'admin') {
    header("Location: home.php?error='You don't have permission for that page.");
    die();
}

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

    $total_a = $conn->query("select COUNT(*) as total_activs FROM users WHERE status =1;");
    $total_activs = $total_a->fetch_assoc()['total_activs'];

    $total_b = $conn->query("select COUNT(*) as total_inactivs FROM users WHERE status =0;");
    $total_inactivs = $total_b->fetch_assoc()['total_inactivs'];

    $jbl = $conn->query("select COUNT(*) as published FROM pages WHERE status ='published';");
    $published = $jbl->fetch_assoc()['published'];

    $asdf = $conn->query("select COUNT(*) as draft FROM pages WHERE status ='draft';");
    $draft = $asdf->fetch_assoc()['draft'];


    $response = [
        "success" => true,
        "message" => "Records fetched successfully!",
        "data" => [
            'total_users' => $total_users,
            'total_pages' => $total_pages,
           'total_activs' => $total_activs,
         'total_inactivs' => $total_inactivs,
         'published'      => $published,
         'draft'         =>  $draft,

        ]
    ];
}catch (Exception $e){

}

echo json_encode($response);