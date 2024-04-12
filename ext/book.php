<?php
session_start();
?>
<?php
// Retrieve room details from the URL parameters
if (isset($_GET['room_id']) && isset($_GET['room_type']) && isset($_GET['price_per_night']) && isset($_GET['hotel_id'])) {
    $room_id = $_GET['room_id'];
    $hotel_id = $_GET['hotel_id'];
    $room_type = $_GET['room_type'];
    $price_per_night = $_GET['price_per_night'];
} else {
    // Handle case when parameters are not provided
    // For example, redirect back to the rooms page with an error message
    header("Location: rooms.php?error=missing_parameters");
    exit();
}
?>

<?php
// Include database connection file
include('dbconn.php');
?>
<!doctype html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Jain Hotels</title>
   <?php include ('_cdn.php'); ?>
   <style>
        /* Custom Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .room-book{
            background-image: url("../img/white-texture.jpg");
            margin-top: 170px;
        }
        .book {
            background-color: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 70px;
        
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;

        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ccc;
        }

        .btn {
            background-color: #F57D1F;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #F2613F;
        }

        label {
            font-weight: bold;
        
    
        }

        /* Adjustments for small screens */
        @media(max-width: 768px) {
            .book {
                margin-top: 20px;
            }
        }
   </style>
</head>
<body>
   <!-- Header -->
   <?php include ('_header2.php'); ?>

   <div class="container-fluid room-book">
    <div class="container pt-4">
      <div class="row">
         <div class="col-md-4 Room">
            <!-- Selected Room Card -->
           
            <!-- Search Details Card -->
            <div class="card mb-4">
               <div class="card-header text-center">Room Details</div>
               <div class="card-body">
                  <p><strong>Check-in Date:</strong> <?php echo $_SESSION['check_in_date']; ?></p>
                  <p><strong>Check-out Date:</strong> <?php echo $_SESSION['check_out_date']; ?></p>
                  <p><strong>Adults:</strong> <?php echo $_SESSION['adults']; ?></p>
                  <p><strong>Children:</strong> <?php echo $_SESSION['children']; ?></p>
                  <p><strong>Rooms:</strong> <?php echo $_SESSION['rooms']; ?></p>
                  <p class="card-text">Room Type: <?php echo $room_type; ?></p>
                  <p class="card-text">Price per Night: $<?php echo $price_per_night; ?></p>
                  <p class="card-text">Hotel id <?php echo $hotel_id; ?></p>
               </div>
            </div>
         </div>
         <div class="col-md-8">
            <!-- Booking Form -->
            <div class="book ">
               <h1 class="mt-0 mb-4">Book Room</h1>
               <form id="bookingForm" action="booking.php" method="post">
                  <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
                  <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">
                  <input type="hidden" name="room_type" value="<?php echo $room_type; ?>">
                  <input type="hidden" name="price_per_night" value="<?php echo $price_per_night; ?>">
                  
                  <input type="hidden" name="checkInDate" value="<?php echo $_SESSION['check_in_date']; ?>">
                  <input type="hidden" name="checkOutDate" value="<?php echo $_SESSION['check_out_date']; ?>">
                  <input type="hidden" name="adults" value="<?php echo $_SESSION['adults']; ?>">
                  <input type="hidden" name="children" value=" <?php echo $_SESSION['children']; ?>">
                  <input type="hidden" name="rooms" value="<?php echo $_SESSION['rooms']; ?>">
                  <div class="form-group">
                     <label for="firstName">First Name</label>
                     <input type="text" class="form-control" id="firstName" name="firstName" required>
                  </div>
                  <div class="form-group">
                     <label for="lastName">Last Name</label>
                     <input type="text" class="form-control" id="lastName" name="lastName" required>
                  </div>
                  <div class="form-group">
                     <label for="email">Email</label>
                     <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                  <div class="form-group">
                     <label for="phoneNumber">Phone Number</label>
                     <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
                  </div>
                  <div class="form-group">
                     <label for="specialRequest text-dark   ">Special Request</label>
                     <textarea class="form-control" id="specialRequest" name="specialRequest"></textarea>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" type="checkbox" value="" id="termsCheckbox" required>
                     <label class="form-check-label" for="termsCheckbox">
                        I have read and agree to the General Terms & Conditions
                     </label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" type="checkbox" value="" id="tokenizationCheckbox" required>
                     <label class="form-check-label" for="tokenizationCheckbox">
                        I have read and agree to the Terms and Conditions for Tokenisation of Cards
                     </label>
                  </div>
                  <div class="form-group">
                     <label for="paymentMethod">Payment Method</label>
                     <select class="form-control" id="paymentMethod" name="paymentMethod">
                        <option value="pay_At_Hotel">Pay at Hotel</option>
                        <option value="pay_On_line">Pay Online</option>
                     </select>
                  </div>
                
                  <button type="submit" class="btn text-center">Book Now</button>
               </form>
            </div>
         </div>
      </div>
    </div>
</div>

   <!-- Footer -->
   <?php include ('_footer.php'); ?>
   <?php include ('_modal.php'); ?>
   <?php include ('_scripts.php'); ?>
</body>
</html>
