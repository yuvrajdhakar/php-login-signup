<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: home.php?error='You don't have permission for that page.");
    die();
}

include "db-connection.php";

$comment_id = $_POST['comment_id'];

$response = [
    'success' => false,
    'message' => "Not able to add your like",
    'data' => null
];

if (!empty($comment_id)) {
    $result = $conn->query("Update comments set likes = likes + 1 where id=$comment_id");


    $resultCount = $conn->query("select likes from comments where id=$comment_id");
    if ($result) {
        $response['success'] = true;
        $response['message'] = "We have added your like to the comment successfully";

        $likes = $resultCount->fetch_assoc();
        $response['data'] = $likes['likes'];
    }
}

echo json_encode($response);
die();