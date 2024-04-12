<?php
// Include database connection file
require_once('vendor/razorpay/razorpay/Razorpay.php');

use Razorpay\Api\Api;

// Include config file
require_once('config.php');

// Initialize Razorpay API with your key id and secret
$api_key = API_KEY;
$api_secret = API_SECRET;
$api = new Api($api_key, $api_secret);

// Fetch necessary data for the checkout
$currency = 'INR';

include_once "dbconn.php";

// Default value for Confirm


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract data from the form
    $room_id = $_POST['room_id'];
    $hotel_id = $_POST['hotel_id'];
    $room_type = $_POST['room_type'];
    $price_per_night = $_POST['price_per_night'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $specialRequest = $_POST['specialRequest'];
    $paymentMethod = $_POST['paymentMethod'];

    
    $checkInDate = $_POST['checkInDate'];
    $checkOutDate = $_POST['checkOutDate'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $rooms = $_POST['rooms'];
 

    // Create table in the database if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS booking (
        id INT AUTO_INCREMENT PRIMARY KEY,
        room_id INT NOT NULL,
        hotel_id INT NOT NULL,
        room_type VARCHAR(255) NOT NULL,
        price_per_night DECIMAL(10, 2) NOT NULL,
        firstName VARCHAR(255) NOT NULL,
        lastName VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phoneNumber VARCHAR(20) NOT NULL,
        specialRequest VARCHAR(255),
        paymentMethod VARCHAR(20) NOT NULL,
        checkInDate DATE NOT NULL,
        checkOutDate DATE NOT NULL,
        adults INT NOT NULL,
        children INT NOT NULL,
        rooms INT NOT NULL,
        bookingDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        Confirm ENUM('Confirm', 'Pending') DEFAULT 'Confirm',
        FOREIGN KEY (room_id) REFERENCES Rooms(room_id),
        FOREIGN KEY (hotel_id) REFERENCES Hotels(hotel_id)
    )";

    if ($conn->query($sql) === TRUE) {
        // Table created successfully, now insert data into it
        $sql = "INSERT INTO booking (room_id, hotel_id, room_type, price_per_night, firstName, lastName, email, phoneNumber, specialRequest, paymentMethod, checkInDate, checkOutDate, adults, children, rooms ) 
                VALUES ('$room_id', '$hotel_id', '$room_type', '$price_per_night', '$firstName', '$lastName', '$email', '$phoneNumber', '$specialRequest', '$paymentMethod', '$checkInDate', '$checkOutDate', '$adults', '$children', '$rooms')";

        if ($conn->query($sql) === TRUE) {
            // Booking successful
            if ($paymentMethod === "pay_At_Hotel") {
                // show alert in javascript and redirect to index page
                echo "<script>alert('Booking successful! Pay at Hotel ')</script>";
                echo "<script>window.location.href = '../index.php';</script>";

            } else {
                // Create an order for Razorpay payment
                $amount = $price_per_night * 100; // Amount in paise (100 paise = 1 INR)
                $orderData = [
                    'receipt' => 'order_receipt_' . time(),
                    'amount' => $amount,
                    'currency' => $currency
                ];

                // Create an order
                $order = $api->order->create($orderData);

                // Get the Razorpay order ID
                $orderId = $order['id'];

                // Redirect to online payment page
                // Include Razorpay checkout page content here
                ?>
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Razorpay Checkout</title>
                    <!-- Include Razorpay checkout.js -->
                    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                </head>
                <body>
                    <!-- Razorpay checkout content goes here -->
                    <button onclick="startPayment()">Pay Now</button>

                    <script>
                        function startPayment() {
                            var options = {
                                "key": "<?php echo $api_key; ?>",
                                "amount": "<?php echo $amount; ?>",
                                "currency": "<?php echo $currency; ?>",
                                "name": "<?php echo $firstName . ' ' . $lastName; ?>",
                                "email": "<?php echo $email ?>",
                                "contact": "<?php echo $phoneNumber; ?>",

                                "description": "Test Payment",
                                "order_id": "<?php echo $orderId; ?>",
                                "handler": function (response){
                                    alert('Payment successful! Payment ID: ' + response.razorpay_payment_id);     
                                    window.location.href = "http://localhost/ext/success.php"
                                    // Redirect or handle success
                                },
                                "prefill": {
                                    "name": "<?php echo $firstName . ' ' . $lastName; ?>",
                                    "email": "<?php echo $email; ?>",
                                    "contact": "<?php echo $phoneNumber; ?>"
                                },
                                "theme": {
                                    "color": "#3399cc"
                                }
                            };
                            var rzp1 = new Razorpay(options);
                            rzp1.open();
                        }
                    </script>
                </body>
                </html>
                <?php
                exit();
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    // Redirect to failure page if form is not submitted
    header("Location: failure.php");
    exit();
}
?>
