<?php
include('dbconn.php');
?>
<style>
    /* Futuristic Modal */
    .futuristic-modal {
        /* background-color: #474F7A; */
        background-image: url("../img/black.jpg") ;
        color: white;
    }

    .futuristic-input {
        color: white !important; /* Set text color to white */
        border-color: #4d4d4d;
    }

    .futuristic-modal label {
        color: #5cd1fa;
    }

    .futuristic-button {
        color: white;
        border-color: #4d4d4d;
        background-color: #5cd1fe; /* Primary button color */
        transition: background-color 0.3s, border-color 0.3s, color 0.3s; /* Transition effect */
    }

    .futuristic-button:hover {
        background-color: #4ab6f7; /* Darker shade of primary color on hover */
        border-color: #4ab6f7; /* Darker shade of primary color on hover */
    }

    .futuristic-button:focus {
        outline: none; /* Remove outline on focus */
        box-shadow: 0 0 0 0.2rem rgba(92, 209, 254, 0.5); /* Add shadow on focus */
    }

    .futuristic-icon {
        color: #5cd1fe; /* Change color as needed */
    }

    /* Hide number input buttons */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type="number"] {
        -moz-appearance: textfield;
    }
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(100%); /* Change icon color */
        font-size: 24px; /* Change icon size */
    }
</style>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="min-width: 80vw; font-family: 'Poppins', sans-serif;">
        <div class="modal-content futuristic-modal">
            <div class="modal-header item-align-center" style="background-image: url(''); background-size: cover; background-position: center; color: white;">
                <h5 class="modal-title fw-bold" id="exampleModalLabel"> Book Here </h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="searchForm" action="ext/saveFormData.php" method="POST">
                    <div class="row d-flex justify-content-between mt-2">
                        <div class="col-md-6">
                            <label for="datefrom" class="form-label fw-bold">Check-in Date</label>
                            <input type="date" class="form-control rounded-0 bg-transparent futuristic-input icon-link-hover" name="check_in_date" id="datefrom" required>
                        </div>
                        <div class="col-md-6">
                            <label for="dateto" class="form-label fw-bold">Check-out Date</label>
                            <input type="date" class="form-control rounded-0 bg-transparent futuristic-input" name="check_out_date" id="dateto"  >
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between mt-2">
                        <div class="col-md-6">
                            <label for="adults" class="form-label fw-bold">Adults</label>
                            <div class="input-group">
                                <span class="input-group-btn m-1">
                                    <button type="button" class="btn btn-outline-secondary fw-bold btn-sm rounded-0 futuristic-button" onclick="decrementAdults()"><i class="fa-solid fa-minus"></i></button>
                                </span>
                                <input type="number" min="1" class="form-control text-center rounded-0 bg-transparent futuristic-input" name="adults" id="adults" value="1">
                                <span class="input-group-btn m-1">
                                    <button type="button" class="btn btn-outline-secondary fw-bold btn-sm rounded-0 futuristic-button" onclick="incrementAdults()"><i class="fa-solid fa-plus"></i></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="children" class="form-label fw-bold">Children</label>
                            <div class="input-group">
                                <span class="input-group-btn m-1">
                                    <button type="button" class="btn btn-outline-secondary fw-bold btn-sm rounded-0 futuristic-button" onclick="decrementChildren()"><i class="fa-solid fa-minus"></i></button>
                                </span>
                                <input type="number" min="0" class="form-control text-center rounded-0 bg-transparent futuristic-input" name="children" id="children" value="0">
                                <span class="input-group-btn m-1">
                                    <button type="button" class="btn btn-outline-secondary fw-bolder btn-sm rounded-1 futuristic-button" onclick="incrementChildren()"><i class="fa-solid fa-plus"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between mt-2">
                        <div class="col-md-6 mx-auto">
                            <label for="rooms" class="form-label fw-bold">Number of Rooms</label>
                            <div class="input-group">
                                <span class="input-group-btn m-1">
                                    <button type="button" class="btn btn-outline-secondary fw-bold btn-sm rounded-0 futuristic-button" onclick="decrementRooms()"><i class="fa-solid fa-minus"></i></button>
                                </span>
                                <input type="number" min="1" value="1" class="form-control rounded-0 bg-transparent futuristic-input" name="rooms" id="rooms">
                                <span class="input-group-btn m-1">
                                    <button type="button" class="btn btn-outline-secondary fw-bold btn-sm rounded-0 futuristic-button" onclick="incrementRooms()"><i class="fa-solid fa-plus"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center p-5 pb-3">
                        <div class="col-auto text-center p-3">
                            <span class="material-symbols-outlined futuristic-icon">restaurant</span>
                            <p class="text-white">Breakfast</p>
                        </div>
                        <div class="col-auto text-center p-3">
                            <span class="material-symbols-outlined futuristic-icon">wifi</span>
                            <p class="text-white">Free Wifi</p>
                        </div>
                        <div class="col-auto text-center p-3">
                            <span class="material-symbols-outlined futuristic-icon">local_parking</span>
                            <p class="text-white">Local Parking</p>
                        </div>
                        <div class="col-auto text-center p-3">
                            <span class="material-symbols-outlined futuristic-icon">restaurant_menu</span>
                            <p class="text-white" >On Site Restaurant</p>
                        </div>
                        <div class="col-auto text-center p-3">
                            <span class="material-symbols-outlined futuristic-icon">room_service</span>
                            <p class="text-white">Room Service</p>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn  rounded-0 futuristic-button">Search</button>
            </div>
            </form>
        </div>
    </div>
</div>
