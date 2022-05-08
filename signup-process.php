<?php

require "db-connection.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if(!empty($name) && !empty($email) && !empty($password) && !empty($confirm_password)){
    //signup the user

    if($password == $confirm_password){
        
        $sql = "INSERT INTO users (name, email, password) values ('$name', '$email', '$password' )";
        
        if ($conn->query($sql) === TRUE) {
           $msg = "Your account created successfully.";

            header("Location: index.php?success='$msg'");
            die();
          } else {
            $err = "Error: " . $sql . "<br>" . $conn->error;

            header("Location: signup.php?error='$err'");
            die();
          }
          
          $conn->close();

    }else{
        header("Location: signup.php?error='Password and confirm password not matched.'");
        die();
    }
}else{
    //return back to signup form with error
    header("Location: signup.php?error='Please provide all required fields'");
    die();
}
