<?php
$id = $_GET["id"];
$userFolder = "users/" . $id;

// ইউজার ফোল্ডার মুছতে চেষ্টা করা
if (is_dir($userFolder)) {
    array_map("unlink", glob("$userFolder/*")); // ফোল্ডারের সব ফাইল মুছে ফেলা
    rmdir($userFolder); // ফোল্ডার মুছে ফেলা
    echo json_encode(["message" => "User deleted successfully!"]);
} else {
    echo json_encode(["message" => "User not found!"]);
}
?>