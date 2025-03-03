<?php
$file = "data.json";

if (!file_exists($file)) {
    echo json_encode([]);
    exit;
}

$jsonData = file_get_contents($file);
echo $jsonData;
?>