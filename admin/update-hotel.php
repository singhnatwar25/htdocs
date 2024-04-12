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

// Initialize hotel variables
$hotel_id = $name = $location = $rating = $description = $image_url = "";

// Check if hotel ID is set in the URL
if (isset($_GET['id'])) {
    // Prepare a select statement
    $sql = "SELECT * FROM hotels WHERE hotel_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_hotel_id);

        // Set parameters
        $param_hotel_id = $_GET['id'];

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Store result
            $stmt->store_result();

            // Check if hotel exists
            if ($stmt->num_rows == 1) {
                // Bind result variables
                $stmt->bind_result($hotel_id, $name, $location, $rating, $description, $image_url);

                // Fetch values
                if ($stmt->fetch()) {
                    // Hotel record found, display the form for updating
                } else {
                    // Hotel record not found, redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                // Hotel ID doesn't match any record, redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $location = $_POST["location"];
    $rating = $_POST["rating"];
    $description = $_POST["description"];
    $image_url = $_POST["image_url"];

    // Prepare an update statement
    $sql = "UPDATE hotels SET name=?, location=?, rating=?, description=?, image_url=? WHERE hotel_id=?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ssissi", $name, $location, $rating, $description, $image_url, $_GET['id']);

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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Hotel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5 mb-4">Update Hotel</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $_GET['id']); ?>" method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" class="form-control" value="<?php echo $location; ?>">
            </div>
            <div class="form-group">
                <label>Rating</label>
                <input type="number" name="rating" class="form-control" value="<?php echo $rating; ?>">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control"><?php echo $description; ?></textarea>
            </div>
            <div class="form-group">
                <label>Image URL</label>
                <input type="text" name="image_url" class="form-control" value="<?php echo $image_url; ?>">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Update">
                <a href="manage-hotels.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
