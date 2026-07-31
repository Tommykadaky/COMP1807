<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Xử lý gửi phản hồi (Reply)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['msg_id'])) {
    $msg_id = $_POST['msg_id'];
    $reply_content = trim($_POST['reply'] ?? '');

    if (!empty($reply_content)) {
        // Cập nhật vào cột admin_reply và đổi status thành 'Replied'
        $stmt = $conn->prepare("UPDATE enquiries SET admin_reply = ?, status = 'Replied' WHERE id = ?");
        $stmt->execute([$reply_content, $msg_id]);
    }
}

// Lấy danh sách từ bảng enquiries
$stmt = $conn->query("SELECT * FROM enquiries ORDER BY created_at DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = 'Support Center - Admin Panel';
include 'support.html.php';
?>