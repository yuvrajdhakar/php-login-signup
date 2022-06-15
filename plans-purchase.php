<?php
session_start();

include "db-connection.php";
// This is your test secret API key.
\Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);

header('Content-Type: application/json');

$qty = $_POST['qty'];

$plan_id = $_POST['plan_id'];

$price_data = $conn->query("select price_id from plans where id=$plan_id");

$price_id = $price_data->fetch_assoc()['price_id'];

$user_id = $_SESSION['user_id'];

$conn->query("INSERT INTO plans_orders (plan_id, qty, user_id) values ($plan_id, $qty,$user_id)");

$checkout_session = \Stripe\Checkout\Session::create([
    'line_items' => [[
        # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
        'price' => $price_id,
        'quantity' => $qty,
    ]],
    'client_reference_id' => $conn->insert_id,
    'mode' => 'subscription',
    'success_url' => $_ENV['WEBSITE_HOST'] . '/plans.php?session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => $_ENV['WEBSITE_HOST'] . '/plans.php',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);