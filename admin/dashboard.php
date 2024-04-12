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
    <link href="https://db.onlinewebfonts.com/c/83e4a6b639612cd501853be5a7cf97ab?family=Trend+Sans+One+Regular"
        rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Trend+Sans+One+Regular" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

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

        .hero-section{
            font-size: 14px;
            background-image: url(../img/white-texture.jpg);
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
                <h1 class="text-primary text-center">Jain Hotels & Dinings</h1>
            </div>
        </div>

        <!-- Main Menu -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light d-lg-block d-none fixed-top position-relative ">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="All-Bookings.php">Bookings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage-rooms.php">Rooms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage-hotels.php">Hotels</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Inventory</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Customers</a>
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
    <!-- Hero Section -->
    <section class="hero-section py-5 bg-body-tertiary bgcustom">
        <div class="container">
            <h2 class="display-4 text-center mb-5">Welcome to Jain Hotels Admin Dashboard</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Hotel Cards -->
                <div class="col">
                    <div class="card h-100 p-2 bg-light">
                        <img src="../img/Hotel room.jpg" class="card-img-top" alt="Jain Hotel (Sindhi Camp)">
                        <div class="card-body text-center">
                            <h5 class="card-title">Hotel S.K Pardise  (Sindhi Camp)</h5>
                            <p class="card-text">Manage bookings and operations for Hotel Jain Hotel (Sindhi Camp).</p>
                            <a href="Pardise_Booking.php" class="btn btn-outline-dark bg-light">View Bookings</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="../img/room3.jpg" class="card-img-top" alt="Jain Hotel (Tonk Road)">
                        <div class="card-body text-center">
                            <h5 class="card-title">Hotel Archana (Tonk Road)</h5>
                            <p class="card-text">Manage bookings and operations for Hotel Jain Hotel (Tonk Road).</p>
                            <a href="Archana_Booking.php" class="btn btn-outline-dark bg-light">View Bookings</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="../img/295688360.jpg" class="card-img-top" alt="Jain Hotel (Location)">
                        <div class="card-body text-center">
                            <h5 class="card-title">Hotel K.S Pride (Durgapura)</h5>
                            <p class="card-text">Manage bookings and operations for Hotel Jain Hotel (Durgapura).</p>
                            <a href="Pride_Booking.php" class="btn btn-outline-dark bg-light">View Bookings</a>
                        </div>
                    </div>
                </div>
                <!-- Additional Functionality Cards -->
                <div class="col">
                    <div class="card h-100">
                        <img src="" class="card-img-top" alt="Manage Available Rooms">
                        <div class="card-body">
                            <h5 class="card-title">Manage Available Rooms</h5>
                            <p class="card-text">Efficiently manage room availability across all hotels.</p>
                            <a href="manage-rooms.php" class="btn btn-outline-dark">Manage Rooms</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="inventory.jpg" class="card-img-top" alt="Inventory Management">
                        <div class="card-body">
                            <h5 class="card-title">Inventory Management</h5>
                            <p class="card-text">Track and manage hotel inventory efficiently.</p>
                            <a href="#" class="btn btn-outline-dark">View Inventory</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="report.jpg" class="card-img-top" alt="Reporting">
                        <div class="card-body">
                            <h5 class="card-title">Reporting</h5>
                            <p class="card-text">Generate insightful reports for business analysis.</p>
                            <a href="#" class="btn btn-outline-dark">View Reports</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

  
    <!-- Desktop-Only Modal -->
    <!-- Desktop-Only Modal -->
    <div class="modal fade" id="desktopOnlyModal" tabindex="-1" aria-labelledby="desktopOnlyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title" id="desktopOnlyModalLabel">Welcome to the Admin Dashboard!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>This dashboard is optimized for desktop viewing to provide you with the best experience.</p>
                    <p>You'll have access to various features and functionalities tailored for managing your hotel
                        efficiently.</p>
                    <p>For a comprehensive view and easier navigation, we recommend using a desktop or laptop device.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>

    <!-- JavaScript for Desktop-Only Modal -->
    <!-- JavaScript for Desktop-Only Modal -->
    <script>

        function updateDateTime() {
            var now = new Date();
            var dateTimeString = now.toLocaleString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true });
            document.getElementById('currentDateTime').textContent = dateTimeString;
        }
        updateDateTime(); // Update initially
        setInterval(updateDateTime, 1000); // Update every second


        // Show modal only on desktop
        var isDesktop = window.matchMedia("only screen and (max-width: 768px)").matches;

        if (isDesktop) {
            $(document).ready(function () {
                $('#desktopOnlyModal').modal('show');
            });
        }
    </script>


</body>

</html>