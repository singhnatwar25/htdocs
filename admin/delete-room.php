
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

// Check if room ID is provided via GET request
if(isset($_GET['id'])) {
    $roomId = $_GET['id'];

    // Delete room from the database based on room ID
    $sql = "DELETE FROM Rooms WHERE room_id = '$roomId'";
    if ($conn->query($sql) === TRUE) {
        echo "Room deleted successfully";
    } else {
        echo "Error deleting room: " . $conn->error;
    }
} else {
    echo "Room ID not provided";
}
?>
