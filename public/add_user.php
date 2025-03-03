<?php
$data = json_decode(file_get_contents("php://input"), true);
if (!$data) die(json_encode(["message" => "Invalid data"]));

// **নতুন ইউজারের 14-ডিজিটের ইউনিক আইডি তৈরি**
$userId = substr(str_shuffle("12345678901234567890"), 0, 14);

// **ইউজারের ফোল্ডারের নাম সেট করা**
$userFolder = "users/" . $userId;

// **ফোল্ডার তৈরি করা (যদি না থাকে)**
if (!file_exists($userFolder)) {
    mkdir($userFolder, 0777, true);
}



// প্রোফাইল ইমেজ সেট করা (ডিফল্ট ইমেজ থাকলে)
$imagePath = "default.png";
if (!empty($data["profileImage"])) {
    $imagePath = $userFolder . "/image/logo.svg"; 
    file_put_contents($imagePath, base64_decode($data["profileImage"])); 
}

// ইউজারের তথ্য JSON ফাইলে সংরক্ষণ
$userData = [
    "id" => $userId,
    "name" => $data["name"],
    "dob" => $data["dob"],
    "gender" => $data["gender"],
    "email" => $data["email"],
    "mobile" => $data["mobile"],
    "balance" => $data["balance"],
    "userPassword" => password_hash($data["password"], PASSWORD_DEFAULT), // পাসওয়ার্ড হ্যাশ করা
    "profileImage" => $imagePath
];

file_put_contents("$userFolder/data.json", json_encode($userData));

echo json_encode(["message" => "User created successfully!", "id" => $userId]);
?>