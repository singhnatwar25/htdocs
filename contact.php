<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Jain Hotels</title>
   <?php include ('ext/_cdn.php'); ?>
</head>
<style>
   h2 {
      font-family: "Trend Sans One Regular";
      color: #283e53;
      font-weight: 300 !important;
   }

   p {
      font-family: 'open sans';
      line-height: 1.6rem;
      font-weight: 300 !important;
   }
</style>

<body class="custom-scrollbar">
<?php include ('ext/_header.php'); ?>

   <header class="header">
      <section class="hero">
         <video src="https://videos.hyatt.com/place_jaizm_masthead_0623.mp4" class="object-fit-cover w-100" autoplay
            muted loop>
            <source src="https://videos.hyatt.com/place_jaizm_masthead_0623.mp4" type="video/mp4">
            Your browser does not support the video tag.
         </video>
      </section>
   </header>


   <!--Section: Contact v.2-->
   <section class="mb-4" id="contactid" >

      <!--Section heading-->
      <h2 class="h1-responsive font-weight-bold text-center my-4" >Contact us</h2>
      <!--Section description-->
      <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us
         directly. Our team will come back to you within
         a matter of hours to help you.</p>

      <div class="container py-5" id="contact" names="contact">
         <div class="row justify-content-center">
            <div class="col-md-7 shadow-sm rounded p-4 bg-light">
               <form id="contact-form" name="contact-form" action="mail.php" method="POST">
                  <h3 class="text-center mb-4">Contact Us</h3>


                  <div class="row mb-3">
                     <div class="col-md-6">
                        <div class="form-group">
                           <input type="text" id="name" name="name" class="form-control border-0 p-3"
                              placeholder="Your name">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <input type="email" id="email" name="email" class="form-control border-0 p-3 "
                              placeholder="Your email">
                        </div>
                     </div>
                  </div>

                  <div class="row mb-3">
                     <div class="col-md-12">
                        <div class="form-group">
                           <input type="text" id="subject" name="subject" class="form-control border-0 p-3"
                              placeholder="Subject">
                        </div>
                     </div>
                  </div>

                  <div class="row mb-3">
                     <div class="col-md-12">
                        <div class="form-group">
                           <textarea id="message" name="message" rows="5" class="form-control border-0"
                              placeholder="Your message"></textarea>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">Send <i class="fas fa-paper-plane"></i></button>
                     </div>
                  </div>
               </form>
            </div>

            <div class="col-md-3 text-center pt-4">
               <h4 class="mb-4">Our Information</h4>
               <ul class="list-unstyled">
                  <li>
                     <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                     <p class="mt-2">San Francisco, CA 94126, USA</p>
                  </li>
                  <li>
                     <i class="fas fa-phone mt-4 fa-2x text-primary"></i>
                     <p class="mt-2">+ 01 234 567 89</p>
                  </li>
                  <li>
                     <i class="fas fa-envelope mt-4 fa-2x text-warning"></i>
                     <p class="mt-2">contact@mdbootstrap.com</p>
                  </li>
               </ul>
            </div>
         </div>
      </div>
    <hr class="hr text-primary   ">

   </section>
   <!--Section: Contact v.2-->






   <?php include ('ext/_footer.php'); ?>
   <?php include ('ext/_modal.php'); ?>
   <?php include ('ext/_scripts.php'); ?>
</body>

</html>