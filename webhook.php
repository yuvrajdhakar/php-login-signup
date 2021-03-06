<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "db-connection.php";

// This is your test secret API key.
\Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);

// This is your Stripe CLI webhook secret for testing your endpoint locally.
$endpoint_secret = $_ENV['STRIPE_WEBHOOK_SECRET'];

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
    $event = \Stripe\Webhook::constructEvent(
        $payload, $sig_header, $endpoint_secret
    );
} catch (\UnexpectedValueException $e) {
    // Invalid payload
    http_response_code(400);
    exit();
} catch (\Stripe\Exception\SignatureVerificationException $e) {
    // Invalid signature
    http_response_code(400);
    exit();
}

// Handle the event
switch ($event->type) {
    case 'checkout.session.completed':
        $session = $event->data->object;

        $session_id = $session->id;
        $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);

        if ($checkout_session->status == 'complete') {
            $mail = new PHPMailer(true);

            //TODO update the order status to PAID
            $conn->query("UPDATE orders set status='paid' WHERE session_id='$session_id'");

            try {
                //Server settings
                //   $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
//                $mail->isSMTP(); //Send using SMTP
//                $mail->Host = $_ENV['EMAIL_HOST']; //Set the SMTP server to send through
//                $mail->SMTPAuth = true; //Enable SMTP authentication
//                $mail->Username = $_ENV['EMAIL_USER_NAME']; //SMTP username
//                $mail->Password = $_ENV['EMAIL_PASSWORD']; //SMTP password
//                //   $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
//                $mail->Port = $_ENV['EMAIL_PORT']; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
//                //Recipients
                $mail->setFrom($_ENV['EMAIL_FROM'], 'Mailer');

                $mail->addAddress($checkout_session->customer_details->email, $checkout_session->customer_details->name); //Add a recipient

                //Content
                $mail->isHTML(true); //Set email format to HTML
                $mail->Subject = 'Hi Your order successfully placed.';


                $mail->Body = "Hi " . $checkout_session->customer_details->name . ", <br/> Your order successfully placed. Thank you make an payment of amount: Rs: " . ($checkout_session->amount_total / 100);

                $mail->send();

                echo "Hello from success page. Thank you for your payment";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        break;
    case 'customer.subscription.created':
    case 'customer.subscription.updated':
        $subscription = $event->data->object;
        if ($subscription->status == 'active') {
            $metaData = $subscription->metadata;

            $user_data = $conn->query("select * from users where id={$metaData->user_id} limit 1");
            $user_row = $user_data->fetch_assoc();

            if($user_row['subscription_id']){

                $current_subscription = \Stripe\Subscription::retrieve($user_row['subscription_id']);

                $current_subscription->cancel(
                        [
                            'prorate' => true
                        ]
                    );
            }

            $conn->query("update users set role='{$metaData->role_name}', subscription_id='{$subscription->id}', customer_id='{$subscription->customer}' where id='{$metaData->user_id}'");
        }
        break;
    case 'customer.subscription.deleted':
        $subscription = $event->data->object;

        if ($subscription->status != 'active') {
            $metaData = $subscription->metadata;
            $conn->query("update users set role='disabled', subscription_id=null where id='{$metaData->user_id}' and subscription_id='{$subscription->id}'");
        }
        break;
    default:
        echo 'Received unknown event type ' . $event->type;
}

http_response_code(200);