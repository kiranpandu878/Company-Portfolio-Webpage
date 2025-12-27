<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $date = date("F j, Y");

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tirumani878@gmail.com'; // your Gmail
        $mail->Password = 'tcmidhtrvfrifbsc';      // Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // 1. Send to admin
        $mail->setFrom('tirumani878@gmail.com', 'Phantez Tech Website');
        $mail->addAddress('tirumani878@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = 'New Form Submission';
        $mail->Body    = "Name: $name<br>Email: $email<br>Message: $message";
        $mail->send();

        // 2. Load external confirmation template
        $templatePath = 'email_trigger.html';
        $template = file_get_contents($templatePath);

        // Replace placeholders with actual data
        $template = str_replace('{name}', htmlspecialchars($name), $template);
        $template = str_replace('{date}', $date, $template);

        // 3. Send to user
        $mail->clearAddresses();
        $mail->addAddress($email);
        $mail->Subject = 'Form Submitted Successfully';
        $mail->Body    = $template;
        $mail->isHTML(true);
        $mail->send();

        header("Location: contact.html"); 
        exit();

    }catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}
?>
