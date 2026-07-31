<?php
// build_package.php
session_start();
require_once 'includes/db.php';

$title = 'Build Your Own Package - CheapDeals';
$jsFile = 'template/js/build_package.js';
$error_msg = '';

// Bộ bảng giá và tùy chọn mở rộng
$prices = [
    'device' => [
        'None' => 0.00, 
        'Nokia 3310 (Basic)' => 5.00, 
        'Samsung Galaxy A54' => 15.00, 
        'Google Pixel 7' => 25.00, 
        'iPhone 15 Pro' => 45.00
    ],
    'minutes' => [
        '100 Mins' => 2.00, 
        '300 Mins' => 4.00, 
        '500 Mins' => 6.00, 
        '1000 Mins' => 8.00, 
        'Unlimited Mins' => 12.00
    ],
    'data' => [
        'No Data' => 0.00, 
        '2GB' => 3.00, 
        '5GB' => 5.00, 
        '10GB' => 8.00, 
        '50GB' => 15.00, 
        'Unlimited Data' => 20.00
    ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_custom'])) {
    $device = $_POST['device'] ?? 'None';
    $minutes = $_POST['minutes'] ?? '100 Mins';
    $data = $_POST['data'] ?? 'No Data';

    // KIỂM TRA CHỐNG LÁCH LUẬT TẠI BACKEND (Bảo mật)
    $is_valid = true;

    // Luật 1: Điện thoại xịn (Premium) bắt buộc phải đi kèm gói Data tối thiểu 10GB
    if (in_array($device, ['Google Pixel 7', 'iPhone 15 Pro']) && in_array($data, ['No Data', '2GB', '5GB'])) {
        $error_msg = "Security: Premium devices ($device) require at least a 10GB Data plan.";
        $is_valid = false;
    }

    // Luật 2: Điện thoại cục gạch (Basic) thì không được dùng gói Data
    if ($device === 'Nokia 3310 (Basic)' && $data !== 'No Data') {
        $error_msg = "Security: Basic phones do not support Data plans. Please select 'No Data'.";
        $is_valid = false;
    }

    // Nếu hợp lệ thì tính tiền và cho vào giỏ
    if ($is_valid && isset($prices['device'][$device]) && isset($prices['minutes'][$minutes]) && isset($prices['data'][$data])) {
        $total_price = $prices['device'][$device] + $prices['minutes'][$minutes] + $prices['data'][$data];
        
        $cart_id = 'custom_' . time();
        $package_name = "Custom: $device, $minutes, $data";

        $_SESSION['cart'][$cart_id] = [
            'id' => 0, 
            'name' => $package_name,
            'type' => 'Custom Package',
            'price' => $total_price
        ];
        
        header("Location: cart.php");
        exit();
    }
}

ob_start();
include 'template/html/build_package.html.php';
$output = ob_get_clean();

include 'template/html/header.html.php';
?>