<?php
session_start();
 
 

require "db-connection.php";

$image_path = '';

if (!empty($_FILES["image"]["name"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (file_exists($target_file)) {
        header("Location: media.php?error='Sorry, file already exists.'");
        die();
    }

    if ($_FILES["image"]["size"] > 500000) {
        header("Location: media.php?error='Sorry, your file is too large.'");
        die();
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        header("Location: media.php?error='Sorry, only JPG, JPEG, PNG & GIF files are allowed.'");
        die();
    }

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image_path = $target_file;
        $msg = "Your image add successfully.";

        header("Location: media.php?success='$msg'");
        die();
    } else {
        header("Location: media.php?error='Sorry, there was an error uploading your file.'");
        die();
    }
}
