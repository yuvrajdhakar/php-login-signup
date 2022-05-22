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

    $sql = "UPDATE pages SET title='$title', content='$content', status='$status', published_at='$published_at' where ID='$id';";


    $result = $conn->prepare("UPDATE pages SET title=?, content=?, status=?, published_at=? where ID=?;");

    $result->bind_param("ssssi", $title, $content, $status, $published_at, $id);
    $result->execute();
    if ($result) {
        redirect("pages.php", "User updated successfully", "success");
    } else {
        redirect("pages.php", "Unable to update the page." . $conn->error, "error");
    }

} else {
    redirect("pages.php", "Required fields empty", "error");
}