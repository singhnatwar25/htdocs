<?php
// session_start();

// Check if user is not logged in, redirect to login page
// if (!isset($_SESSION['user_id'])) {
//     header("Location: index.php");
//     exit;
// }

// Sample hotel data for demonstration
$hotels = array(
    array(
        'name' => 'Jain Hotel (Sindhi Camp)',
        'location' => 'Sindhi Camp',
        'link' => 'hotel1/bookings.php',
        'image' => 'https://source.unsplash.com/featured/?hotel'
    ),
    array(
        'name' => 'Jain Hotel (Tonk Road)',
        'location' => 'Tonk Road',
        'link' => 'hotel2/bookings.php',
        'image' => 'https://source.unsplash.com/featured/?restro'
    ),
    array(
        'name' => 'Jain Hotel (Location)',
        'location' => 'Location',
        'link' => 'hotel3/bookings.php',
        'image' => 'https://source.unsplash.com/featured/?villa'
    )
);
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
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
        }

        .nav-link {
            font-weight: 500;
            font-size: 1.1rem;
        }

        .hero-section {
            padding: 100px 0;
        }

        .hero-text {
            text-align: center;
            color: #495057;
        }

        .card {
            border: none;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            object-fit: cover;
            height: 200px;
        }

        .card-title {
            font-weight: 600;
            font-size: 1.2rem;
            margin-top: 20px;
        }

        .card-text {
            font-size: 1rem;
            color: #6c757d;
        }

        .btn-outline-dark {
            border-color: #343a40;
            color: #343a40;
            transition: all 0.3s ease;
        }

        .btn-outline-dark:hover {
            background-color: #343a40;
            color: #fff;
        }
    </style>
</head>

<body>

    <header>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">Jain Hotels & Dinings</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Bookings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Rooms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Inventory</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Customers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Settings</a>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-outline-dark">Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <?php
    function isRoomBooked($hotelId, $roomId)
    {
        // Your logic to check if a room is booked or not, e.g., querying a database
        // Here, I'm assuming a simple example where room 1 is booked for hotel 1
        return ($hotelId == 1 && $roomId == 1) ? true : false;
    }
    ?>
    <section class="hero-section">
        <div class="container">
            <div class="hero-text">
                <h1>Welcome to Jain Hotels Admin Dashboard</h1>
                <p class="lead">Manage your hotels efficiently</p>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4 mt-5">
                <!-- Hotel Cards -->
                <?php foreach ($hotels as $hotel) : ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="<?php echo $hotel['image'] ?? ''; ?>" class="card-img-top" alt="<?php echo $hotel['name'] ?? ''; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $hotel['name'] ?? ''; ?></h5>
                                <p class="card-text">
                                    Manage bookings and operations for Hotel <?php echo $hotel['name'] ?? ''; ?> (<?php echo $hotel['location'] ?? ''; ?>).
                                    <!-- Display booked status based on room availability -->
                                    <?php
                                    $roomId = 1; // Assuming room ID 1 for this example
                                    $isBooked = isset($hotel['id']) ? isRoomBooked($hotel['id'], $roomId) : false;
                                    ?>
                                    <span id="booked-status-<?php echo $hotel['id'] ?? ''; ?>">
                                        <?php echo ($isBooked ? "1 room booked" : "0 rooms booked"); ?>
                                    </span>
                                </p>
                                <a href="<?php echo $hotel['link'] ?? '#'; ?>" class="btn btn-outline-dark">View Bookings</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- Booking Summary Card -->
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Booking Summary</h5>
                            <p class="card-text">View and manage bookings for all hotels.</p>
                            <a href="booking-summary.php" class="btn btn-outline-dark">View Summary</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-dark text-white p-4">
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4">
                    <h5>Contact Us</h5>
                    <p>Email: info@jainhotels.com</p>
                    <p>Phone: +1 (123) 456-7890</p>
                </div>
                <div class="col-lg-4">
                    <h5>Follow Us</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none ">Facebook</a></li>
                        <li><a href="#" class="text-white text-decoration-none ">Twitter</a></li>
                        <li><a href="#" class="text-white text-decoration-none ">Instagram</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none ">Dashboard</a></li>
                        <li><a href="#" class="text-white text-decoration-none ">Bookings</a></li>
                        <li><a href="#" class="text-white text-decoration-none ">Settings</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <span>&copy; 2024 Jain Hotels & Dinings. All rights reserved.</span>
        </div>
    </footer>
    <!-- End of Footer -->

    <!-- Bootstrap JS -->
    <script>
        // Example JavaScript code to update booked status
        function updateBookedStatus(hotelId, isBooked) {
            var statusElement = document.getElementById("booked-status-" + hotelId);
            if (isBooked) {
                statusElement.textContent = "1 room booked";
            } else {
                statusElement.textContent = "0 rooms booked";
            }
        }

        // Usage example (call this function when a room is booked or canceled)
        var hotelId = 1; // Example hotel ID
        var isBooked = true; // Example, change this based on actual booking status
        updateBookedStatus(hotelId, isBooked);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>