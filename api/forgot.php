<?php

require "../db-connection.php";

$email = $_POST['email'];
$response = [
    'success' => false,
    'message' => "",
    "data" => null
];

if (!empty($email)) {
    $sql = "select id, name, email from users where email = '$email' LIMIT 1";

    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();
            $user_id = $row['id'];

            $random_str = generateRandomString(20);

            $update_sql = "UPDATE users SET reset_token='$random_str' where id=$user_id;";

            $result_update = $conn->query($update_sql);

            if ($result_update) {

                //send email to user;
                $url = $_ENV['WEBSITE_HOST'] . "/reset-password.php?token=$random_str";

                $response['success'] = true;
                $response['message'] = "We have sent forgot password email. Please check.";

            } else {
                $response['message'] = "Unable to initiate forgot password.";
            }

        } else {
            $response['message'] = "No user with provided email id.";
        }

    } else {
        $response['message'] = "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();

} else {
    $response['message'] = "Please provide your email id";
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
die();
