<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once '../includes/db.php';

// Kiểm tra quyền Admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$title = 'Admin Dashboard - CheapDeals';

// Lấy các thống kê chính xác từ tên bảng trong hình
try {
    $userCount = $conn->query("SELECT COUNT(*) FROM users")->fetchColumn();
    $productCount = $conn->query("SELECT COUNT(*) FROM extras")->fetchColumn(); // Đổi từ products thành extras
    $packageCount = $conn->query("SELECT COUNT(*) FROM packages")->fetchColumn();
    $orderCount = $conn->query("SELECT COUNT(*) FROM orders")->fetchColumn();
} catch (Exception $e) {
    $userCount = 0;
    $productCount = 0;
    $packageCount = 0;
    $orderCount = 0;
}

// Gọi file giao diện HTML riêng
include 'dashboard.html.php';
?>