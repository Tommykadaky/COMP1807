<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$error = '';
$success = '';
$editPackage = null;

// Xử lý Xóa package
if (isset($_GET['delete'])) {
    $del_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM packages WHERE id = ?");
    if ($stmt->execute([$del_id])) {
        header("Location: packages.php");
        exit();
    }
}

// Xử lý Thêm mới hoặc Cập nhật package
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $name = trim($_POST['name'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $sale_price = trim($_POST['sale_price'] ?? '');
    $sale_end_date = trim($_POST['sale_end_date'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if (!empty($name) && !empty($price)) {
        if (!empty($id)) {
            // Cập nhật package cũ
            $stmt = $conn->prepare("UPDATE packages SET name = ?, price = ?, sale_price = ?, sale_end_date = ?, description = ? WHERE id = ?");
            if ($stmt->execute([$name, $price, $sale_price ?: null, $sale_end_date ?: null, $description, $id])) {
                $success = "Package updated successfully!";
            } else {
                $error = "Failed to update package.";
            }
        } else {
            // Thêm package mới
            $stmt = $conn->prepare("INSERT INTO packages (name, price, sale_price, sale_end_date, description) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$name, $price, $sale_price ?: null, $sale_end_date ?: null, $description])) {
                $success = "Package added successfully!";
            } else {
                $error = "Failed to add package.";
            }
        }
    } else {
        $error = "Please fill in all required fields (Name, Price)!";
    }
}

// Nếu đang bấm Edit thì lấy thông tin gói cước đó lên form
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM packages WHERE id = ?");
    $stmt->execute([$edit_id]);
    $editPackage = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Lấy danh sách toàn bộ packages
$stmt = $conn->query("SELECT * FROM packages ORDER BY id DESC");
$packages = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = 'Manage Packages - Admin Panel';
include 'packages.html.php';
?>