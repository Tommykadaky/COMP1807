<?php
// checkout.php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$title = 'Checkout Process - CheapDeals';

$purchased_items = [];
$subtotal = 0;
$payment_status = 'pending';
$error_message = '';
$promo_error = '';

$app_discount_percent = 15;
$promo_discount_percent = 0;
$promo_code_used = '';

function simulateVISACheck($amount) {
    $random_chance = rand(1, 100);
    return ($random_chance <= 90); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_items']) && !empty($_SESSION['cart'])) {
    
    foreach ($_POST['selected_items'] as $cart_id) {
        if (isset($_SESSION['cart'][$cart_id])) {
            $purchased_items[$cart_id] = $_SESSION['cart'][$cart_id];
            $subtotal += $_SESSION['cart'][$cart_id]['price'];
        }
    }

    if (!empty($_POST['promo_code'])) {
        $entered_code = strtoupper(trim($_POST['promo_code']));
        
        $stmt = $conn->prepare("SELECT * FROM promo_codes WHERE code = ? AND is_active = 1");
        $stmt->execute([$entered_code]);
        $promo = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($promo) {
            if ($promo['expiry_date'] !== null && strtotime($promo['expiry_date']) < time()) {
                $promo_error = "The promo code '$entered_code' has expired.";
            } else {
                $promo_discount_percent = $promo['discount_percent'];
                $promo_code_used = $entered_code;
            }
        } else {
            $promo_error = "Invalid promo code.";
        }
    }

    $app_discount_amount = $subtotal * ($app_discount_percent / 100);
    $promo_discount_amount = $subtotal * ($promo_discount_percent / 100);
    $total_discount = $app_discount_amount + $promo_discount_amount;
    
    $final_total = $subtotal - $total_discount;
    if ($final_total < 0) $final_total = 0;

    if (empty($promo_error)) {
        $is_payment_successful = simulateVISACheck($final_total);

        if ($is_payment_successful) {
            $payment_status = 'success';
            try {
                $conn->beginTransaction();
                
                $stmt = $conn->prepare("INSERT INTO orders (user_id, subtotal, discount, total_amount, status, created_at) VALUES (?, ?, ?, ?, 'Completed', NOW())");
                $stmt->execute([$_SESSION['user_id'], $subtotal, $total_discount, $final_total]);
                $order_id = $conn->lastInsertId();

                $conn->commit();

                foreach ($purchased_items as $cart_id => $item) {
                    unset($_SESSION['cart'][$cart_id]);
                }
                
                $log_msg = "[" . date('Y-m-d H:i:s') . "] Receipt sent for Order #$order_id to User #" . $_SESSION['user_id'] . "\n";
                file_put_contents('email_logs.txt', $log_msg, FILE_APPEND);

            } catch (PDOException $e) {
                $conn->rollBack();
                $payment_status = 'failed';
                $error_message = 'System Error: ' . $e->getMessage();
            }
        } else {
            $payment_status = 'failed';
            $error_message = 'VISACheck declined the transaction. Please check your credit limit.';
        }
    } else {
        $payment_status = 'failed';
        $error_message = $promo_error;
    }
} else {
    header("Location: cart.php");
    exit();
}

// Gọi file View HTML chuẩn chỉ
ob_start();
include 'template/html/checkout.html.php';
$output = ob_get_clean();

include 'template/html/header.html.php';
?>