<?php

use GuzzleHttp\Client;

require "db-connection.php";

try {

    $client = new GuzzleHttp\Client();

    $response_api = $client->request("GET", "https://jsonplaceholder.typicode.com/posts");

    if ($response_api->getStatusCode() == 200) {

        $body = $response_api->getBody();

        $body_parsed = json_decode($body);

        echo "<ul>";
        foreach ($body_parsed as $item) {
            ?>
            <li><a href="blog-view.php?id=<?php echo $item->id; ?>"><?php echo $item->title; ?></a></li>
            <?php
        }

        echo "</ul>";

    } else {

    }

} catch (Exception $e) {

}