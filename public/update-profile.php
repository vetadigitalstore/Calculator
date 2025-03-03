<?php
$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
    echo "ডাটা পাওয়া যায়নি!";
    exit;
}

$userId = $data["id"];
$userFolder = "users/" . $userId;
$filePath = $userFolder . "/data.json";

if (!file_exists($filePath)) {
    echo "ইউজার পাওয়া যায়নি!";
    exit;
}

// আগের ডাটা পড়া
$existingData = json_decode(file_get_contents($filePath), true);

// নতুন ডাটা আপডেট
$existingData["name"] = $data["name"];
$existingData["dob"] = $data["dob"];
$existingData["gender"] = $data["gender"];
$existingData["email"] = $data["email"];
$existingData["mobile"] = $data["mobile"];

// **শুধু তখনই প্রোফাইল ইমেজ আপডেট করবো, যখন ইউজার নতুন ইমেজ আপলোড করবে**
if (!empty($data["profileImage"]) && strpos($data["profileImage"], "data:image") === 0) {
    $imagePath = $userFolder . "/profile.jpg";
    
    // Base64 ডাটা থেকে ছবির অংশ বের করা
    $imageParts = explode(",", $data["profileImage"]);
    
    if (count($imageParts) === 2) {
        file_put_contents($imagePath, base64_decode($imageParts[1]));
        $existingData["profileImage"] = $imagePath;
    }
}

// নতুন তথ্য সংরক্ষণ
file_put_contents($filePath, json_encode($existingData, JSON_PRETTY_PRINT));

echo "প্রোফাইল আপডেট সফল হয়েছে!";
?>