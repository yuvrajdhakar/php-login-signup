<?php
require "db-connection.php";

$email = $_POST['email'];
$password = $_POST['password'];
$ConfirmPassword = $_POST["confirm_password"];
$token = $_POST['token'];

if(!empty($email) && !empty($password)){

if($password == $ConfirmPassword){
$sql = "update users set password='$password' where reset_token='$token';";

$result_update = $conn->query($sql);

if($result_update){
    header("Location: index.php?success='Your new password is updated successfully! You can login now'");
    die();
}else{
    header("Location: reset-password.php?token=$token&error='sorry not able update your password '");
    die();
}
}else{
    header("Location: reset-password.php?token=$token&error=' password is not match '");
    die();
}

}else{
    header("Location: reset-password.php?token=$token&error='Please provide your email id'");
    die();
}

