<?php
header("Content-Type: application/json"); // JSON রেসপন্স সেট করা

$usersDir = "users/";

$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input['id']) || empty($input['id'])) {
    echo json_encode(["message" => "Invalid request: User ID is missing"]);
    exit;
}

$userDir = $usersDir . $input['id'] . "/";
$userFile = $userDir . "data.json";

if (!file_exists($userFile)) {
    echo json_encode(["message" => "Error: User not found"]);
    exit;
}

// নতুন ইউজার ডাটা আপডেট করা
$newUserData = [
    "id" => $input['id'],
    "name" => isset($input['name']) ? $input['name'] : "",
    "dob" => isset($input['dob']) ? $input['dob'] : "",
    "gender" => isset($input['gender']) ? $input['gender'] : "",
    "email" => isset($input['email']) ? $input['email'] : "",
    "mobile" => isset($input['mobile']) ? $input['mobile'] : "",
    "balance" => isset($input['balance']) ? $input['balance'] : "0"
];

// নতুন JSON ডাটা সংরক্ষণ করা
if (file_put_contents($userFile, json_encode($newUserData, JSON_PRETTY_PRINT))) {
    echo json_encode(["message" => "User updated successfully"]);
} else {
    echo json_encode(["message" => "Error updating user data"]);
}
?>