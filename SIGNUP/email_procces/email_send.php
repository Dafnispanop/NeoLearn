<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


$mail = new PHPMailer(true);    //Create an instance; passing `true` enables exceptions

//Send Email verification code
function sendMail_verify($email, $verify_token) {
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function

    
    global $mail;
    try{
        
        //Server settings
        $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.outlook.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'neolearn@outlook.com';                     //SMTP username
        $mail->Password   = 'Neo12345learn';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        $mail->setFrom('neolearn@outlook.com', 'NeoLearn'); //Recipients
        $mail->addAddress($email);       //Add a recipient
        
        $mail->isHTML(true);   //Set email format to HTML                              //Set email format to HTML
        $mail->Subject = 'Email verification ';
        $mail->Body    = '<h5><p>Verify email adress to Login with the below given link </h5>
                          <br/><br/>
                          <a href="http://localhost/NEOLEARN/email_verify.php?token=$verify_token'; 
        $mail->send();
        //echo 'Message has been sent';
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
    
}


?>