<?php
use ImageKit\ImageKit;
require "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require "functions.php";

$imageKit = new ImageKit(
    "",
    "",
    ""
);

$listFiles = $imageKit->listFiles(array(
    "skip" => 0,
    "limit" => 10,
));

echo "<pre>";
echo ("List files : " . json_encode($listFiles));
echo "</pre>";