<?php
session_start();
$_SESSION['name'] = null;
$_SESSION['email'] = null;
$_SESSION['user_id'] = null;
$_SESSION['role'] = null;

header("Location: index.php?success='Logout successfully'");
die();