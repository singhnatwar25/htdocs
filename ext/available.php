<?php
session_start();
// Check if form data is submitted
$hotelID = 1; // Assuming a default hotel ID

// Check if a new hotel ID is submitted
if(isset($_GET['newHotelID'])) {
    // Update $hotelID with the submitted value
    $hotelID = $_GET['newHotelID'];
}


if(isset($_SESSION['check_in_date']) && isset($_SESSION['check_out_date'])) {
    // Convert dates to Unix timestamps
    $check_in_timestamp = strtotime($_SESSION['check_in_date']);
    $check_out_timestamp = strtotime($_SESSION['check_out_date']);

    // Calculate the difference in seconds
    $time_diff_seconds = $check_out_timestamp - $check_in_timestamp;

    // Convert seconds to days
    $days_count = floor($time_diff_seconds / (60 * 60 * 24));

    // Store the number of days in session
    $_SESSION['days_count'] = $days_count;
} else {
    // Handle case where check-in or check-out dates are not set
    $_SESSION['days_count'] = 0; // Set default value or handle as needed
}
?>

<?php
// Include database connection file
  include ('dbconn.php');
?>
<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Jain Hotels</title>

   <?php include ('_cdn.php'); ?>
</head>
<style>
        /* Custom Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }
        
        .available
        {
            background-image: url("../img/white-texture.jpg");
            margin-top: 70px;
            
        }

        .navbar-brand {
            font-size: 1.5rem;
        }

        .card {
            border: none;
            border-radius: 10px;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
        }

        .card-text {
            color: #666;
        }

        .btn {
            background-color: #F57D1F;
            /* border-color: #007bff; */
        }
        .Pardise {
            background-color: #891652;
            /* border-color: #007bff; */
        }
        .Pardise :hover {
            background-color: #A57D1F;
            border-color: #007bff;
        }
       

        .btn:hover {
            background-color: #EABE6C;
            border-color: #0056b3;
            
        }
        .vr{
            border: 0px solid #F57D1F;
            opacity: 1;
            margin: -16px 10px 0px 10px;
        }
        .hr{
            color: black;
        }
    </style>
<body class="custom-scrollbar">
   <?php include ('_header2.php'); ?>

<div class="container-fluid pt-5  available">
    <div class="container pb-5">
    <h1 class="mt-5 mb-4 pt-5">Available Rooms <i class="fa-solid fa-suitcase"></i></h1>
    <div class="row ">
        <hr class="hr text-dark">
        <div class="col-md-3">
            <form method="GET" id="hotelForm">
            <div class="row">
        
           
                            <button type="submit" name="newHotelID" value="1" class="btn py-3 text-white rounded-0 border-warning Pardise">Hotel S.K Pardise</button>
                            <button type="submit" name="newHotelID" value="2" class="btn py-3 text-white rounded-0 border-warning Pardise">Hotel Archana</button>
                            <button type="submit" name="newHotelID" value="3" class="btn py-3 text-white rounded-0 border-warning Pardise">Hotel K.S Pride</button>
                        </form>
           </div>

        </div>
       <hr class="vr mx-3 p-0 text-dark">
        <div class="col-md-8 justify-content-end">
       
        <?php
        
    // Fetch available rooms from the database
    // $sql = "SELECT * FROM Rooms WHERE availability = 'available' AND hotel_id = '$hotelID' INNER JOIN hotel ON rooms.hotel_id=hotels.hotel_id";
    $sql = "SELECT * FROM Rooms INNER JOIN hotels ON rooms.hotel_id=hotels.hotel_id WHERE availability = 'available' AND rooms.hotel_id = '$hotelID'";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="col mb-4">
                <div class="card  text-end ">
                    <div class="card-body m-0 p-3">
                        <div class="row">
                        <div class="col-6">
                        <img src="../admin/<?php echo $row["room_img"] ?>" class="card-img-top w-100 rounded-1" alt="Room Image">
                        </div>
                        <div class="col-6">

                        <h3 class="card-text text-start text-primary fw-bolder"> <?php echo $row["name"]; ?></h3>
                        <h2 class="card-text text-center"> <?php  $row["hotel_id"]; ?></h2>
                        <p class="card-text text-start fw-bolder text-dark text-start p-0 ">Room Type: <?php echo $row["room_type"]; ?></p>
                        <p class="card-text  p-0 "><?php echo $_SESSION['days_count'];?> nights <?php echo $_SESSION['adults']; ?> guests</p>
                        
                        <h4 class="card-text text-dark">₹ <?php echo $row["price_per_night"]* $_SESSION['days_count']; ?></h4>
                        <!-- Pass room_id and other details as parameters in the URL -->
                        <a href="book.php?room_id=<?php echo $row['room_id']; ?>&room_type=<?php echo $row['room_type']; ?>&price_per_night=<?php echo $row['price_per_night']* $_SESSION['days_count']; ?>&hotel_id=<?php echo $row['hotel_id']; ?>" class="btn  text-dark rounded-0 ">Book Now</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<div class='col'>No available rooms.</div>";
    }
    ?>
          </div>
    </div>
</div>
</div>

<?php include ('_footer.php'); ?>
         <?php include ('_modal.php'); ?>
         <?php include ('_scripts.php'); ?>

         <script>
            function changeId(id) {
                document.getElementById('hotelId').innerText = id;
            }
         </script>
</body>
</html>