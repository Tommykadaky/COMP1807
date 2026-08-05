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
$editPackage = null;

// Xử lý Thêm hoặc Sửa Package
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $name = trim($_POST['name'] ?? '');
    $type = trim($_POST['type'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if (!empty($name) && !empty($type) && !empty($price)) {
        try {
            if ($id) {
                // Cập nhật package
                $stmt = $conn->prepare("UPDATE packages SET name = ?, type = ?, price = ?, description = ? WHERE id = ?");
                $stmt->execute([$name, $type, $price, $description, $id]);
                $success = "Package updated successfully!";
            } else {
                // Thêm mới package
                $stmt = $conn->prepare("INSERT INTO packages (name, type, price, description) VALUES (?, ?, ?, ?)");
                $stmt->execute([$name, $type, $price, $description]);
                $success = "Package added successfully!";
            }
        } catch (Exception $e) {
            $error = "Database Error: " . $e->getMessage();
        }
    } else {
        $error = "Please fill in all required fields (Name, Type, Price)!";
    }
}

// Xử lý Xóa Package
if (isset($_GET['delete'])) {
    $del_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM packages WHERE id = ?");
    $stmt->execute([$del_id]);
    header("Location: packages.php");
    exit();
}

// Lấy thông tin để sửa
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM packages WHERE id = ?");
    $stmt->execute([$edit_id]);
    $editPackage = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Lấy toàn bộ danh sách packages
$stmt = $conn->query("SELECT * FROM packages ORDER BY id DESC");
$packages = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = 'Manage Packages - Admin Panel';
include 'packages.html.php';
?>