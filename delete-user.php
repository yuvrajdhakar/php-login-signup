<?php
session_start();

$id = $_POST['id'];

if ($id && !empty($id)) {
    include "db-connection.php";

    $del = "DELETE FROM users  WHERE id='$id';";
    $delet = $conn->query($del);

    if($delet){
        header("Location: users.php?success='User deleted sucessfully!");
        die();
    }else{
        header("Location: users.php?error='Unable to delete");
    die();
    }

} else {
    header("Location: users.php?error='Url is invalid");
    die();
}