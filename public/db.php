<?php
$host = "localhost";  // আপনার সার্ভারের ঠিকানা
$user = "root";  // MySQL ইউজারনেম (সাধারণত "root" হয়)
$password = "";  // MySQL পাসওয়ার্ড (খালি থাকলে "")
$database = "your_database_name";  // আপনার আসল ডাটাবেসের নাম দিন

// ডাটাবেস সংযোগ তৈরি করা
$conn = new mysqli($host, $user, $password, $database);

// যদি সংযোগ ব্যর্থ হয়
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>