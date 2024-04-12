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

// Create table to store hotels data if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS Hotels (
    hotel_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    rating FLOAT NOT NULL,
    description TEXT,
    image_url VARCHAR(255)
)";

if ($conn->query($sql) === FALSE) {
    echo "Error creating Hotels table: " . $conn->error;
}

// Create table to store rooms data if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS Rooms (
    room_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT(11) NOT NULL,
    room_type VARCHAR(255) NOT NULL,
    price_per_night DECIMAL(10, 2) NOT NULL,
    capacity INT(11) NOT NULL,
    room_img VARCHAR(255),
    
    availability ENUM('available', 'unavailable') DEFAULT 'available',
    FOREIGN KEY (hotel_id) REFERENCES Hotels(hotel_id)
)";

if ($conn->query($sql) === FALSE) {
    echo "Error creating Rooms table: " . $conn->error;
}

// Create table to store bookings data if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS Bookings (
    booking_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    room_id INT(11) NOT NULL,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    num_adults INT(11) NOT NULL,
    num_children INT(11) NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    status VARCHAR(255) NOT NULL,
    user_id INT(11) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (room_id) REFERENCES Rooms(room_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
)";

if ($conn->query($sql) === FALSE) {
    echo "Error creating Bookings table: " . $conn->error;
}

// Create table to store users data if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS Users (
    user_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user'
)";

if ($conn->query($sql) === FALSE) {
    echo "Error creating Users table: " . $conn->error;
}

// Create table to store room availability data if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS RoomAvailability (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    room_id INT(11) NOT NULL,
    hotel_id INT(11) NOT NULL,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    user_id INT(11) NOT NULL,
    availability ENUM('available', 'unavailable') DEFAULT 'available',
    FOREIGN KEY (room_id) REFERENCES Rooms(room_id),
    FOREIGN KEY (hotel_id) REFERENCES Hotels(hotel_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
)";

if ($conn->query($sql) === FALSE) {
    echo "Error creating RoomAvailability table: " . $conn->error;
}


// Close connection
//  $conn->close(); 

?>
