<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your_email@gmail.com';   // your Gmail
        $mail->Password   = 'your_app_password';      // Gmail App password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Who sends the mail
        $mail->setFrom($email, $name);   // client’s email & name (from form)

        // Who receives the mail (YOU)
        $mail->addAddress('your_email@gmail.com', 'Mishra Interior');  

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission from $name";
        $mail->Body    = "<b>Name:</b> $name <br> 
                          <b>Email:</b> $email <br><br>
                          <b>Message:</b><br> $message";

        $mail->send();
        echo "Message has been sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
