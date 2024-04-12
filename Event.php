<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Jain Hotels</title>
   <?php include('ext/_cdn.php'); ?>
</head>
<style>
   h2 {
      font-family: "Trend Sans One Regular";
      color: #283e53;
      font-weight: 300 !important;
   }

   p {
            font-size: 1rem;
        }

   .carousel-caption {
            position: absolute;
            top: 70%;
            transform: translateY(-50%);
            text-align: center;
            /* width: 100%; */
        }

        .carousel-caption h1 {
            font-size: 3rem;
            text-decoration: underline;
            text-underline-offset: 8px;
            text-shadow: 2px 2px 4px #000;
        }
        h1, h2 {
            font-family: 'Garamond', serif;
            color: #6a4f4b;
        }
        
        .text-center {
            text-align: center;
        }

        .fw-bold {
            font-weight: bold;
        }

        img.w-25 {
            filter: sepia(100%);
        }
        .btn-vintage {
        font-family: 'Garamond', serif;
        background-color: #6a4f4b; /* A deep, vintage color */
        border: none;
        color: #fff;
        padding: 10px 20px;
        font-size: 1.2rem;
        transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
        border-radius: 0; /* Vintage buttons often had sharper corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-transform: uppercase; /* Gives it a more distinguished look */
    }

    .btn-vintage:hover, .btn-vintage:focus {
        background-color: #50342c; /* A darker shade for hover effect */
        color: #f4f4f2;
        text-decoration: none;
    }
    .section-title {
      position: relative;
      display: inline-block;
      padding-bottom: 0.25rem;
   }

   .section-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      width: 60%;
      height: 2px;
      background-color: #6a4f4b;
      transform: translateX(-50%);
   }
   .blockquote {
      font-family: 'Georgia', serif;
      font-style: italic;
      opacity: 0.8;
   }

   .blockquote-footer {
      font-style: normal;
      opacity: 0.8;
   }

   /* Enhancing the button style */
   .btn-vintage {
      letter-spacing: 0.05rem; /* Slightly spaced out letters */
      border: 2px solid #6a4f4b; /* Adding a border to the button */
   }

   .btn-vintage:hover {
      background-color: #6a4f4b;
      color: #f4f4f2;
   }
   
        
</style>

<body class="custom-scrollbar">
   <?php include('ext/_header.php'); ?>
   <header class="header">
      <section class="hero">
         <video src="https://videos.hyatt.com/place_jaizm_masthead_0623.mp4" class="object-fit-cover w-100" autoplay muted loop>
            <source src="https://videos.hyatt.com/place_jaizm_masthead_0623.mp4" type="video/mp4">
            Your browser does not support the video tag.
         </video>
         <div class="carousel-caption">
            <h1 class="text-light"><u>𝑬𝒗𝒆𝒏𝒕𝒔</u></h1>
         </div>
      </section>
   </header>
   <section id="eventId">
      <div class="container">
         <h2 class="text-center fw-bold p-0"><img src="../img/line3-removebg.png" alt="" class="p-0" width="200" height="200"> 𝑬𝒗𝒆𝒏𝒕𝒔 <img src="../img/line3-removebg.png" alt="" class="" width="200" height="200">  </h2>    
         <p class="text-center">Step back in time and experience the grandeur of our vintage-themed events. Each detail meticulously crafted to transport you to a bygone era of elegance and charm.</p>
      </div>
      <!-- /design this website accoridng to vintage era  -->
      
   </section>
   <section id="eventTypes" class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">Our Event Specialties</h2>
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="../img/vintage-wedding.jpg" alt="Vintage Wedding" class="img-fluid mb-3" style="filter: sepia(60%);">
                <h3>Weddings</h3>
                <p>Experience a timeless wedding in a setting that transports you and your guests to a bygone era of romance and elegance.</p>
            </div>
            <div class="col-md-4 text-center">
                <img src="../img/vintage-gala.jpg" alt="Vintage Gala" class="img-fluid mb-3" style="filter: sepia(60%);">
                <h3>Gala Dinners</h3>
                <p>Our gala dinners are a throwback to the lavish parties of the early 20th century, with exquisite cuisine and classic decor.</p>
            </div>
            <div class="col-md-4 text-center">
                <img src="../img/vintage-meeting.webp" alt="Vintage Meeting" class="img-fluid mb-3" style="filter: sepia(60%);">
                <h3>Corporate Events</h3>
                <p>Host your next corporate event in a unique vintage setting that inspires creativity and camaraderie among attendees.</p>
            </div>
        </div>
    </div>
</section>

<section id="testimonials" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">What Our Guests Say</h2>
        <div class="row">
            <div class="col-md-6">
                <blockquote class="blockquote">
                    <p class="mb">"Attending a wedding at Jain Hotels was like stepping into a dream. The attention to detail and the vintage theme made it an unforgettable experience."</p>
                    <footer class="blockquote-footer">Charlotte Perkins, <cite title="Source Title">June 2022</cite></footer>
                </blockquote>
            </div>
            <div class="col-md-6">
                <blockquote class="blockquote">
                    <p class="mb">"Our company's annual gala was held at Jain Hotels, and it was the most talked-about event of the year. The vintage setting was absolutely perfect."</p>
                    <footer class="blockquote-footer">John Smith, <cite title="Source Title">December 2022</cite></footer>
                </blockquote>
            </div>
        </div>
    </div>
</section>

<section id="bookEvent" class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">Book Your Vintage Event Today</h2>
        <p class="text-center">Ready to host your event in a venue that offers a unique blend of historical elegance and modern amenities? Contact us today to start planning your unforgettable vintage-themed event.</p>
        <div class="text-center mt-4">
            <a href="contact.php" class="btn btn-vintage">Contact Us</a>
        </div>
    </div>
</section><div class="text-center mt-4">
    
</div>
   <?php include('ext/_footer.php'); ?>
   <?php include('ext/_modal.php'); ?>
   <?php include('ext/_scripts.php'); ?>
</body>

</html>