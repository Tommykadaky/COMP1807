<?php
// extras.php
session_start();
require_once 'includes/db.php';
$jsFile = 'template/js/extras.js';
    
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$title = 'Extra Devices & Data - CheapDeals';
$cssFile = 'template/css/packages.css'; 

try {
    // Lấy dữ liệu từ bảng extras mới
    $stmt = $conn->prepare("SELECT * FROM extras");
    $stmt->execute();
    $extras = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("System error: " . $e->getMessage());
}

ob_start();
include 'template/html/extras.html.php';
$output = ob_get_clean();

include 'template/html/header.html.php';
?>