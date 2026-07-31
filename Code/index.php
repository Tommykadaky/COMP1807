<?php
// index.php
session_start();
require_once 'includes/db.php';

$title = 'Home - CheapDeals';

// 1. KHI ĐÃ ĐĂNG NHẬP: Trang chủ sẽ hiển thị danh sách gói cước
if (isset($_SESSION['user_id'])) {
    $cssFile = 'template/css/packages.css'; 
    $jsFile = 'template/js/packages.js'; // Chuyển js vào đây vì chỉ khi đăng nhập mới cần dùng script lọc
    
    try {
        // ĐÃ SỬA: Xóa đoạn "WHERE type = 'Combo'" để lấy toàn bộ dữ liệu từ Database
        $stmt = $conn->prepare("SELECT * FROM packages");
        $stmt->execute();
        $packages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        die("System error: " . $e->getMessage());
    }

    ob_start();
    include 'template/html/packages.html.php';
    $output = ob_get_clean();
} 
// 2. KHI CHƯA ĐĂNG NHẬP: Gọi file giao diện giới thiệu
else {
    ob_start();
    include 'template/html/welcome.html.php'; // Sạch sẽ 100% không còn HTML!
    $output = ob_get_clean();
}

include 'template/html/header.html.php';
?>