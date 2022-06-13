<?php

include "db-connection.php";
// This is your test secret API key.
\Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);

header('Content-Type: application/json');

$qty = $_POST['qty'];

$checkout_session = \Stripe\Checkout\Session::create([
    'line_items' => [[
        # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
        //  'price' => $_ENV['STRIPE_PRICE_ID'],
        'price_data' => [
            'product_data' => [
                'name' => "My Test product"
            ],
            'currency' => "INR",
            'unit_amount' => '1200'
        ],
        'quantity' => $qty,
    ]],
    'mode' => 'payment',
    'success_url' => $_ENV['WEBSITE_HOST'] . '/success.php?session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => $_ENV['WEBSITE_HOST'] . '/cancel.php',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);