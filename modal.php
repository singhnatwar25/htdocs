<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>
<style>
    .modal-header {
        background-image: url("path/to/your/image.jpg");
        /* Replace with your image path */
        background-size: cover;
        background-position: center;
        /* color: white;  */
    }
</style>

<body>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            style="min-width: 80vw;font-family: 'Poppins', sans-serif;">
            <div class="modal-content">
                <div class="modal-header"
                    style="background-image: url('path/to/your/image.jpg'); background-size: cover; background-position: center; color: white;">
                    <h5 class="modal-title fw-bold text-black " id="exampleModalLabel">Current Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="get">

                        <div class="row d-flex justify-content-between">
                            <div class="col-md-12">
                                <label for="bookingType" class="form-label">Booking Type</label>
                                <select class="form-select rounded-0 bg-transparent" id="bookingType"
                                    aria-label="Booking Type">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-between mt-2">
                            <div class="col-md-6">
                                <label for="datefrom" class="form-label">Check-in Date</label>
                                <input type="date" class="form-control rounded-0 bg-transparent" name="datefrom"
                                    id="datefrom">
                            </div>
                            <div class="col-md-6">
                                <label for="dateto" class="form-label">Check-out Date</label>
                                <input type="date" class="form-control rounded-0 bg-transparent" name="dateto"
                                    id="dateto">
                            </div>
                        </div>

                        <div class="row d-flex justify-content-between mt-2">
                            <div class="col-md-6">
                                <label for="timein" class="form-label">Check-in Time</label>
                                <input type="time" class="form-control rounded-0 bg-transparent" name="timein"
                                    id="timein">
                            </div>
                            <div class="col-md-6">
                                <label for="timeout" class="form-label">Check-out Time</label>
                                <input type="time" class="form-control rounded-0 bg-transparent" name="timeout"
                                    id="timeout">
                            </div>
                        </div>

                        <div class="row d-flex justify-content-between mt-2">
                            <div class="col-md-6">
                                <label for="adults" class="form-label">Adults</label>
                                <div class="input-group">
                                    <span class="input-group-btn m-1">
                                        <button type="button"
                                            class="btn btn-outline-secondary fw-bold btn-sm rounded-0 "
                                            onclick="decrementAdults()"> - </button>
                                    </span>
                                    <input type="number" min="0"
                                        class="form-control text-center rounded-0 bg-transparent" name="adults"
                                        id="adults" value="0">
                                    <span class="input-group-btn m-1">
                                        <button type="button"
                                            class="btn btn-outline-secondary fw-bold btn-sm rounded-0 "
                                            onclick="incrementAdults()"> + </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="children" class="form-label">Children</label>
                                <div class="input-group">
                                    <span class="input-group-btn m-1">
                                        <button type="button"
                                            class="btn btn-outline-secondary fw-bold btn-sm rounded-0 "
                                            onclick="decrementChildren()"> - </button>
                                    </span>
                                    <input type="number" min="0"
                                        class="form-control text-center rounded-0 bg-transparent" name="children"
                                        id="children" value="0">
                                    <span class="input-group-btn m-1">
                                        <button type="button"
                                            class="btn btn-outline-secondary fw-bold btn-sm rounded-0 "
                                            onclick="incrementChildren()"> + </button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-between mt-2">
                            <div class="col-md-12">
                                <label for="rooms" class="form-label">Number of Rooms</label>
                                <input type="text" class="form-control rounded-0 bg-transparent" name="rooms"
                                    id="rooms">
                            </div>
                        </div>

                        <!-- <div class="row mt-2">
                            <div class="col-md-12">
                              <label for="comments" class="form-label">Comments</label>
                              <textarea class="form-control rounded-0 bg-transparent" name="comments" id="comments" rows="3" placeholder="Enter any special requests or questions"></textarea>
                            </div>
                          </div> -->


                    </form>



                    <div class="row justify-content-center p-5 pb-3">
                        <div class="col-auto text-center p-3"><span class="material-symbols-outlined">
                                restaurant
                            </span>
                            <p>Breakfast</p>
                        </div>
                        <div class="col-auto text-center p-3"><span class="material-symbols-outlined">
                                wifi
                            </span>
                            <p>Free Wifi</p>
                        </div>
                        <div class="col-auto text-center p-3">
                            <span class="material-symbols-outlined">
                                local_parking
                            </span>
                            <p>Local Parking</p>
                        </div>
                        <div class="col-auto text-center p-3"><span class="material-symbols-outlined">
                                restaurant_menu
                            </span>
                            <p>On Site Resturant</p>
                        </div>
                        <div class="col-auto text-center p-3"><span class="material-symbols-outlined">
                                room_service
                            </span>
                            <p>Room Service</p>
                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary rounded-0">Check Availiblity</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function decrementAdults() {
            const adultInput = document.getElementById("adults");
            let currentAdults = parseInt(adultInput.value);

            if (currentAdults > 0) {
                currentAdults--;
                adultInput.value = currentAdults;
            }
        }

        function incrementAdults() {
            const adultInput = document.getElementById("adults");
            let currentAdults = parseInt(adultInput.value);
            currentAdults++;
            adultInput.value = currentAdults;
        }

        function decrementChildren() {
            const childrenInput = document.getElementById("children");
            let currentChildren = parseInt(childrenInput.value);

            if (currentChildren > 0) {
                currentChildren--;
                childrenInput.value = currentChildren;
            }
        }

        function incrementChildren() {
            const childrenInput = document.getElementById("children");
            let currentChildren = parseInt(childrenInput.value);
            currentChildren++;
            childrenInput.value = currentChildren;
        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>