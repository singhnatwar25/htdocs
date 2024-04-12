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

// Check if room ID is provided in the URL
if (!isset($_GET['id'])) {
    header("location: error.php");
    exit();
}

$id = $_GET['id'];  // get room ID from URL

// Retrieve room information from database
$sql = "SELECT * FROM Rooms WHERE room_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

// Check if room exists
if (!$row) {
    header("location: error.php");
    exit();
}

// Update room details if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hotel_id = $_POST["hotel_id"];
    $room_type = $_POST["room_type"];
    $price_per_night = $_POST["price_per_night"];
    $capacity = $_POST["capacity"];
    $availability = $_POST["availability"];

    // Check if image is uploaded
    if(isset($_FILES["room_img"]) && $_FILES["room_img"]["error"] === 0){
        $target_dir = "../img/";
        $target_file = $target_dir . basename($_FILES["room_img"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check if image file is a valid image
        $check = getimagesize($_FILES["room_img"]["tmp_name"]);
        if($check !== false) {
            // Move uploaded image to the target directory
            if (move_uploaded_file($_FILES["room_img"]["tmp_name"], $target_file)) {
                $room_img = $target_file;
                
                // Update room details including the image path
                $sql = "UPDATE Rooms SET hotel_id=?, room_type=?, price_per_night=?, capacity=?, room_img=?, availability=? WHERE room_id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ississi", $hotel_id, $room_type, $price_per_night, $capacity, $room_img, $availability, $id);
                $stmt->execute();
                $stmt->close();
                
                // Redirect to manage-rooms.php after updating
                header("location: manage-rooms.php");
                exit();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "File is not an image.";
        }
    } else {
        // Update room details without changing the image
        $sql = "UPDATE Rooms SET hotel_id=?, room_type=?, price_per_night=?, capacity=?, availability=? WHERE room_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issisi", $hotel_id, $room_type, $price_per_night, $capacity, $availability, $id);
        $stmt->execute();
        $stmt->close();
        
        // Redirect to manage-rooms.php after updating
        header("location: manage-rooms.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Room</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            /* max-width: 500px; */
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            
        }

        input[type="file"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .btn-primary,
        .btn-secondary {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
        }

        .btn-primary {
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,26,121,1) 0%, rgba(0,212,255,1) 100%);
            border: none;
            color: #000;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,26,121,1) 52%, rgba(0,212,255,1) 100%);            border: none;
            color: #fff;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            color: #fff;
        }
    </style>
<body>
    <div class="container">
        <h2 class="mt-5 mb-4">Update Room</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group mb-3 ">
                <label>Hotel ID</label>
                <input type="number" name="hotel_id" class="form-control" value="<?php echo $row['hotel_id']; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Room Type</label>
                <input type="text" name="room_type" class="form-control" value="<?php echo $row['room_type']; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Price per Night</label>
                <input type="number" name="price_per_night" class="form-control" value="<?php echo $row['price_per_night']; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Capacity</label>
                <input type="number" name="capacity" class="form-control" value="<?php echo $row['capacity']; ?>">
            </div>
            <div class="form-group mb-3">
                <label>Current Image</label>
                <img src="<?php echo $row['room_img']; ?>" alt="Room Image" width="200">
            </div>
            <div class="form-group mb-3">
                <label>Upload New Image</label>
                <input type="file" name="room_img" class="form-control-file">
            </div>
            <div class="form-group mb-3">
                <label>Availability</label>
                <select name="availability" class="form-control">
                    <option value="available" <?php if($row['availability'] == "available") echo "selected"; ?>>Available</option>
                    <option value="unavailable" <?php if($row['availability'] == "unavailable") echo "selected"; ?>>Unavailable</option>
                </select>
            </div>
            <div class="form-group mb-3 text-end">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="manage-rooms.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
