<?php
include "db-connection.php";

$s = $_GET['s'];

$response = [
    "success" => false,
    "message" => "",
    "data" => null
];

if (!empty($s)) {
    $sql = "select pages.ID, pages.title, pages.status,  pages.created_at, users.id as user_id, users.name as author_name, users.email as email from pages INNER JOIN users on users.id = pages.author where pages.title like '%$s%' limit 10";

    $result = $conn->query($sql);

    if ($result) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $response['success'] = true;
        $response['data'] = $data;
    } else {
        $response['message'] = "Error while query.";
    }
} else {
    $response['message'] = "Please provide search query";
}

echo json_encode($response);