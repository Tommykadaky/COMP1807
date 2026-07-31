<?php
// remove_from_cart.php
session_start();

// Kiểm tra xem có ID của món hàng truyền lên không và món đó có trong giỏ không
if (isset($_GET['cart_id']) && isset($_SESSION['cart'][$_GET['cart_id']])) {
    // Xóa món hàng đó khỏi session
    unset($_SESSION['cart'][$_GET['cart_id']]);
}

// Xóa xong, lập tức chuyển hướng ngược lại trang giỏ hàng
header("Location: cart.php");
exit();
?>