<?php
session_start();

include "utils/check-login.php";
require "db-connection.php";

$name = $_POST['name'];
$description = $_POST['description'];
$primary_image = $_POST['primary_image'];
$statuse = $_POST['status'];
$price_id = $_POST['price_id'];
$role_name = $_POST['role_name'];

if (!empty($name) && !empty($description) && !empty($primary_image) && !empty($statuse)&& !empty($price_id) && !empty($role_name)) {
 
   
       
        $sql =  "INSERT INTO plans (name, description, primary_image, status, price_id, role_name) values ('$name', '$description','$primary_image', '$statuse', '$price_id', '$role_name')";
   


    if ($conn->query($sql) === TRUE) {
        $msg = "Your add successfully.";

        header("Location: plans-list.php?success='$msg'");
        die();
    } else {
        $err = "Error: " . $sql . "<br>" . $conn->error;

        header("Location: plans-list.php?error='$err'");
        die();
    }


    $conn->close();
} else {
    //return back to signup form with error
    header("Location: plan-add.php?error='Please provide all required fields'");
    die();

}