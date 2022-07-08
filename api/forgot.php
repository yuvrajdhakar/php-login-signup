<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "db-connection.php";

$email = $_POST['email'];
$response = [
    'success' => false,
    'message' => "",
    "data" => null
];

if (!empty($email))
{

    $sql = "select id, name, email from users where email = '$email' LIMIT 1";

   

    $result = $conn->query($sql);

    if ($conn->query($sql) === TRUE) {
        $response['success'] = true;
        $response['message'] = "Your account created successfully.";
    } else {
        $response['message'] = "Error: " . $sql . "<br>" . $conn->error;
    }

    if ($result)
    {
        if ($result->num_rows > 0)
        {

            $row = $result->fetch_assoc();
            $user_id = $row['id'];

            $random_str = generateRandomString(20);

            $update_sql = "UPDATE users SET reset_token='$random_str' where id=$user_id;";

            $result_update = $conn->query($update_sql);

            if ($conn->query($update_sql) === TRUE) {
                $response['success'] = true;
                $response['message'] = "Your account created successfully.";
            } else {
                $response['message'] = "Error: " . $sql . "<br>" . $conn->error;
            }

            if ($result_update)
            {

                //send email to user;
                $url = $_ENV['WEBSITE_HOST'] . "/reset-password.php?token=$random_str";

                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try
                {
                  
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
//                    $mail->isSMTP(); //Send using SMTP
//                    $mail->Host = $_ENV['EMAIL_HOST']; //Set the SMTP server to send through
//                    $mail->SMTPAuth = true; //Enable SMTP authentication
//                    $mail->Username = $_ENV['EMAIL_USER_NAME']; //SMTP username
//                    $mail->Password = $_ENV['EMAIL_PASSWORD']; //SMTP password
//                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
//                    $mail->Port = $_ENV['EMAIL_PORT']; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
//                    //Recipients
                    $mail->setFrom($_ENV['EMAIL_FROM'], 'Mailer');

                    $mail->addAddress($email, $row['name']); //Add a recipient
                
                    //Content
                    $mail->isHTML(true); //Set email format to HTML
                    $mail->Subject = 'Forgot password';
                    $mail->Body = "Hi ".$row['name']. ", <br/> You have requested password reset. Please <a href='$url'>click here</a> to reset your password." ;
                 
                    $mail->send();

                    $response['message'] = "We have sent forgot password email. Please check.";
                    
                }
                catch(Exception $e)
                {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

            }
            else
            {
                $response['message'] = "Unable to initiate forgot password.";
                 
            }

        }
        else
        {
            $response['message'] = "No user with provided email id.";
             
        }

    }
    else
    {
        $err = "Error: " . $sql . "<br>" . $conn->error;

        $response['message'] = "$err";
         
    }

    $conn->close();

}
else
{
    $response['message'] = "Please provide your email id";
     
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
die();
