<?php
session_start();
require_once 'includes/db.php';

$title = 'Login - CheapDeals';
$cssFile = 'template/css/login.css'; 
$jsFile = 'template/js/login.js';   
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        // Đổi từ $pdo thành $conn cho khớp với includes/db.php
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'] ?? 'customer'; 

            if ($_SESSION['role'] === 'admin') {
                header("Location: admin/packages.php");
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        } else {
            $error = "Invalid email or password!";
        }
    } else {
        $error = "Please fill in all fields!";
    }
}

ob_start();
include 'template/html/login_form.html.php';
$output = ob_get_clean();

include 'template/html/header.html.php';
?>