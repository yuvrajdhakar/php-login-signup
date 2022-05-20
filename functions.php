<?php
function generateRandomString($length = 10)
{
    return bin2hex(random_bytes($length));
}

function redirect($target, $msg, $type)
{
    header("Location: {$target}?$type='$msg");
    die();
}

// Function to check the string is ends
// with given substring or not
function endsWith($string, $endString)
{
    $len = strlen($endString);
    if ($len == 0) {
        return true;
    }
    return (substr($string, -$len) === $endString);
}