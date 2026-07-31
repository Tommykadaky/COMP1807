<?php
// includes/db.php

$host = 'localhost';
$dbname = 'cheapdeals_db';
$username = 'root';
$password = ''; 

try {
    // Create a PDO instance to connect to the database
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Set the PDO error mode to exception for better error handling
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Stop the script and show an error message if connection fails
    die("Database connection failed: " . $e->getMessage());
}
?>