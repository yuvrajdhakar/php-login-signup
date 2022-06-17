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
        $price_id = $row['price_id'];
        $role_name = $row['role_name'];
        $user_id = $_SESSION['user_id'];

        $checkout_session = \Stripe\Checkout\Session::create([
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
            'success_url' => $_ENV['WEBSITE_HOST'] . '/plan-view.php?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $_ENV['WEBSITE_HOST'] . '/plan-view.php',
        ]);

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