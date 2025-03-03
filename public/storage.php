<?php
session_start();
header('Content-Type: application/json'); // Ensure JSON response

// Ensure user is logged in
if (!isset($_SESSION['user'])) {
    die(json_encode(["error" => "Unauthorized access"]));
}

$user = preg_replace("/[^a-zA-Z0-9-_]/", "", $_SESSION['user']); // Validate username
$user_folder = "storage/$user";
$user_json_file = "$user_folder/data.json";

// Create user folder if it doesn't exist
if (!is_dir($user_folder)) {
    mkdir($user_folder, 0777, true);
}

// Initialize JSON file if not exists
if (!file_exists($user_json_file)) {
    file_put_contents($user_json_file, json_encode(["folders" => [], "files" => []], JSON_PRETTY_PRINT));
}

$data = json_decode(file_get_contents($user_json_file), true);

// Handle folder creation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['folder_name'])) {
    $folder_name = preg_replace("/[^a-zA-Z0-9-_]/", "", $_POST['folder_name']);
    $folder_path = "$user_folder/$folder_name";
    
    if (!is_dir($folder_path)) {
        mkdir($folder_path, 0777, true);
        $data['folders'][] = $folder_name;
        file_put_contents($user_json_file, json_encode($data, JSON_PRETTY_PRINT));
        echo json_encode(["success" => "Folder created", "folder" => $folder_name]);
    } else {
        echo json_encode(["error" => "Folder already exists"]);
    }
    exit;
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file']) && isset($_POST['folder_name'])) {
    $folder_name = preg_replace("/[^a-zA-Z0-9-_]/", "", $_POST['folder_name']);
    $folder_path = "$user_folder/$folder_name";
    
    if (!is_dir($folder_path)) {
        die(json_encode(["error" => "Folder does not exist"]));
    }
    
    $file_name = basename($_FILES['file']['name']);
    $file_path = "$folder_path/$file_name";
    
    if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
        $data['files'][] = ["folder" => $folder_name, "name" => $file_name, "path" => $file_path];
        file_put_contents($user_json_file, json_encode($data, JSON_PRETTY_PRINT));
        echo json_encode(["success" => "File uploaded", "file" => $file_name]);
    } else {
        echo json_encode(["error" => "File upload failed"]);
    }
    exit;
}

// Display user files and folders
echo json_encode($data);
?>