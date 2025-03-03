<?php
$usersDir = "users/"; // ইউজারের মূল ফোল্ডার
$userList = [];

if (is_dir($usersDir)) {
    $folders = array_diff(scandir($usersDir), array('.', '..'));
    
    foreach ($folders as $folder) {
        $userDataFile = $usersDir . $folder . "/data.json";
        if (file_exists($userDataFile)) {
            $userData = json_decode(file_get_contents($userDataFile), true);
            $userData["profileImage"] = $usersDir . $folder . "/profile.jpg"; // ইমেজ পাথ সেট করা
            $userList[] = $userData;
        }
    }
}

header('Content-Type: application/json');
echo json_encode($userList, JSON_PRETTY_PRINT);
?>