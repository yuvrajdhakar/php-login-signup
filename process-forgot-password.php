<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "db-connection.php";

$email = $_POST['email'];

if (!empty($email))
{

    $sql = "select id, name, email from users where email = '$email' LIMIT 1";

    $result = $conn->query($sql);

    if ($result)
    {
        if ($result->num_rows > 0)
        {

            $row = $result->fetch_assoc();
            $user_id = $row['id'];

            $random_str = generateRandomString(20);

            $update_sql = "UPDATE users SET reset_token='$random_str' where id=$user_id;";

            $result_update = $conn->query($update_sql);

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

                    header("Location: forgot-password.php?success='We have sent forgot password email. Please check'");
                    die();
                }
                catch(Exception $e)
                {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

            }
            else
            {
                header("Location: forgot-password.php?error='Unable to initiate forgot password.'");
                die();
            }

        }
        else
        {
            header("Location: forgot-password.php?error='No user with provided email id.'");
            die();
        }

    }
    else
    {
        $err = "Error: " . $sql . "<br>" . $conn->error;

        header("Location: forgot-password.php?error='$err'");
        die();
    }

    $conn->close();

}
else
{
    header("Location: forgot-password.php?error='Please provide your email id'");
    die();
}

