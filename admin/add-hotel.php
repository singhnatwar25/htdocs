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

// Define variables and set to empty values
$name = $location = $rating = $description = $image_url = "";
$name_err = $location_err = $rating_err = $description_err = $image_url_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter hotel name.";
    } else {
        $name = trim($_POST["name"]);
    }
    
    // Validate location
    if (empty(trim($_POST["location"]))) {
        $location_err = "Please enter hotel location.";
    } else {
        $location = trim($_POST["location"]);
    }
    
    // Validate rating
    if (empty(trim($_POST["rating"]))) {
        $rating_err = "Please enter hotel rating.";
    } else {
        $rating = trim($_POST["rating"]);
    }
    
    // Validate description
    if (empty(trim($_POST["description"]))) {
        $description_err = "Please enter hotel description.";
    } else {
        $description = trim($_POST["description"]);
    }
    
    // Validate image URL
    if (empty(trim($_POST["image_url"]))) {
        $image_url_err = "Please enter image URL.";
    } else {
        $image_url = trim($_POST["image_url"]);
    }
    
    // Check input errors before inserting into database
    if (empty($name_err) && empty($location_err) && empty($rating_err) && empty($description_err) && empty($image_url_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO hotels (name, location, rating, description, image_url) VALUES (?, ?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssiss", $param_name, $param_location, $param_rating, $param_description, $param_image_url);
            
            // Set parameters
            $param_name = $name;
            $param_location = $location;
            $param_rating = $rating;
            $param_description = $description;
            $param_image_url = $image_url;
            
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
    <title>Add Hotel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5 mb-4">Add Hotel</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                <span class="invalid-feedback"><?php echo $name_err; ?></span>
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" class="form-control <?php echo (!empty($location_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $location; ?>">
                <span class="invalid-feedback"><?php echo $location_err; ?></span>
            </div>
            <div class="form-group">
                <label>Rating</label>
                <input type="number" name="rating" class="form-control <?php echo (!empty($rating_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $rating; ?>">
                <span class="invalid-feedback"><?php echo $rating_err; ?></span>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                <span class="invalid-feedback"><?php echo $description_err; ?></span>
            </div>
            <div class="form-group">
                <label>Image URL</label>
                <input type="text" name="image_url" class="form-control <?php echo (!empty($image_url_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $image_url; ?>">
                <span class="invalid-feedback"><?php echo $image_url_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="manage-hotels.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
