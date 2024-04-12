
<?php
  session_start();
  if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;   
   }
?>

<?php
// Include database connection file
include ('dbconn.php');

// Check if hotel ID is set in the URL
if (isset($_GET['id'])) {
    // Prepare a delete statement
    $sql = "DELETE FROM hotels WHERE hotel_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_hotel_id);

        // Set parameters
        $param_hotel_id = $_GET['id'];

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to manage-hotels.php
            header("location: manage-hotels.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
} else {
    // Hotel ID not specified, redirect to error page
    header("location: error.php");
    exit();
}
?>
