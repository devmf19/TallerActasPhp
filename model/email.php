<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
class Email {
    public static function send($toSend, $issue, $body){
        try {   
            $mail = new PHPMailer(true);                                  //Send using SMTP
            $mail->isSMTP();
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
            $mail->Host       = 'smtp.gmail.com'; 
            $mail->Port       = 587; 
            $mail->Username   = 'actasunicortaller@gmail.com';                     //SMTP username
            $mail->Password   = 'teldgmvqortfuhjd';
            
            $mail->setFrom('actasunicortaller@gmail.com', 'Actas Unicor');
            $mail->addAddress($toSend); 
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $issue;
            $mail->Body = $body;
            $mail->CharSet = 'UTF-8';
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
