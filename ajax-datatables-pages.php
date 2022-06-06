<?php
session_start();
include "db-connection.php";

$per_page = $_GET['length'];

$offset_value = $_GET['start'];

$order_by = 'ID';
$order = 'desc';

$order_by = "pages." . $order_by;


if (isset($_GET['search']['value'])) {

    $s = $_GET['search']['value'];

    $total_recordsResult = $conn->query("select count(*) as total_records from pages where title like '%$s%';");
    $total_records = $total_recordsResult->fetch_assoc()['total_records'];

    $sql = "select pages.ID, pages.title, pages.status,  pages.created_at, users.id as user_id, users.name as author_name, users.email as email from pages INNER JOIN users on users.id = pages.author where pages.title like '%$s%' order by $order_by $order limit $offset_value, $per_page ";


} else {

    if ($_SESSION['role'] == 'admin') {
        $total_recordsResult = $conn->query("select count(*) as total_records from pages;");
    } else {
        $total_recordsResult = $conn->query("select count(*) as total_records from pages where author=" . $_SESSION['user_id'] . ";");
    }

    $total_records = $total_recordsResult->fetch_assoc()['total_records'];


    if ($_SESSION['role'] == 'admin') {
        $sql = "select pages.ID,pages.slug, pages.title, pages.status, pages.created_at, users.id as user_id, users.name as author_name, users.email as email from pages INNER JOIN users on users.id = pages.author  order by $order_by $order limit $offset_value, $per_page ;";
    } else {
        $sql = "select pages.ID,pages.slug, pages.title, pages.status, pages.created_at, users.id as user_id, users.name as author_name, users.email as email from pages INNER JOIN users on users.id = pages.author where pages.author=" . $_SESSION['user_id'] . " limit $offset_value, $per_page ;";
    }

}
//$sql = "select * from pages order by $order_by $order limit $per_page OFFSET $offset_value;";

$result = $conn->query($sql);

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = [
        'ID' => $row['ID'],
        'title' => $row['title'],
        'status' => $row['status'],
        'author' => $row['author_name'],
        'email' => $row['email'],
        'date' => $row['created_at']
    ];
}

$response = [];
$response['draw'] = $_GET['draw'] ? $_GET['draw'] : 0;
$response['recordsTotal'] = $total_records;
$response['recordsFiltered'] = $total_records;
$response['data'] = $data;

echo json_encode($response);

die();