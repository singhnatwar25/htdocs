
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

// Fetch all hotels data from the database
$sql = "SELECT * FROM hotels";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Hotels</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Manage Hotels</h1>
        <a href="add-hotel.php" class="btn btn-primary mb-3">Add Hotel</a>
        <table class="table table-striped table-hover">
            <thead>
                <tr  class="table-dark" >
                    <th>Hotel ID</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Rating</th>
                    <th>Description</th>
                    <th>Image URL</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any hotels in the database
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["hotel_id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td>" . $row["rating"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td>" . $row["image_url"] . "</td>";
                        echo "<td>
                                <a href='update-hotel.php?id=" . $row["hotel_id"] . "' class='btn btn-primary btn-sm'>Edit</a>
                                <a href='delete-hotel.php?id=" . $row["hotel_id"] . "' class='btn btn-danger btn-sm'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No hotels found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
