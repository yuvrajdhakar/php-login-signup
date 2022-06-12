<?php
use ImageKit\ImageKit;
require "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require "functions.php";

$imageKit = new ImageKit(
    "public_7mICj522D31+qZdIZy7p3y7cGGQ=",
    "private_DFav2srSShQy7mAvFi00Pm8OpY8=",
    "https://ik.imagekit.io/skyesol"
);

$listFiles = $imageKit->listFiles(array(
    "skip" => 0,
    "limit" => 10,
));

echo "<pre>";
echo ("List files : " . json_encode($listFiles));
echo "</pre>";