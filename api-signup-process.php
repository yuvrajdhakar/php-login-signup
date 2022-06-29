<?php

require "db-connection.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if (!empty($name) && !empty($email) && !empty($password) && !empty($confirm_password)) {
    //signup the user
    try {
        $client = new GuzzleHttp\Client();

        $response_api = $client->request("POST", $_ENV['WEBSITE_HOST'] . "/api/signup.php", [
            'form_params' => [
                'email' => $email,
                'password' => $password,
                'name' => $name,
                'confirm_password' => $confirm_password
            ]
        ]);

        $body_parsed = json_decode($response_api->getBody());

        if ($body_parsed->success) {
            header("Location: index.php?success='" . $body_parsed->message . "'");
        } else {
            header("Location: api-signup.php?error='{$body_parsed->message}'");
        }

        die();
    } catch (Exception $e) {
        header("Location: api-signup.php?error='{$e->getMessage()}'");
        die();
    }

} else {
    //return back to signup form with error
    header("Location: api-signup.php?error='Please provide all required fields'");
    die();
}
