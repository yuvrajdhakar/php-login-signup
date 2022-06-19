<?php
// Start the session
session_start();

require "db-connection.php";

$email = $_POST['email'];
$password = $_POST['password'];

if( !empty($email) && !empty($password)){

    try {
        $client = new GuzzleHttp\Client();

        $response_api = $client->request("POST", $_ENV['WEBSITE_HOST']."/api/login.php", [
            'form_params' => [
                'email' => $email,
                'password' => $password
            ]
        ]);

        $body_parsed = json_decode($response_api->getBody());

        if($body_parsed->success ){
            $user = $body_parsed->data;

            $_SESSION['name'] = $user->name;
            $_SESSION['email'] = $user->email;

            $_SESSION['user_id'] = $user->user_id;
            $_SESSION['role'] = $user->role;

            header("Location: home.php");
            die();

        }else{
            header("Location: api-login.php?error='{$body_parsed->message}'");
            die();
        }

    }catch (Exception $e){
        header("Location: api-login.php?error='{$e->getMessage()}'");
        die();
    }
}else{
    header("Location: api-login.php?error='Please provide login details'");
    die();
}