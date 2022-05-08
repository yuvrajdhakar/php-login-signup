<?php 
function generateRandomString($length = 10) {
   return bin2hex(random_bytes($length));
}