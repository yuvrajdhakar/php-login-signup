<?php
require "db-connection.php";

$email = $_POST['email'];


if(!empty($email)){

    $sql = "select id, name, email from users where email = '$email' LIMIT 1";

    $result = $conn->query($sql);

  if ($result) {
    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        $random_str = generateRandomString(20);

        $update_sql = "UPDATE users SET reset_token='$random_str' where id=$user_id;";

        $result_update = $conn->query($update_sql);

        if($result_update){

            //send email to user;
        echo    $url = $_ENV['WEBSITE_HOST']."/reset-password.php?token=$random_str";


        }else{
            header("Location: forgot-password.php?error='Unable to initiate forgot password.'");
            die();
        }

    }else{
        header("Location: forgot-password.php?error='No user with provided emial id.'");
        die();
    }

   } else {
     $err = "Error: " . $sql . "<br>" . $conn->error;

     header("Location: forgot-password.php?error='$err'");
     die();
   }
   
   $conn->close();

}else{
    header("Location: forgot-password.php?error='Please provide your email id'");
    die();
}