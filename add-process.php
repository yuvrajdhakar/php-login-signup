<?php
session_start();

require "db-connection.php";

$title = $_POST['title'];
$contant = $_POST['content'];
$status = $_POST['status'];


if (!empty($title) && !empty($contant) && !empty($status)) {

    $author = $_SESSION['user_id'];
    $slug = createUrlSlug($title, $conn);

    $created_at = date('Y-m-d H:i:s');

    $image_path = '';

    if(!empty($_FILES["image"]["name"])){
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if (file_exists($target_file)) {
            header("Location: add-pages.php?error='Sorry, file already exists.'");
            die();
        }

        if ($_FILES["image"]["size"] > 500000) {
            header("Location: add-pages.php?error='Sorry, your file is too large.'");
            die();
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            header("Location: add-pages.php?error='Sorry, only JPG, JPEG, PNG & GIF files are allowed.'");
            die();
        }

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        } else {
            header("Location: add-pages.php?error='Sorry, there was an error uploading your file.'");
            die();
        }
    }


    if ($status == 'published') {
        $published_at = date('Y-m-d H:i:s');
        $sql = "INSERT INTO pages (title, content, status, author, slug, created_at,published_at, image_path) values ('$title', '$contant', '$status', '$author', '$slug', '$created_at', '$published_at', '$image_path')";
    }else{
        $sql = "INSERT INTO pages (title, content, status, author, slug, created_at, image_path) values ('$title', '$contant', '$status', '$author', '$slug', '$created_at', '$image_path')";

    }


    if ($conn->query($sql) === TRUE) {
        $msg = "Your add successfully.";

        header("Location: pages.php?success='$msg'");
        die();
    } else {
        $err = "Error: " . $sql . "<br>" . $conn->error;

        header("Location: pages.php?error='$err'");
        die();
    }


    $conn->close();
} else {
    //return back to signup form with error
    header("Location: add-pages.php?error='Please provide all required fields'");
    die();

}