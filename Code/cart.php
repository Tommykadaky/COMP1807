<?php
// cart.php
session_start();
require_once 'includes/db.php';

// XỬ LÝ: Khách hàng bấm nút "Remove" để xóa món hàng khỏi giỏ
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    if (isset($_SESSION['cart'][$remove_id])) {
        unset($_SESSION['cart'][$remove_id]);
    }
    // Load lại trang để làm mới giỏ hàng
    header("Location: cart.php");
    exit();
}

$title = 'Your Cart - CheapDeals';

// Bắt buộc: Khai báo đường dẫn file JS để file header.html.php gọi vào cuối trang
$jsFile = 'template/js/cart.js'; 

// Gọi giao diện
ob_start();
include 'template/html/cart.html.php';
$output = ob_get_clean();

// Gọi header (layout chung)
include 'template/html/header.html.php';
?>