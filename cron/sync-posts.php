<?php

use GuzzleHttp\Client;

require "../db-connection.php";

try {

    $client = new GuzzleHttp\Client();

    $response_api = $client->request("GET", "https://jsonplaceholder.typicode.com/posts");

    if ($response_api->getStatusCode() == 200) {

        $body = $response_api->getBody();

        $body_parsed = json_decode($body);

        foreach ($body_parsed as $item) {
            $sql = "INSERT INTO posts (id, title, userId, body) values ('{$item->id}', '{$item->title}', '{$item->userId}', '{$item->body}')";
            if ($conn->query($sql) === TRUE) {

                echo "Post {$item->id} inserted into db successfully";
            } else {
                echo "Post {$item->id} not able inserted into db.";
            }
        }

    } else {

    }

} catch (Exception $e) {

}