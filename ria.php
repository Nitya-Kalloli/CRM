<?php
session_start();
$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;
include 'link.php';
include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>
    <style>
        .body2 {
    background-color: #c2c0c0;
    padding: 20px;
}

.tet p {
    margin-top: 9px;
    font-size: 13px;
    text-align: right;
}

.tet input {
    height: 30px;
    margin-bottom: 15px;
    margin-left: 0px;
    width: 95%;
}

.tet div {
    margin: 0px;
}

.underline {
    border: none;
    border-bottom: 1px solid blue;
    background-color: transparent;
    outline: none;
}

.whi {
    background-color: #ffffff;
    border: 1px solid blue;
}

.whi1 {
    background-color: #c2c0c0;
    border: 1px solid rgb(79, 79, 238);
}

.bol .whi p {
    font-weight: bold;
    text-align: center;
    margin-top: 7px;
    margin-bottom: 7px;
}

.bol1 .whi1 p {
    height: 20px;
    font-weight: bold;
    text-align: center;
    margin-top: 7px;
    margin-bottom: 7px;
}

.whi2 {
    height: 35px;
    background-color: #ffffff;
    /* border: 1px solid blue; */
}

.whi12 {
    background-color: #c2c0c0; /* Set the desired background color (white in this case) */
    padding: 10px; /* Add padding for spacing inside each column */
  }

  .whi12 input {
    border: 1px solid rgb(79, 79, 238);
    outline: none; /* Remove outline on focus */
    width: 100%; /* Make the input boxes fill the entire column width */
    background-color: transparent; /* Make the input background transparent */
  }
    </style>
    <div class="body2">

        <div class=" ">
            <div class="row" style="margin-bottom: 50px;">
                <div class="col-md-2 ">
                    <label for="name">Company:</label>
                    <input type="text" id="name" class="name">
                </div>

                <div class="col-md-7">
                 </div>

                 <div class="col-md-3 tet">
                    <div class="row">
                        <div class="col-md-4">
                            <p class="text-right">Bill Number</p>
                        </div>
                        <div class="col-md-5">
                            <input type="text" id="billnumber" class="underline">
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p class="text-right">Bill Date</p>
                        </div>
                        <div class="col-md-5">
                            <input type="text" id="datepicker" class="underline">
                        </div>
                        <div class="col-md-3">
                            <span id="calendar-icon" style="cursor: pointer;"><i class="fa-solid fa-calendar-days" style="color: #0e0ecd; font-size:25px;"></i></span>
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const datepicker = flatpickr("#datepicker", {
                                    dateFormat: "Y-m-d", // Set your desired date format
                                    onClose: function(selectedDates, dateStr, instance) {
                                        // Handle date selection if needed
                                        console.log(dateStr);
                                    }
                                });

                                // Open the calendar when the icon is clicked
                                document.getElementById('calendar-icon').addEventListener('click', function() {
                                    datepicker.open();
                                });
                            });
                        </script>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p class="text-right">State of Supply</p>
                        </div>
                        <div class="col-md-5">
                            <select id="state" class="underline">
                                <option>Karanataka</option>
                                <option>Maharastra</option>
                                <option>Tamil nadu</option>
                                <option>Goa</option>
                                <option>Rajastan</option>
                                <option>Andra pradesh</option>
                                <option>Kerla</option>
                                <option>Gujrat</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>

                </div>
            </div>


            <div class="row bol">
                <div class="col-md-1 whi">
                    <p>Sl.no</p>
                </div>
                <div class="col-md-6 whi">
                    <p>Items</p>
                </div>
                <div class="col-md-1 whi">
                    <p>Qyt</p>
                </div>
                <div class="col-md-1 whi">
                    <p>Price</p>
                </div>
                <div class="col-md-1 whi">
                    <p>Free Qyt</p>
                </div>
                <div class="col-md-1 whi">
                    <p>GST</p>
                </div>
                <div class="col-md-1 whi">
                    <p>Total price</p>
                </div>
            </div>

            <div class="row bol1">
                <div class="col-md-1 whi1">
                    <p></p>
                </div>
                <div class="col-md-6 whi1">
                    <p></p>
                </div>
                <div class="col-md-1 whi1">
                    <p></p>
                </div>
                <div class="col-md-1 whi1">
                    <p></p>
                </div>
                <div class="col-md-1 whi1">
                    <p></p>
                </div>
                <div class="col-md-1 whi1">
                    <p></p>
                </div>
                <div class="col-md-1 whi1">
                    <p></p>
                </div>
            </div>

            <div class="row bol1">
                <div class="col-md-1 whi1">
                    <p></p>
                </div>
                <div class="col-md-6 whi1">
                    <p></p>
                </div>
                <div class="col-md-1 whi1">
                    <p></p>
                </div>
                <div class="col-md-1 whi1">
                    <p></p>
                </div>
                <div class="col-md-1 whi1">
                    <p></p>
                </div>
                <div class="col-md-1 whi1">
                    <p></p>
                </div>
                <div class="col-md-1 whi1">
                    <p></p>
                </div>
            </div>                

                <!-- -------------------Total----------------- -->
                <div class="row bol">
                    <div class="col-md-1 whi2">
                        <p></p>
                    </div>
                    <div class="col-md-6 whi2" style="padding: 0px;">
                        <button type="submit" style="margin:0px; background-color:rgb(79, 79, 238, 0.4); border-radius:8px; margin-top:2px;" onclick="addrow()">Add Row</button>
                    </div>
                    <div class="col-md-1 whi2">
                        <p></p>
                    </div>
                    <div class="col-md-1 whi2">
                        <p></p>
                    </div>
                    <div class="col-md-1 whi2">
                        <p></p>
                    </div>
                    <div class="col-md-1 whi2">
                        <p></p>
                    </div>
                    <div class="col-md-1 whi2">
                        <p></p>
                    </div>
                </div>

            </div>
        </div>
</body>

</html>