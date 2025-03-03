<?php
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data["email"]) || !isset($data["newPassword"])) {
    echo json_encode(["status" => "error", "message" => "ইমেল বা নতুন পাসওয়ার্ড পাওয়া যায়নি!"]);
    exit;
}

$email = $data["email"];
$newPassword = $data["newPassword"];

$usersFolder = "users/";
$userFound = false;
$userFilePath = "";

foreach (glob($usersFolder . "*/data.json") as $file) {
    $userData = json_decode(file_get_contents($file), true);
    if ($userData["email"] === $email) {
        $userFound = true;
        $userFilePath = $file;
        break;
    }
}

if (!$userFound) {
    echo json_encode(["status" => "error", "message" => "এই ইমেলটি কোনো অ্যাকাউন্টের সাথে মিলছে না!"]);
    exit;
}

// **পাসওয়ার্ড আপডেট করা**
$userData["userPassword"] = $newPassword;
file_put_contents($userFilePath, json_encode($userData, JSON_PRETTY_PRINT));

echo json_encode(["status" => "success", "message" => "পাসওয়ার্ড সফলভাবে আপডেট হয়েছে!"]);
?>