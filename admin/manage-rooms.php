<?php
  session_start();
  if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;   
   }
?>

<?php
include ('adext/_header.php');
// Include database connection file
include ('dbconn.php');

// Fetch all rooms data from the database
$sql = "SELECT * FROM Rooms";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rooms</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .imgika{
        width: 100px;
    }
    .custombtn{
        background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,26,121,1) 0%, rgba(0,212,255,1) 100%);
        color: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,26,121,1) 0%, rgba(0,212,255,1) 100%);
    }
</style>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Manage Rooms</h1>
        <!-- Add Room button -->
        <a href="add-room.php" class="btn btn-primary mb-3 custombtn">Add Room</a>
        <table class="table table-striped table-hover">
            <thead>
                <tr class="table-dark">
                    <th>Room ID</th>
                    <th>Hotel ID</th>
                    <th>Room Type</th>
                    <th>Price per Night</th>
                    <th>Capacity</th>
                    <th>Room Image</th>
                    <th>Availability</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any rooms in the database
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["room_id"] . "</td>";
                        echo "<td>" . $row["hotel_id"] . "</td>";
                        echo "<td>" . $row["room_type"] . "</td>";
                        echo "<td>" . $row["price_per_night"] . "</td>";
                        echo "<td>" . $row["capacity"] . "</td>";
                        echo "<td> <img class=' m-0 p-0 imgika' alt='not found' src='../admin/"  . $row["room_img"] . "  ?>'</td>";
                        
                        echo "<td>" . $row["availability"] . "</td>";
                        echo "<td>
                                <a href='update-room.php?id=" . $row["room_id"] . "' class='btn btn-primary btn-sm px-3 fs-6'>Edit</a>
                                <a href='delete-room.php?id=" . $row["room_id"] . "' class='btn btn-danger btn-sm'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No rooms found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
