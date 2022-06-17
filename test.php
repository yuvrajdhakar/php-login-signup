<?php

session_start();

include "db-connection.php";
// This is your test secret API key.
\Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);


$subscription = \Stripe\Subscription::retrieve(
    'sub_1LBWCqIc3sUqy6RmYMXUE3U6',
    []
);

echo "<pre>";

var_dump($subscription);

echo "</pre>";
