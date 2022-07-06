<?php

require "db-connection.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if (!empty($name) && !empty($email) && !empty($password) && !empty($confirm_password)) {
    //signup the user

    //TODO check email valid.

    //TODO check name length to 256 char.

    if ($password == $confirm_password) {

        $encrypt_password = password_hash($password, PASSWORD_DEFAULT);


        //  $sql = "INSERT INTO users (name, email, password) values ('$name', '$email', '$encrypt_password' )";

        $stmt = $conn->prepare("INSERT INTO users (name, email, password) values ('?', '?', '?' )");
        $stmt->bind_param("sss", $name, $email, $encrypt_password);

        //  if ($conn->query($sql) === TRUE) {
        if ($stmt->execute()) {
            $msg = "Your account created successfully.";

            header("Location: index.php?success='$msg'");
            die();
        } else {
            $err = "Error: " . $sql . "<br>" . $conn->error;

            header("Location: signup.php?error='$err'");
            die();
        }

        $conn->close();

    } else {
        header("Location: signup.php?error='Password and confirm password not matched.'");
        die();
    }
} else {
    //return back to signup form with error
    header("Location: signup.php?error='Please provide all required fields'");
    die();
}
