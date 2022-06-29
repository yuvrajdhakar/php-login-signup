<?php

require "../db-connection.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

$response = [
    'success' => false,
    'message' => "",
    "data" => null
];

if (!empty($name) && !empty($email) && !empty($password) && !empty($confirm_password)) {
    if ($password == $confirm_password) {
        $encrypt_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password) values ('$name', '$email', '$encrypt_password' )";

        if ($conn->query($sql) === TRUE) {
            $response['success'] = true;
            $response['message'] = "Your account created successfully.";
        } else {
            $response['message'] = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $response['message'] = "Password and confirm password not matched.";
    }
} else {
    $response['message'] = "Please provide all required fields";
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
die();