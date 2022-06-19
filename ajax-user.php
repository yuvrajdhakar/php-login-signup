<?php
 

if ($_SESSION['role'] != 'admin') {
    header("Location: home.php?error='You don't have permission for that page.");
    die();
}

include "db-connection.php";

$s = $_GET['s'];

$response = [
    "success" => false,
    "message" => "",
    "data" => null
];

if (!empty($s)) {
    $sql = "select * from users where email like '%$s%' OR name like '%$s%' limit 10";


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
die();