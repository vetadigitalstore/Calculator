<?php
session_start(); // সেশন শুরু করা

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = $_POST["otp"];

    // যদি OTP বা এর মেয়াদ না থাকে
    if (!isset($_SESSION["otp"]) || !isset($_SESSION["otp_expiry"])) {
        echo "OTP not found!";
        exit;
    }

    // যদি OTP-এর মেয়াদ শেষ হয়ে যায়
    if (time() > $_SESSION["otp_expiry"]) {
        echo "OTP expired!";
        session_destroy(); // সেশন ধ্বংস করা
        exit;
    }

    // যদি OTP মিলিয়ে যায়
    if ($otp == $_SESSION["otp"]) {
        $_SESSION["otp_verified"] = true; // ✅ সেশন সেট করা হলো
        echo "OTP verified successfully"; // ✅ সফল হলে মেসেজ পাঠাবে
        exit;
    } else {
        echo "Invalid OTP!";
        exit;
    }
}
?>