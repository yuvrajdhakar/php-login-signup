<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include "db-connection.php";

// This is your test secret API key.
\Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);


if (!empty($_GET['session_id'])) {
    $session_id = $_GET['session_id'];
    $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);

    if ($checkout_session->status == 'complete') {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //   $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = $_ENV['EMAIL_HOST']; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = $_ENV['EMAIL_USER_NAME']; //SMTP username
            $mail->Password = $_ENV['EMAIL_PASSWORD']; //SMTP password
            //   $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
            $mail->Port = $_ENV['EMAIL_PORT']; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            //Recipients
            $mail->setFrom($_ENV['EMAIL_FROM'], 'Mailer');

            $mail->addAddress($checkout_session->customer_details->email, $checkout_session->customer_details->name); //Add a recipient

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'Hi Your order successfully placed.';



            $mail->Body = "Hi ".$checkout_session->customer_details->name.", <br/> Your order successfully placed. Thank you make an payment of amount: Rs: ".($checkout_session->amount_total/100);

            $mail->send();

            echo "Hello from success page. Thank you for your payment";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }


} else {
    echo "No naughty business please.";
}
