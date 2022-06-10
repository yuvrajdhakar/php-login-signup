<?php
use GuzzleHttp\Client;

require "db-connection.php";

$id = $_GET['id'];

if(!empty($id)){


    $client = new GuzzleHttp\Client();

    $response_api = $client->request("GET", "https://jsonplaceholder.typicode.com/posts/$id");

    if ($response_api->getStatusCode() == 200) {

        $body = $response_api->getBody();

        $body_parsed = json_decode($body);

        echo $body_parsed->title;
        echo $body_parsed->body;
    }


    $response_api_comments = $client->request("GET", "https://jsonplaceholder.typicode.com/posts/$id/comments");

    if ($response_api_comments->getStatusCode() == 200) {

        $body_comments = $response_api_comments->getBody();

        $body_parsed_comments = json_decode($body_comments);

        var_dump($body_parsed_comments);

    }
}