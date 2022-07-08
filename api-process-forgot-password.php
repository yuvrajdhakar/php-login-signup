<?php
 
require "db-connection.php";

$email = $_POST['email'];

if (!empty($email))
{
    try {
        $client = new GuzzleHttp\Client();

        $response_api = $client->request("POST", $_ENV['WEBSITE_HOST'] . "/api/forgot.php", [
            'form_params' => [
                'email' => $email,
                
            ]
        ]);

        $body_parsed = json_decode($response_api->getBody());

        if ($body_parsed->success) {
            header("Location: api-forgot-password?success='" . $body_parsed->message . "'");
        } else {
            header("Location: api-forgot-password.php?error='{$body_parsed->message}'");
        }

        die();
    } catch (Exception $e) {
        header("Location: api-forgot-password.php?error='{$e->getMessage()}'");
        die();
    }

} else {
    //return back to signup form with error
    header("Location: api-signup.php?error='Please provide all required fields'");
    die();
}