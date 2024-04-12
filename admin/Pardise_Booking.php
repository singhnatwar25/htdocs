
<?php
  session_start();
  if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;   
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Jain Hotels & Dinings</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://db.onlinewebfonts.com/c/83e4a6b639612cd501853be5a7cf97ab?family=Trend+Sans+One+Regular" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Trend+Sans+One+Regular" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .topbar {
        border-bottom: 2px solid #007bff;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
    }

    .header {
        border-bottom: 2px solid #007bff;
        font-family: 'Trend Sans One Regular', sans-serif;
    }

    .navbar {
        font-family: 'Trend Sans One Regular', sans-serif;
        font-size: 14px;
    }

    .hero-section {
        font-size: 14px;
    }
</style>

<body>

    <header>
        <!-- Topbar -->
        <div class="topbar bg-dark text-light py-3 shadow-sm">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-auto mx-auto">
                        <span id="currentDateTime" class="text-light"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header -->
        <div class="header bg-light py-4">
            <div class="container">
                <h1 class="text-primary text-center">S.K Pardise</h1>
            </div>
        </div>

        <!-- Main Menu -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light d-lg-block d-none fixed-top position-relative ">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Bookings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage-rooms.php">Rooms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage-hotels.php">Hotels</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Inventory</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Customers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Settings</a>
                        </li>
                    </ul>

                    <div class="col-auto">
                        <a href="logout.php" class="btn btn-outline-primary fs-6">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Content -->
    <?php
require_once('dbconn.php');  // Database connection

// Query to select distinct booking dates
$dateQuery = "SELECT  DISTINCT DATE(bookingDate) AS booking_date FROM booking ORDER BY id DESC";
$dateResult = $conn->query($dateQuery);

?>
    <!-- Content -->
    <div class="container-fluid ">
        <h1 class=" mb-4">Booking</h1>

        <?php
        // Loop through distinct booking dates
        while ($dateRow = $dateResult->fetch_assoc()) {
            $bookingDate = $dateRow['booking_date'];

            // Query bookings for the current date
            $sql = "SELECT * FROM booking WHERE DATE(bookingDate) = '$bookingDate' AND hotel_id = '1' ORDER BY id DESC";
            $result = $conn->query($sql);

            // Check if there are any bookings for the current date
            if ($result->num_rows > 0) {
                echo "<h4 class='bg-secondary text-center text-white '>$bookingDate</h4>"; // Display the booking date as heading

                echo "<table class='table table-bordered table-sm' style='font-size: small;'>
                        <thead class='table-dark'>
                            <tr>
                                <th>ID</th>
                                <th>h_id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Adults</th>
                                <th>Children</th>
                                <th>Rooms</th> 
                                <th>Room Type</th>
                                <th>Price per Night</th>
                                <th>Payment Method</th>
                               
                              
                                <th>Confirm</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>";

                // Output data of each booking for the current date
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    // Output booking details
                    // Modify this according to your database schema
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["hotel_id"] . "</td>";                  
                    echo "<td class='text-dark fw-bold'>" . $row["firstName"] ."  ". $row["lastName"]. "</td>";                   
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["phoneNumber"] . "</td>";
                    echo "<td>" . $row["checkInDate"] . "</td>";
                    echo "<td>" . $row["checkOutDate"] . "</td>";
                    echo "<td>" . $row["adults"] . "</td>";
                    echo "<td>" . $row["children"] . "</td>";
                    echo "<td>" . $row["rooms"] . "</td>";
                    echo "<td>" . $row["room_type"] . "</td>";
                    echo "<td class='text-success fw-bold'>" . $row["price_per_night"] . "</td>";
                    echo "<td>" . $row["paymentMethod"] . "</td>";                    
                    echo "<td class='text-dark fw-bold'>" . $row["Confirm"] . "</td>";
                    echo "<td>
                                <a href='update_booking.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm'>Edit</a>
                                <a href='#' onclick='confirmDelete(" . $row["id"] . ")' class='btn btn-danger btn-sm'>Delete</a>                              </td>";
                    echo "</tr>";
                }

                echo "</tbody>
                    </table>";
            } else {
                echo "<p>No bookings found for $bookingDate</p>";
            }
        }
        ?>

    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- JavaScript for Desktop-Only Modal -->
    <!-- JavaScript for Desktop-Only Modal -->
    <script>
        function updateDateTime() {
            var now = new Date();
            var dateTimeString = now.toLocaleString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                hour12: true
            });
            document.getElementById('currentDateTime').textContent = dateTimeString;
        }
        updateDateTime(); // Update initially
        setInterval(updateDateTime, 1000); // Update every second


        // Show modal only on desktop
        var isDesktop = window.matchMedia("only screen and (max-width: 768px)").matches;

        if (isDesktop) {
            $(document).ready(function() {
                $('#desktopOnlyModal').modal('show');
            });
        }
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this booking?')) {
                window.location.href = 'delete-booking.php?id=' + id;
                
            }
        }
    </script>
</body>
</html>



