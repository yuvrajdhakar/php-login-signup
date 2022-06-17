<?php
// Start the session
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: home.php?error='You don't have permission for that page.");
    die();
}

include "db-connection.php";

if ($_SESSION['role'] == 'admin') {
    $sql = "select pages.ID,pages.slug, pages.title, pages.status, pages.created_at, users.id as user_id, users.name as author_name, users.email as email from pages INNER JOIN users on users.id = pages.author ;";
} else {
    $sql = "select pages.ID,pages.slug, pages.title, pages.status, pages.created_at, users.id as user_id, users.name as author_name, users.email as email from pages INNER JOIN users on users.id = pages.author where pages.author=" . $_SESSION['user_id'] . ";";
}

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
header("Content-Disposition: attachment;filename=pages-{$d}.csv");
header("Content-Transfer-Encoding: binary");

ob_start();
$df = fopen("php://output", 'w');

$header = [
    'ID',
    'Title',
    "Status",
    'Author',
    'Date'
];

fputcsv($df, $header);

while ($row = $result->fetch_assoc()) {
    $data = [
        $row['ID'],
        $row['title'],
        $row['status'],
        $row['author_name'],
        $row['created_at']
    ];

    fputcsv($df, $data );
}

fclose($df);
echo ob_get_clean();