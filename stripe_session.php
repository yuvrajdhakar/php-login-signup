<?php
session_start();

include "db-connection.php";
// This is your test secret API key.
\Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);

header('Content-Type: application/json');

$qty = $_POST['qty'];
$product_id = $_POST['product_id'];

$price_data = $conn->query("select price from products where id=$product_id");

$price = $price_data->fetch_assoc()['price'];

$user_id = $_SESSION['user_id'];


$checkout_session = \Stripe\Checkout\Session::create([
    'line_items' => [[
        # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
        //  'price' => $_ENV['STRIPE_PRICE_ID'],
        'price_data' => [
            'product_data' => [
                'name' => "My Test product"
            ],
            'currency' => "INR",
            'unit_amount' => $price * 100
        ],
        'quantity' => $qty,
    ]],
    'mode' => 'payment',
    'success_url' => $_ENV['WEBSITE_HOST'] . '/success.php?session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => $_ENV['WEBSITE_HOST'] . '/checkout.php',
]);
$session_id = $checkout_session->id;
//TODO Insert order data.
$conn->query("INSERT INTO orders (product_id, qty, user_id, session_id) values ($product_id, $qty,$user_id, '$session_id')");

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);