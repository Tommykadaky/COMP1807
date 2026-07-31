<?php
// offers.php
session_start();
require_once 'includes/db.php';

$title = 'News & Special Offers - CheapDeals';

// Lấy danh sách mã giảm giá ĐANG HOẠT ĐỘNG và CHƯA HẾT HẠN
try {
    $stmt = $conn->prepare("
        SELECT * FROM promo_codes 
        WHERE is_active = 1 
        AND (expiry_date IS NULL OR expiry_date > NOW()) 
        ORDER BY discount_percent DESC
    ");
    $stmt->execute();
    $active_promos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $active_promos = [];
}

ob_start();
include 'template/html/offers.html.php';
$output = ob_get_clean();

include 'template/html/header.html.php';
?>