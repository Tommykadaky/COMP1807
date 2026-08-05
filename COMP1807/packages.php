<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once 'includes/db.php';

// Xử lý lọc theo loại package hoặc tìm kiếm từ khóa
$typeFilter = $_GET['type'] ?? '';
$searchQuery = trim($_GET['search'] ?? '');

$sql = "SELECT * FROM packages WHERE 1=1";
$params = [];

if (!empty($typeFilter)) {
    $sql .= " AND type = ?";
    $params[] = $typeFilter;
}

if (!empty($searchQuery)) {
    $sql .= " AND (name LIKE ? OR description LIKE ?)";
    $params[] = "%$searchQuery%";
    $params[] = "%$searchQuery%";
}

$sql .= " ORDER BY id DESC";

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$packages = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = 'Browse Packages - CheapDeals';
include 'template/html/packages.html.php';
?>