<?php
// packages.php
session_start();
require_once 'includes/db.php';

// Security check: Redirect to login if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$title = 'Packages & Deals - CheapDeals';
$cssFile = 'template/css/packages.css'; 

try {
    // Fetch all available packages from the database
    $stmt = $conn->prepare("SELECT * FROM packages");
    $stmt->execute();
    $packages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("System error: " . $e->getMessage());
}

// Load the HTML content
ob_start();
include 'template/html/packages.html.php';
$output = ob_get_clean();

// Load the main layout template
include 'template/html/header.html.php';
?>