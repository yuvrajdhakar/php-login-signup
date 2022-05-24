<?php

session_start();
include "db-connection.php";

$title = $_POST['title'];
$content = htmlspecialchars($_POST['content']);
$status = $_POST['status'];
$id = $_POST['id'];
if (!empty($id) && !empty($title) && !empty($content)) {


    $published_at = NULL;

    if ($status == 'published') {
        $published_at = date('Y-m-d H:i:s');
    }

    if(!empty($_FILES["image"]["name"])){
        $image_path = '';
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if (file_exists($target_file)) {
            header("Location: edit-pages.php?error='Sorry, file already exists.'&id=$id");
            die();
        }

        if ($_FILES["image"]["size"] > 500000) {
            header("Location: edit-pages.php?error='Sorry, your file is too large.'&id=$id");
            die();
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            header("Location: edit-pages.php?error='Sorry, only JPG, JPEG, PNG & GIF files are allowed.'&id=$id");
            die();
        }

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        } else {
            header("Location: edit-pages.php?error='Sorry, there was an error uploading your file.'&id=$id");
            die();
        }

       // $sql = "UPDATE pages SET title='$title', content='$content', status='$status', published_at='$published_at', image_path='$image_path' where ID='$id';";

        $result = $conn->prepare("UPDATE pages SET title=?, content=?, status=?, published_at=?, image_path=? where ID=?;");

        $result->bind_param("sssssi", $title, $content, $status, $published_at, $image_path, $id);
        $result->execute();

    }else{
    //    $sql = "UPDATE pages SET title='$title', content='$content', status='$status', published_at='$published_at' where ID='$id';";
        $result = $conn->prepare("UPDATE pages SET title=?, content=?, status=?, published_at=? where ID=?;");

        $result->bind_param("ssssi", $title, $content, $status, $published_at, $id);
        $result->execute();
    }

    if ($result) {
        redirect("pages.php", "User updated successfully", "success");
    } else {
        redirect("pages.php", "Unable to update the page." . $conn->error, "error");
    }

} else {
    redirect("pages.php", "Required fields empty", "error");
}