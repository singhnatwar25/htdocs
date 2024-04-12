<?php
  session_start();
  if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;   
   }
?>
<?php

// Include database connection file
include_once "dbconn.php";

// Get id from URL
$id = $_GET['id'];

// Fetch hotel ID for the booking
$hotelQuery = mysqli_query($conn, "SELECT hotel_id FROM booking WHERE id=$id");
if ($hotelQuery && mysqli_num_rows($hotelQuery) > 0) {
    $row = mysqli_fetch_assoc($hotelQuery);
    $hotelId = $row['hotel_id'];

    // Delete booking by id for the specified hotel
    $result = mysqli_query($conn, "DELETE FROM booking WHERE id=$id AND hotel_id=$hotelId");

    if ($result) { ?>
        <script>
            alert('Booking deleted successfully.');
            // Redirect based on hotel ID
            switch (<?php echo $hotelId; ?>) {
                case 1:
                    window.location = 'Pardise_Booking.php';
                    break;
                case 2:
                    window.location = 'Archana_Booking.php';
                    break;
                case 3:
                    window.location = 'Pride_Booking.php';
                    break;
                default:
                    window.location = 'All-bookings.php'; // Default redirect
            }
        </script> <?php 
    } else { ?>
        <script>
            alert('Failed to delete booking.');
            window.location = 'Pardise_bookings.php';
        </script> <?php
    } 
} else {
    // Handle error if hotel ID retrieval fails
    echo "Error: Failed to fetch hotel ID.";
}
?>

<!-- Delete room by id -->
