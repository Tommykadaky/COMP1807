<?php
// register.php
session_start();
require_once 'includes/db.php';

$title = 'Register - CheapDeals';
$cssFile = 'template/css/register.css'; 
$jsFile = 'template/js/register.js';   
$errors = [];

// Hàm gửi Email (Đã tách HTML ra file riêng)
function send_welcome_email($to_email, $customer_name) {
    $subject = "Welcome to CheapDeals - Account Created!";
    $login_link = "http://localhost/COMP1807/login.php"; 
    
    // Gọi template HTML của email vào biến $message
    ob_start();
    include 'template/html/email_welcome.html.php';
    $message = ob_get_clean();

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@cheapdeals.com" . "\r\n";

    $success = @mail($to_email, $subject, $message, $headers);

    if (!$success) {
        sleep(1); 
        $success = @mail($to_email, $subject, $message, $headers);
    }

    $status_text = $success ? "SENT SUCCESSFULLY" : "FAILED (Simulated)";
    $log_entry = "[" . date('Y-m-d H:i:s') . "] WELCOME EMAIL - To: $to_email - Status: $status_text\n";
    file_put_contents('email_logs.txt', $log_entry, FILE_APPEND);

    return $success;
}

// Hàm kiểm tra thẻ tín dụng chuẩn Luhn
function luhn_check($number) {
    $number = preg_replace('/\D/', '', $number);
    $sum = 0;
    $length = strlen($number);
    
    for ($i = 0; $i < $length; $i++) {
        $digit = (int)$number[$length - 1 - $i];
        if ($i % 2 == 1) {
            $digit *= 2;
            if ($digit > 9) $digit -= 9;
        }
        $sum += $digit;
    }
    return ($sum % 10 == 0);
}

// Xử lý logic đăng ký
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $address = trim($_POST['address'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $credit_card = trim($_POST['credit_card'] ?? '');

    if (empty($full_name) || empty($email) || empty($password) || empty($address) || empty($phone) || empty($credit_card)) {
        $errors[] = "All fields are required.";
    }

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (!empty($phone)) {
        $phone_clean = preg_replace('/[\s\-]/', '', $phone);
        if (!preg_match('/^(0|\+44)[1-9]\d{8,9}$/', $phone_clean)) {
            $errors[] = "Invalid UK phone number. Example: 07123456789";
        }
    }

    if (!empty($credit_card) && !luhn_check($credit_card)) {
        $errors[] = "Invalid credit card number.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $errors[] = "This email is already registered.";
        }
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, address, phone, credit_card) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$full_name, $email, $hashed_password, $address, $phone, $credit_card])) {
                send_welcome_email($email, $full_name);
                header("Location: login.php?registered=success");
                exit();
            } else {
                $errors[] = "System error: Could not register user.";
            }
        } catch(PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }
}

// Load giao diện từ template
ob_start();
include 'template/html/register.html.php';
$output = ob_get_clean();

include 'template/html/header.html.php';
?>