<?php
// ইউজারের ডাটা পড়া
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo "ডাটা পাওয়া যায়নি!";
    exit;
}

// **নতুন ইউজারের 14-ডিজিটের ইউনিক আইডি তৈরি**
$userId = substr(str_shuffle("12345678901234567890"), 0, 14);

// **ইউজারের ফোল্ডারের নাম সেট করা**
$userFolder = "users/" . $userId;

// **ফোল্ডার তৈরি করা (যদি না থাকে)**
if (!file_exists($userFolder)) {
    mkdir($userFolder, 0777, true);
}

// **প্রোফাইল ইমেজ সংরক্ষণ করা**
$imagePath = ""; // ডিফল্ট ইমেজ পাথ সেট করা
if (!empty($data["profileImage"])) {
    $imageData = $data["profileImage"];
    $imagePath = $userFolder . "/profile.jpg"; // ইমেজ সংরক্ষণের জন্য পাথ
    $imageData = explode(",", $imageData)[1]; // Base64 থেকে ডাটা আলাদা করা
    file_put_contents($imagePath, base64_decode($imageData));
}

// **ইউজারের তথ্য JSON ফাইল হিসেবে সংরক্ষণ করা**
$userData = [
    "id" => $userId,
    "name" => $data["name"],
    "dob" => $data["dob"],
    "gender" => $data["gender"],
    "email" => $data["email"],
    "mobile" => $data["mobile"],
    "userPassword" => $data["password"], // শুধুমাত্র পরীক্ষার জন্য
    "profileImage" => $imagePath, // ✅ ইমেজ সংরক্ষণ
    "dpName" => $data["dpName"], // ✅ `dpName` সংরক্ষণ
    "balance" => $data["balance"] // ✅ `balance` সংরক্ষণ
];

// **JSON ফাইলে ডাটা সংরক্ষণ**
file_put_contents($userFolder . "/data.json", json_encode($userData, JSON_PRETTY_PRINT));

echo "রেজিস্ট্রেশন সফল হয়েছে! আপনার আইডি: " . $userId;
?>