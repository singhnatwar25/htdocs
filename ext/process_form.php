<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost"; // Change this to your database server name
    $username = "root"; // Change this to your database username
    $password = ""; // Change this to your database password
    $database = "booking_database"; // Change this to your database name
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Retrieve form data
    $hotelName = $_POST["hotel_name"];
    $location = ''; // You can retrieve the location based on the hotel name from your database or set it manually
    $checkInDate = $_POST["check_in_date"];
    $checkOutDate = $_POST["check_out_date"];
    
    $adults = $_POST["adults"];
    $children = $_POST["children"];
    $rooms = $_POST["rooms"];
    
    // Insert form data into database
    $sql = "INSERT INTO bookings (hotel_name, location, check_in_date, check_out_date, adults, children, rooms) VALUES ('$hotelName', '$location', '$checkInDate', '$checkOutDate',  '$adults', '$children', '$rooms')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location:  available.php"); 
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close connection
    $conn->close();
}
?>

