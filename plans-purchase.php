<?php
session_start();

include "db-connection.php";
// This is your test secret API key.
\Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);

$qty = $_POST['qty'];

$plan_id = $_POST['plan_id'];

if ($qty && $plan_id) {

    $price_data = $conn->query("select price_id, role_name from plans where id=$plan_id");
    if ($price_data) {

        $row = $price_data->fetch_assoc();

        if ($_SESSION['role'] == $row['role_name']) {
            header("Location: plan-view.php?error='This plan is already active on your account.");
            die();
        }

        $price_id = $row['price_id'];
        $role_name = $row['role_name'];
        $user_id = $_SESSION['user_id'];

        //get user details
        $user_data = $conn->query("select * from users where id=$user_id limit 1");
        $user_row = $user_data->fetch_assoc();

        $session_data = [
            'customer_email' => $_SESSION['email'],
            'line_items' => [[
                'price' => $price_id,
                'quantity' => $qty,
            ]],
            'metadata' => [
                'plan_id' => $plan_id,
                'user_id' => $user_id,
                'role_name' => $role_name
            ],
            'subscription_data' => [
                'metadata' => [
                    'plan_id' => $plan_id,
                    'user_id' => $user_id,
                    'role_name' => $role_name
                ]
            ],
            //  'client_reference_id' => $conn->insert_id,
            'mode' => 'subscription',
            'success_url' => $_ENV['WEBSITE_HOST'] . '/plan-view.php?stripe_checkout_session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $_ENV['WEBSITE_HOST'] . '/plan-view.php',
        ];

        if($user_row['customer_id']){
            $session_data['customer'] =$user_row['customer_id'];
            unset($session_data['customer_email']);
        }

        $checkout_session = \Stripe\Checkout\Session::create($session_data);

        header("HTTP/1.1 303 See Other");
        header("Location: " . $checkout_session->url);

    } else {
        header("Location: plan-view.php?error='plan not found");
        die();
    }
} else {
    header("Location: plan-view.php?error='Required fields not found");
    die();
}