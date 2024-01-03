<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
require '../vandor/PHPMailer/PHPMailer-master/src/Exception.php';
require '../vandor/PHPMailer/PHPMailer-master/src/PHPMailer.php';
require '../vandor/PHPMailer/PHPMailer-master/src/SMTP.php';

$email1 = $_REQUEST['email'];
$mail = new PHPMailer(true);

try {
    // Server settings
 
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // hoặc 'xxx.xxx.xxx.xxx'
    $mail->SMTPAuth = true;
    $mail->Username = 'thangtran081003@gmail.com';
    $mail->Password = 'hdjk hrwt fxvu hfjs';
    $mail->SMTPSecure = 'tls';   
    $mail->Port = 587; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
    // Recipients
    $mail->setFrom('thangtran081003@gmail.com', 'bookstore');
    $mail->addAddress($email1, 'thắng'); // Add a recipient
    
    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');        // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
    // Content
    $mail->isHTML(true); // Set email format to HTML
    
    // Tạo mã xác nhận gồm 6 số
    $resetCode = rand(100000, 999999);

    $mail->Subject = 'Websitebookstore';
    $mail->Body    = 'Đây là mã xác minh của bạn:<b>' . $resetCode. '</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
    

    header("-password.php");
    exit; // Đảm bảo dừng thực thi mã sau khi chuyển hướng
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
