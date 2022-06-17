<?php
// Start the session
session_start();

require "db-connection.php";

$email = $_POST['email'];
$password = $_POST['password'];

if( !empty($email) && !empty($password)){

 $sql = "select id, name, email,password, status, role from users where email = '$email' LIMIT 1";

  $stmt = $conn->prepare("select id, name, email,password, status, role from users where email = ? LIMIT 1");
  $stmt->bind_param("s", $email);

   $stmt->execute();
  // $result = $stmt->get_result(); //TODO use bind_result
    $stmt->bind_result($row_id, $row_name, $row_email, $row_password, $row_status, $row_role);
  if ($stmt->fetch()) {
       // $row = $result->fetch_assoc();

        if( password_verify($password, $row_password)  ){

            if($row_status == 1) {
                $_SESSION['name'] = $row_name;
                $_SESSION['email'] = $row_email;

                $_SESSION['user_id'] = $row_id;
                $_SESSION['role'] = $row_role;

                //TODO if role name is 'disabled' redirect to plans page. except the admin


                header("Location: home.php");
                die();
            }else{
                header("Location: index.php?error='Your account is disabled.'");
                die();
            }
        }else{
            header("Location: index.php?error='Your password is incorrect.'");
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