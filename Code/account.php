<?php
// account.php
session_start();
require_once 'includes/db.php';

// Chặn khách chưa đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$title = 'Account Settings - CheapDeals';
$success_msg = '';
$error_msg = '';

// 1. XỬ LÝ KHI NGƯỜI DÙNG BẤM CẬP NHẬT (US-28)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $full_name = trim($_POST['full_name']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    if (empty($full_name) || empty($phone) || empty($address)) {
        $error_msg = "Please fill in all required fields.";
    } else {
        try {
            $stmt = $conn->prepare("UPDATE users SET full_name = ?, phone = ?, address = ? WHERE id = ?");
            $stmt->execute([$full_name, $phone, $address, $_SESSION['user_id']]);
            
            // Cập nhật lại session để hiển thị trên Header
            $_SESSION['full_name'] = $full_name;
            $success_msg = "Profile updated successfully!";
        } catch (PDOException $e) {
            $error_msg = "System error: Could not update profile. " . $e->getMessage();
        }
    }
}

// 2. LẤY DỮ LIỆU HIỂN THỊ
try {
    // Lấy thông tin user hiện tại
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Lấy lịch sử đơn hàng của user này (US-22, US-29)
    $stmt_orders = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
    $stmt_orders->execute([$_SESSION['user_id']]);
    $orders = $stmt_orders->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

ob_start();
include 'template/html/account.html.php';
$output = ob_get_clean();

include 'template/html/header.html.php';
?>