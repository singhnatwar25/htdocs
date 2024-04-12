<?php
session_start();

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $rooms = $_POST['rooms'];

    // Store form data in session variables
    $_SESSION['check_in_date'] = $check_in_date;
    $_SESSION['check_out_date'] = $check_out_date;
    $_SESSION['adults'] = $adults;
    $_SESSION['children'] = $children;
    $_SESSION['rooms'] = $rooms;

    // Convert dates to Unix timestamps
    $check_in_timestamp = strtotime($check_in_date);
    $check_out_timestamp = strtotime($check_out_date);

    // Calculate the difference in seconds
    $time_diff_seconds = $check_out_timestamp - $check_in_timestamp;

    // Convert seconds to days
    $days_count = floor($time_diff_seconds / (60 * 60 * 24));

    // Store the number of days in session
    $_SESSION['days_count'] = $days_count;

    // Redirect to available.php
    header('Location: available.php');
    exit();
}
?>
