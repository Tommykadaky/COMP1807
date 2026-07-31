<?php
// check_promo.php
session_start();
require_once 'includes/db.php';

// Trả về dữ liệu dạng JSON cho Javascript đọc
header('Content-Type: application/json');

if (!isset($_GET['code']) || empty(trim($_GET['code']))) {
    echo json_encode(['success' => false, 'message' => 'Please enter a promo code.']);
    exit;
}

$code = strtoupper(trim($_GET['code']));

try {
    $stmt = $conn->prepare("SELECT * FROM promo_codes WHERE code = ? AND is_active = 1");
    $stmt->execute([$code]);
    $promo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($promo) {
        // Kiểm tra xem mã đã hết hạn chưa
        if ($promo['expiry_date'] !== null && strtotime($promo['expiry_date']) < time()) {
            echo json_encode(['success' => false, 'message' => 'This promo code has expired.']);
        } else {
            // Mã hợp lệ, trả về phần trăm giảm giá
            echo json_encode([
                'success' => true, 
                'discount_percent' => $promo['discount_percent'],
                'message' => "Promo applied! ({$promo['discount_percent']}% off)"
            ]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid promo code.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error.']);
}
?>