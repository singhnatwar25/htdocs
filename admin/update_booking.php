<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>

<?php
require_once('dbconn.php');  // Database connection

// Check if booking ID is provided in the URL
if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // Retrieve booking details from the database
    $sql = "SELECT * FROM booking WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind booking ID parameter
        $stmt->bind_param("i", $booking_id);

        // Execute the statement
        $stmt->execute();

        // Get result
        $result = $stmt->get_result();

        // Check if booking exists
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Booking details
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $email = $row['email'];
            $phoneNumber = $row['phoneNumber'];
            $checkInDate = $row['checkInDate'];
            $checkOutDate = $row['checkOutDate'];
            $adults = $row['adults'];
            $children = $row['children'];
            $rooms = $row['rooms'];
            $room_type = $row['room_type'];
            $price_per_night = $row['price_per_night'];
            $paymentMethod = $row['paymentMethod'];
            $specialRequest = $row['specialRequest'];
            $Confirm = $row['Confirm'];
            $hotel_id = $row['hotel_id']; // Get the hotel ID
        } else {
            // Booking not found, redirect to error page or handle accordingly
            header("Location: error.php");
            exit();
        }
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract data from the form
    // You can add validation and sanitation here
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $checkInDate = $_POST['checkInDate'];
    $checkOutDate = $_POST['checkOutDate'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $rooms = $_POST['rooms'];
    $room_type = $_POST['room_type'];
    $price_per_night = $_POST['price_per_night'];
    $paymentMethod = $_POST['paymentMethod'];
    $specialRequest = $_POST['specialRequest'];
    $Confirm = $_POST['Confirm'];

    // Update booking details in the database
    $sql = "UPDATE booking SET firstName=?, lastName=?, email=?, phoneNumber=?, checkInDate=?, checkOutDate=?, adults=?, children=?, rooms=?, room_type=?, price_per_night=?, paymentMethod=?, specialRequest=?, Confirm=? WHERE id=?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("ssssssiiisdsdsi", $firstName, $lastName, $email, $phoneNumber, $checkInDate, $checkOutDate, $adults, $children, $rooms, $room_type, $price_per_night, $paymentMethod, $specialRequest, $Confirm, $booking_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to booking details page or dashboard
            switch ($hotel_id) {
                case 1:
                    header("Location: Pardise_Booking.php");
                    exit();
                case 2:
                    header("Location: Archana_Booking.php");
                    exit();
                case 3:
                    header("Location: Pride_Booking.php");
                    exit();
                default:
                    header("Location: All_bookings.php"); // Default redirect
                    exit();
            }
        } else {
            // Error handling
            echo "Error: " . $conn->error;
        }
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Booking</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Update Booking</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $booking_id); ?>" method="post">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="firstName" class="form-control" value="<?php echo $firstName; ?>">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastName" class="form-control" value="<?php echo $lastName; ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phoneNumber" class="form-control" value="<?php echo $phoneNumber; ?>">
            </div>
            <div class="form-group">
                <label>Check-in Date</label>
                <input type="date" name="checkInDate" class="form-control" value="<?php echo $checkInDate; ?>">
            </div>
            <div class="form-group">
                <label>Check-out Date</label>
                <input type="date" name="checkOutDate" class="form-control" value="<?php echo $checkOutDate; ?>">
            </div>
            <div class="form-group">
                <label>Adults</label>
                <input type="number" name="adults" class="form-control" value="<?php echo $adults; ?>">
            </div>
            <div class="form-group">
                <label>Children</label>
                <input type="number" name="children" class="form-control" value="<?php echo $children; ?>">
            </div>
            <div class="form-group">
                <label>Rooms</label>
                <input type="number" name="rooms" class="form-control" value="<?php echo $rooms; ?>">
            </div>
            <div class="form-group">
                <label>Room Type</label>
                <input type="text" name="room_type" class="form-control" value="<?php echo $room_type; ?>">
            </div>
            <div class="form-group">
                <label>Price per Night</label>
                <input type="text" name="price_per_night" class="form-control" value="<?php echo $price_per_night; ?>">
            </div>
            <div class="form-group">
                <label>Payment Method</label>
                <select name="paymentMethod" class="form-control">
                    <option value="pay_At_Hotel" <?php if ($paymentMethod == 'pay_At_Hotel') echo 'selected'; ?>>Pay At Hotel</option>
                    <option value="online_Payment" <?php if ($paymentMethod == 'online_Payment') echo 'selected'; ?>>Online Payment</option>
                </select>
            </div>
            <div class="form-group">
                <label>Special Request</label>
                <input type="text" name="specialRequest" class="form-control"><?php echo $specialRequest; ?></input>
            </div>
            <div class="form-group">
                <label >Confirm</label>
                <select name="Confirm" class="form-control" >
                    <option value="Confirm" <?php if($row['Confirm'] == "Confirm") echo "selected"; ?> class="text-success">Confirm </option>
                    <option value="Pending" <?php if($row['Confirm'] == "Pending") echo "selected"; ?>>Pending</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Booking</button>
        </form>
    </div>
</body>

</html>
