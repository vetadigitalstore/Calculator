<?php
$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
    echo json_encode(["success" => false, "message" => "ডাটা পাওয়া যায়নি!"]);
    exit;
}

$userInput = $data["userInput"];
$password = $data["password"];

$usersFolder = "users/";
$foundUser = null;

foreach (scandir($usersFolder) as $folder) {
    if ($folder === "." || $folder === "..") continue;
    $filePath = $usersFolder . $folder . "/data.json";
    
    if (file_exists($filePath)) {
        $userData = json_decode(file_get_contents($filePath), true);
        if ($userData && ($userData["email"] === $userInput || $userData["mobile"] === $userInput || $userData["id"] === $userInput)) {
            if ($userData["userPassword"] === $password) {
                $foundUser = $userData;
            }
            break;
        }
    }
}

if ($foundUser) {
    echo json_encode(["success" => true, "data" => $foundUser]);
} else {
    echo json_encode(["success" => false, "message" => "লগইন ব্যর্থ!"]);
}
?>