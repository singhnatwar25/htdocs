<?php
//   session_start();
//   if(!isset($_SESSION['user_id'])) {
//     header("Location: index.php");
//     exit;   
//    }
?>
<?php

// Database configuration
$servername = "localhost"; // इसे अपने डेटाबेस सर्वर नाम से बदलें
$username = "root"; // इसे अपने डेटाबेस उपयोगकर्ता नाम से बदलें
$password = ""; // इसे अपने डेटाबेस पासवर्ड से बदलें
$database = "booking_database"; // इसे अपने डेटाबेस नाम से बदलें

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) === FALSE) {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db($database);
// SQL to create table
$sql = "CREATE TABLE IF NOT EXISTS adminuser (
    user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    last_login TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

// Execute create table query


// Close connection
?>