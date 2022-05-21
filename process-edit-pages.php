<?php

session_start();
include "db-connection.php";

$title = $_POST['title'];
$content = $_POST['content'];
$status = $_POST['status'];
$id = $_POST['id'];
if(!empty($id) && !empty($title) && !empty($content)){

    
        $sql = "UPDATE pages SET title='$title', content='$content', status='$status' where ID='$id';";
    

    $result = $conn->query($sql);

    if($result)
    {
        redirect("pages.php", "User updated successfully", "success");
    }else{
        redirect("pages.php", "No table to update the user", "error");
    }

}else{
    redirect("pages.php", "Required fields empty", "error");
}