<?php

require "../db-connection.php";

$response = [
    'success' => false,
    'message' => "",
    "data" => null
];

if (isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "select id, name, email,password, status, role from users where email = '$email' LIMIT 1";

    $stmt = $conn->prepare("select id, name, email,password, status, role from users where email = ? LIMIT 1");
    $stmt->bind_param("s", $email);

    $stmt->execute();
    $stmt->bind_result($row_id, $row_name, $row_email, $row_password, $row_status, $row_role);
    if ($stmt->fetch()) {

        if (password_verify($password, $row_password)) {

            if($row_status == 1) {
                $response['success'] = true;
                $response['message'] = "Login success. Find user info in data.";
                $response['data'] = [
                    'user_id' => $row_id,
                    'full_name' => $row_name,
                    'email' => $row_email,
                    'role' => $row_role
                ];
            }else{
                $response['message'] = "Your account is disabled.";
            }

        } else {
            $response['message'] = "Password is incorrect. Please try valid password";
        }
    } else {
        $response['message'] = "No user found.";
    }

} else {
    $response['message'] = "Please provided required fields";
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
die();