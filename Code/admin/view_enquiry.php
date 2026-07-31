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

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: support.php");
    exit();
}

$success = '';
$error = '';

// Xử lý khi Admin gửi phản hồi (Reply)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reply_content = trim($_POST['admin_reply'] ?? '');

    if (!empty($reply_content)) {
        $stmt = $conn->prepare("UPDATE enquiries SET admin_reply = ?, status = 'Replied' WHERE id = ?");
        if ($stmt->execute([$reply_content, $id])) {
            $success = "Reply sent successfully!";
        } else {
            $error = "Failed to send reply.";
        }
    } else {
        $error = "Reply content cannot be empty!";
    }
}

// Lấy thông tin chi tiết yêu cầu hỗ trợ
$stmt = $conn->prepare("SELECT e.*, u.full_name, u.email FROM enquiries e JOIN users u ON e.user_id = u.id WHERE e.id = ?");
$stmt->execute([$id]);
$enquiry = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$enquiry) {
    header("Location: support.php");
    exit();
}

$title = 'View Enquiry - Admin Panel';
include 'view_enquiry.html.php';
?>