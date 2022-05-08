<?php
// Start the session
session_start();

require "db-connection.php";

$email = $_POST['email'];
$password = $_POST['password'];

if( !empty($email) && !empty($password)){
  $sql = "select id, name, email,password from users where email = '$email' LIMIT 1";

  $result = $conn->query($sql);

  if ($result) {
    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        if($password == $row['password']){

            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];

            $_SESSION['user_id'] = $row['id'];

            header("Location: home.php");
            die();
        }else{
            header("Location: index.php?error='Your password is incorrect.'");
        die();
        }

       
    }else{
        header("Location: index.php?error='No user with provided emial id.'");
        die();
    }

   } else {
     $err = "Error: " . $sql . "<br>" . $conn->error;

     header("Location: index.php?error='$err'");
     die();
   }
   
   $conn->close();

}else{
    header("Location: index.php?error='Please provide login details'");
    die();
}