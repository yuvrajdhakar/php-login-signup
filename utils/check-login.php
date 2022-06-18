<?php

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?error='Please login first.");
    die();
}