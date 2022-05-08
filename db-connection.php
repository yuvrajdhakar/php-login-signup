<?php

require "vendor/autoload.php";

require "functions.php";

$database_name = "test2";
$database_user_name = "test2";
$database_password = "Bharat@123";
$database_host ="127.0.0.1";

$conn = new mysqli($database_host, $database_user_name, $database_password, $database_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}