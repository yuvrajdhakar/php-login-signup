<?php
session_start();

include "utils/check-login.php";


if($_SESSION['role'] !='admin'){
    header("Location: home.php?error='You don't have permission for that page.");
    die();
}

include "db-connection.php";

$user_id = $_POST['user_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$status = $_POST['status'];
$password = $_POST['password'];

if(!empty($user_id) && !empty($email)){

    if(!empty($password)){
        $encrypt_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET name='$name', email='$email', status='$status', password='$encrypt_password' where id=$user_id;";
    }else{
        $sql = "UPDATE users SET name='$name', email='$email', status='$status' where id=$user_id;";
    }

    $result = $conn->query($sql);

    if($result)
    {
        redirect("users.php", "User updated successfully", "success");
    }else{
        redirect("users.php", "No table to update the user", "error");
    }

}else{
    redirect("users.php", "Required fields empty", "error");
}