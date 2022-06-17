<?php
// Start the session
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: home.php?error='You don't have permission for that page.");
    die();
}

include "db-connection.php";

$sql = "select * from users;";

$result = $conn->query($sql);

$d = date('d-m-Y-h-i-s');
$now = gmdate("D, d M Y H:i:s");
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
header("Last-Modified: {$now} GMT");

// force download
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");

// disposition / encoding on response body
header("Content-Disposition: attachment;filename=users-{$d}.csv");
header("Content-Transfer-Encoding: binary");

ob_start();
$df = fopen("php://output", 'w');

$header = [
    'id',
    'name',
    "email",
    'status'
];

fputcsv($df, $header);

while ($row = $result->fetch_assoc()) {

    if ($row['status']) {
        $status = 'Active';
    } else {
        $status = 'InActive';
    }

    $data = [
        $row['id'],
        $row['name'],
        $row['email'],
        $status
    ];

    fputcsv($df, $data);
}

fclose($df);
echo ob_get_clean();