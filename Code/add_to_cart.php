<?php
// add_to_cart.php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $final_price = 0;
    $final_name = '';
    $item_type = '';
    $item_id = 0;
    
    // TRƯỜNG HỢP 1: Mua Gói Combo
    if (isset($_POST['package_id'])) {
        $stmt = $conn->prepare("SELECT * FROM packages WHERE id = ?");
        $stmt->execute([$_POST['package_id']]);
        $pkg = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($pkg) {
            $item_id = $pkg['id'];
            $final_price = $pkg['price'];
            $final_name = $pkg['name'];
            $item_type = $pkg['type'];
            
            $upgrade_data = isset($_POST['upgrade_data']) ? 1 : 0; 
            if ($upgrade_data == 1 && !empty($pkg['upgrade_price'])) {
                $final_price += $pkg['upgrade_price'];
                $final_name .= ' (+ ' . $pkg['upgrade_details'] . ')';
            }
        }
    } 
    // TRƯỜNG HỢP 2: Mua Phụ kiện lẻ (Extras)
    elseif (isset($_POST['extra_id'])) {
        $stmt = $conn->prepare("SELECT * FROM extras WHERE id = ?");
        $stmt->execute([$_POST['extra_id']]);
        $ext = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($ext) {
            $item_id = $ext['id'];
            $final_price = $ext['price'];
            $final_name = $ext['name'];
            $item_type = $ext['type'];
        }
    }

    // Nếu tìm thấy món hàng hợp lệ thì nhét vào giỏ
    if ($final_name !== '') {
        $cart_item_id = uniqid('cart_');
        
        $_SESSION['cart'][$cart_item_id] = [
            'id' => $item_id,
            'name' => $final_name,
            'price' => $final_price,
            'type' => $item_type
        ];
        
        // Trả về đúng trang hiện tại
        $return_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
        header("Location: " . $return_url);
        exit();
    }
}

header("Location: index.php");
exit();
?>