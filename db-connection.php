<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require "functions.php";


$database_name = $_ENV['DATABASE_NAME'];
$database_user_name = $_ENV['DATABASE_USER_NAME'];
$database_password = $_ENV['DATABASE_PASSWORD'];
$database_host = $_ENV['DATABASE_HOST'];

$conn = new mysqli($database_host, $database_user_name, $database_password, $database_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//
$setting_site_logo = '';
$setting_site_title = '';
$setting_copywrite_text = '';

$resultSettings = $conn->query("Select * from settings");

if ($resultSettings) {
    while ($rowSettings = $resultSettings->fetch_assoc()) {
        if($rowSettings['name'] == 'site_logo'){
            $setting_site_logo = $rowSettings['value'];
        }

        if($rowSettings['name'] == 'site_title'){
            $setting_site_title = $rowSettings['value'];
        }

        if($rowSettings['name'] == 'copywrite_text'){
            $setting_copywrite_text = $rowSettings['value'];
        }
    }
}

function createUrlSlug($urlString, $conn)
{
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $urlString);

    $is_not_unique = true;
    $i = 1;
    do {

        $result = $conn->query("SELECT count(*) as found FROM `pages` where slug='$slug';");

        $count = $result->fetch_assoc()['found'];

        if ($count) {
            $i = $i + 1;
            $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $urlString) . "-" . $i;
        } else {
            $is_not_unique = false;
        }

    } while ($is_not_unique);

    return $slug;
}