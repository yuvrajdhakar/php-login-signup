<?php 
function generateRandomString($length = 10) {
   return bin2hex(random_bytes($length));
}

function redirect($target, $msg, $type){
    header("Location: {$target}?$type='$msg");
    die();
}