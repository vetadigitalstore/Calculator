<?php
session_start(); // সেশন শুরু করা

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// PHPMailer ফাইল ইমপোর্ট করা
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }

    $otp = rand(100000, 999999); // ৬ সংখ্যার র‍্যান্ডম OTP তৈরি করা
    $_SESSION["otp"] = $otp;
    $_SESSION["otp_expiry"] = time() + 300; // ৫ মিনিটের জন্য বৈধ

    // Gmail SMTP সেটআপ
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'vetadigitalstore@gmail.com'; // আপনার Gmail ID
        $mail->Password = 'ngzulquwfgdcpxdq'; // ২য় ছবির App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // ইমেইল কনফিগারেশন
        $mail->setFrom('vetadigitalstore@gmail.com', 'Veta Digital Store'); // প্রেরক ইমেইল
        $mail->addAddress($email);
        $mail->Subject = "Your OTP Code";
        $mail->Body = "Your OTP code is: $otp\nThis OTP is valid for 5 minutes.";

        if ($mail->send()) {
            echo "OTP sent successfully!";
        } else {
            echo "Failed to send OTP!";
        }
    } catch (Exception $e) {
        echo "Error: " . $mail->ErrorInfo;
    }
}
?>