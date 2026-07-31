<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once 'includes/db.php';

// Kiểm tra đăng nhập của khách hàng
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$success = '';
$error = '';

// Xử lý khi khách hàng gửi câu hỏi/support mới
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!empty($subject) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO enquiries (user_id, subject, message, status, created_at) VALUES (?, ?, ?, 'Open', NOW())");
        if ($stmt->execute([$user_id, $subject, $message])) {
            $success = "Your support request has been sent successfully!";
        } else {
            $error = "Failed to send request. Please try again.";
        }
    } else {
        $error = "Please fill in all required fields!";
    }
}

// Lấy danh sách lịch sử support của riêng user này
$stmt = $conn->prepare("SELECT * FROM enquiries WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$enquiries = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = 'Support Center';

// Gọi file giao diện HTML riêng biệt
include 'template/html/support.html.php';
?>