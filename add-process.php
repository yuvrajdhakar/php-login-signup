<?php
session_start();
require "db-connection.php";

$title = $_POST['title'];
$contant = $_POST['content'];
$status = $_POST['status'];


if( !empty($title) && !empty($contant) && !empty($status) ){

    $author = $_SESSION['user_id'];
 $sql = "INSERT INTO pages (title, content, status, author) values ('$title', '$contant', '$status', '$author')";

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
}else{
 //return back to signup form with error
 header("Location: pages.php?error='Please provide all required fields'");
 die();

}