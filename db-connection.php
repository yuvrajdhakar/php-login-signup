<?php

require "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require "functions.php";

$database_name = $_ENV['DATABASE_NAME'];
$database_user_name = $_ENV['DATABASE_USER_NAME'];
$database_password = $_ENV['DATABASE_PASSWORD'];
$database_host =$_ENV['DATABASE_HOST'];

$conn = new mysqli($database_host, $database_user_name, $database_password, $database_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}