<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: home.php?error='You don't have permission for that page.");
    die();
}

use GuzzleHttp\Client;


require "db-connection.php";

$body = file_get_contents('php://input');

$body_data = json_decode($body);
//
//$from = $_POST['from'];
//$to = $_POST['to'];
//$amount = $_POST['amount'];

$from = $body_data->from;
$to = $body_data->to;
$amount = $body_data->amount;

$response = [
    'success' => false,
    'message' => '',
    'data' => null
];

if (!empty($from) && !empty($to) && !empty($amount)) {

    try {

        $client = new GuzzleHttp\Client();

        $response_api = $client->request("GET", "https://api.apilayer.com/exchangerates_data/convert", [
            'query' => [
                'from' => $from,
                'to' => $to,
                'amount' => $amount
            ],
            'headers' => [
                'apikey' => $_ENV['EXCHANGE_API_KEY']
            ]
        ]);

        if ($response_api->getStatusCode() == 200) {

            $body = $response_api->getBody();

            $rate = $response_api->getHeader('RateLimit-Remaining')[0];


            $body_parsed = json_decode($body);

            $response['data'] = [
                'result' => $body_parsed->result,
                'result_title' => $amount . " " . $from . " converted to " . $to . " at the rate of " . $body_parsed->info->rate . " - remaining req: " . $rate
            ];

            $response['success'] = true;
            $response['message'] = "Please find result in data property.";
        } else {
            $response['message'] = "Not able to get conversion rate from API.";
        }

    }catch (GuzzleHttp\Exception\InvalidArgumentException $e){

    }
    catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }

} else {
    $response['message'] = "Please provide all required fields";
}

echo json_encode($response);
die();