
<?php

use ImageKit\ImageKit;
include "db-connection.php";


$imageKit = new ImageKit(
    $_ENV['IMAGEKIT_PUBLIC_KEY'],
    $_ENV['IMAGEKIT_PRIVATE_KEY'],
    $_ENV['IMAGEKIT_ENDPOINT']

);

$uploadFile = $imageKit->uploadFile([
    "file" => fopen($_FILES["image"]["tmp_name"] , "r") ,
    "fileName" => basename($_FILES["image"]["name"]),
  //  "tags" => ["tag1", "tag2"]
]);
