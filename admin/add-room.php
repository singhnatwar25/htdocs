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
$hotel_id = $room_type = $price_per_night = $capacity = $room_img = $availability = "";
$hotel_id_err = $room_type_err = $price_per_night_err = $capacity_err = $room_img_err = $availability_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate hotel ID
    if (empty(trim($_POST["hotel_id"]))) {
        $hotel_id_err = "Please enter hotel ID.";
    } else {
        $hotel_id = trim($_POST["hotel_id"]);
    }
    
    // Validate room type
    if (empty(trim($_POST["room_type"]))) {
        $room_type_err = "Please enter room type.";
    } else {
        $room_type = trim($_POST["room_type"]);
    }
    
    // Validate price per night
    if (empty(trim($_POST["price_per_night"]))) {
        $price_per_night_err = "Please enter price per night.";
    } else {
        $price_per_night = trim($_POST["price_per_night"]);
    }
    
    // Validate capacity
    if (empty(trim($_POST["capacity"]))) {
        $capacity_err = "Please enter capacity.";
    } else {
        $capacity = trim($_POST["capacity"]);
    }
    
    // Validate availability
    if (empty(trim($_POST["availability"]))) {
        $availability_err = "Please enter availability.";
    } else {
        $availability = trim($_POST["availability"]);
    }

    // Check if image is uploaded
    if(isset($_FILES["room_img"]) && $_FILES["room_img"]["error"] === 0){
        $target_dir = "../img/";
        $target_file = $target_dir . basename($_FILES["room_img"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["room_img"]["tmp_name"]);
        if($check !== false) {
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                $room_img_err = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            } else {
                if (move_uploaded_file($_FILES["room_img"]["tmp_name"], $target_file)) {
                    $room_img = $target_file;
                } else {
                    $room_img_err = "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            $room_img_err = "File is not an image.";
        }
    }
    
    // Check input errors before inserting into database
    if (empty($hotel_id_err) && empty($room_type_err) && empty($price_per_night_err) && empty($capacity_err) && empty($availability_err) && empty($room_img_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO Rooms (hotel_id, room_type, price_per_night, capacity, room_img, availability) VALUES (?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ississ", $param_hotel_id, $param_room_type, $param_price_per_night, $param_capacity, $param_room_img, $param_availability);
            
            // Set parameters
            $param_hotel_id = $hotel_id;
            $param_room_type = $room_type;
            $param_price_per_night = $price_per_night;
            $param_capacity = $capacity;
            $param_room_img = $room_img;
            $param_availability = $availability;
            
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to manage-rooms.php
                header("location: manage-rooms.php");
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
    <title>Add Room</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5 mb-4">Add Room</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Hotel ID</label>
                <input type="number" name="hotel_id" class="form-control <?php echo (!empty($hotel_id_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $hotel_id; ?>">
                <span class="invalid-feedback"><?php echo $hotel_id_err; ?></span>
            </div>
            <div class="form-group">
                <label>Room Type</label>
                <input type="text" name="room_type" class="form-control <?php echo (!empty($room_type_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $room_type; ?>">
                <span class="invalid-feedback"><?php echo $room_type_err; ?></span>
            </div>
            <div class="form-group">
                <label>Price per Night</label>
                <input type="number" name="price_per_night" class="form-control <?php echo (!empty($price_per_night_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $price_per_night; ?>">
                <span class="invalid-feedback"><?php echo $price_per_night_err; ?></span>
            </div>
            <div class="form-group mb-3">
                <label>Capacity</label>
                <input type="number" name="capacity" class="form-control <?php echo (!empty($capacity_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $capacity; ?>">
                <span class="invalid-feedback"><?php echo $capacity_err; ?></span>
            </div>
            <div class="form-group mb-3 ">
                <label for="room_img" class="form-label">Image</label>
                <input type="file" name="room_img" class="form-control-file <?php echo (!empty($room_img_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $room_img; ?>">
                <span class="invalid-feedback"><?php echo $room_img_err; ?></span>
            </div>
            <div class="form-group mb-3">
                <label>Availability</label>
                <select name="availability" class="form-control <?php echo (!empty($availability_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $availability; ?>">
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>
                <span class="invalid-feedback"><?php echo $availability_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                <a href="manage-rooms.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
