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

$error = '';
$success = '';
$editUser = null;
$edit_id = $_GET['edit'] ?? null;

// Xử lý XÓA người dùng
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    
    // Ngăn chặn admin tự xóa chính mình đang đăng nhập
    if ($delete_id == $_SESSION['user_id'] ?? 0) {
        $error = "You cannot delete your own admin account!";
    } else {
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        if ($stmt->execute([$delete_id])) {
            header("Location: users.php");
            exit();
        } else {
            $error = "Failed to delete user.";
        }
    }
}

// Xử lý CẬP NHẬT người dùng khi bấm Edit
if ($edit_id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $full_name = trim($_POST['full_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $role = trim($_POST['role'] ?? 'customer');

        if (!empty($full_name) && !empty($email)) {
            $stmt = $conn->prepare("UPDATE users SET full_name = ?, email = ?, phone = ?, role = ? WHERE id = ?");
            if ($stmt->execute([$full_name, $email, $phone, $role, $edit_id])) {
                $success = "User updated successfully!";
            } else {
                $error = "Failed to update user.";
            }
        } else {
            $error = "Please fill in all required fields!";
        }
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$edit_id]);
    $editUser = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Lấy danh sách toàn bộ users
$stmt = $conn->query("SELECT id, full_name, email, phone, role, created_at FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = 'Manage Users - Admin Panel';
include 'users.html.php';
?>