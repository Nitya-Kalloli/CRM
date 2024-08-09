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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body style="background-color: rgba(194, 192, 192, 0.4);">
    <h1 style="text-align: center; margin-top:20px">Purchase</h1>
    <div class="body2">

        <div class=" ">
            <div class="row" style="margin-bottom: 50px;">

                <div class="col-md-2">
                    <label for="name">Company:</label>
                    <div class="search d-flex">
                        <input id="searchInput" type="text" placeholder="Company">
                        <button onclick="searchcompany()" style="font-size: 14px; padding-left:2px">Search</button>
                    </div>
                    <div id="searchResults"></div>

                    <script>
                        function searchcompany() {
                            // Get the search term from the input field
                            var searchTerm = $('#searchInput').val();

                            // Send an AJAX request to the server to perform the search
                            $.ajax({
                                url: './ajax/searchcompanypurchase.php', // Your PHP script handling the search
                                method: 'POST',
                                data: {
                                    searchTerm: searchTerm
                                },
                                success: function (response) {
                                    // Update the searchResults div with the response from the server
                                    $('#searchResults').html(response);

                                    // Add a click event listener to each search result
                                    $('.search-result').click(function () {
                                        // Set the selected company name to the input field
                                        var companyName = $(this).find('.company-name').text();
                                        $('#searchInput').val(companyName);

                                        // Clear the search results
                                        $('#searchResults').html('');
                                    });
                                },
                                error: function (error) {
                                    console.error('Error during search:', error);
                                }
                            });
                        }
                    </script>
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
                            <span id="calendar-icon" style="cursor: pointer;"><i class="fa-solid fa-calendar-days"
                                    style="color: #0e0ecd; font-size:25px;"></i></span>
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const datepicker = flatpickr("#datepicker", {
                                    dateFormat: "Y-m-d", // Set your desired date format
                                    onClose: function (selectedDates, dateStr, instance) {
                                        // Handle date selection if needed
                                        console.log(dateStr);
                                    }
                                });

                                // Open the calendar when the icon is clicked
                                document.getElementById('calendar-icon').addEventListener('click', function () {
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
                    <p>Total Amount</p>
                </div>
            </div>

            <div class="row bol1">
                <div class="col-md-1 whi1">
                    <p style="width: 100%; background-color: #c2c0c0; text-align:left; padding-left:2px;">1</p>
                </div>
                <div class="col-md-6 whi1">
                    <input id="itemInput" type="text" class="form-control item-input"
                        style="width: 100%; background-color: #c2c0c0;">
                    <div id="itemSuggestions"></div>
                </div>
                <div class="col-md-1 whi1">
                    <input type="text" id="quantityInput" class="form-control quantity-input"
                        style="width: 100%; background-color: #c2c0c0;">
                </div>
                <div class="col-md-1 whi1">
                    <input type="text" id="mrp" class="form-control price-input"
                        style="width: 100%; background-color: #c2c0c0;">
                </div>
                <div class="col-md-1 whi1">
                    <input type="text" id="free" class="form-control" style="width: 100%; background-color: #c2c0c0;">
                </div>
                <div class="col-md-1 whi1">
                    <input type="text" id="gst" class="form-control" style="width: 100%; background-color: #c2c0c0;">
                </div>
                <div class="col-md-1 whi1">
                    <input type="text" id="totalPriceInput" class="form-control total-price-input"
                        style="width: 100%; background-color: #c2c0c0;">
                </div>

                <script>
                    $(document).ready(function () {

                        // Attach an input event listener to the item input
                        $('#itemInput').on('input', function () {
                            // Get the current value of the input
                            var searchTerm = $(this).val();

                            // Check if the input is not empty before making the AJAX request
                            if (searchTerm.trim() !== '') {
                                // Send an AJAX request to fetch matching items
                                $.ajax({
                                    url: './ajax/searchitemspur.php',
                                    method: 'POST',
                                    data: {
                                        searchTerm: searchTerm
                                    },
                                    success: function (response) {
                                        try {
                                            var items = JSON.parse(response).items;

                                            // Check if items is an array
                                            if (Array.isArray(items)) {
                                                var suggestionsString = items.map(function (item) {
                                                    return '<div class="suggestion" style="background-color: #e0e0e0; border: 1px solid black; padding: 5px; cursor: pointer; width: 70%">' + item + '</div>';
                                                }).join('');

                                                // Update the itemSuggestions div with the suggestions
                                                $('#itemSuggestions').html(suggestionsString);

                                                // Add a click event listener to each suggestion
                                                $('.suggestion').click(function () {
                                                    // Set the selected company name to the input field
                                                    var name = $(this).text();
                                                    $('#itemInput').val(name);

                                                    // Clear the suggestions
                                                    $('#itemSuggestions').html('');

                                                    let mrp = $("#mrp").val();
                                                    let gst = $("#gst").val();
                                                    $.ajax({
                                                        url: './ajax/bringprice.php',
                                                        method: "POST",
                                                        data: {
                                                            searchTerm: searchTerm,
                                                            mrp: mrp,
                                                            gst: gst,
                                                        },
                                                        success: function (res) {

                                                            var result = JSON.parse(res);

                                                            // Set the values to the corresponding input boxes
                                                            $('#mrp').val(result.mrp);
                                                            var gstValue = parseFloat(result.gst);

                                                            // Add a percentage sign to the value
                                                            var gstWithPercentage = gstValue + '%';

                                                            // Set the value of #gst
                                                            $('#gst').val(gstWithPercentage); $('#quantityInput').val(1);

                                                            var mrp = parseFloat($('#mrp').val());
                                                            var quantity = parseFloat($('#quantityInput').val());
                                                            var totalPrice = mrp * quantity;

                                                            // Set the value of #totalPriceInput
                                                            $('#totalPriceInput').val(totalPrice);

                                                        },
                                                        error: function (err) {
                                                            alert(err)
                                                            alert(log)
                                                        }


                                                    })

                                                });
                                            } else {
                                                console.error('Invalid response format:', response);
                                            }
                                        } catch (error) {
                                            console.error('Error parsing response:', error);
                                        }
                                    },


                                    error: function (xhr, status, error) {
                                        console.error('Error during search:', error);
                                        // Handle the error, e.g., display an error message to the user
                                    }
                                });
                            } else {
                                // Clear the suggestions if the input is empty
                                $('#itemSuggestions').text('');
                            }
                        });
                    });
                </script>


            </div>



            <script>

                var currentSlNo = 2;
                var currentRowId = 1;

                function addrow() {
                    // Create a new row with full-width input boxes
                    var newRow = $('<div>', { class: 'row bol1' }).append(
                        $('<div>', { class: 'col-md-1 whi1' }).html('<p style="width: 100%; background-color: #c2c0c0; text-align: left; padding-left: 2px; font-weight: bold; padding-top: 7px;">' + currentSlNo + '</p>'),
                        $('<div>', { class: 'col-md-6 whi1' }).html('<input type="text" class="form-control itemInput1" id="itemInput' + currentRowId + '" style="width: 100%; background-color: #c2c0c0;">'),
                        $('<div>', { class: 'col-md-1 whi1' }).html('<input type="text" class="form-control" id="qyt' + currentRowId + '" style="width: 100%; background-color: #c2c0c0;">'),
                        $('<div>', { class: 'col-md-1 whi1' }).html('<input type="text" class="form-control" id="mrp' + currentRowId + '" style="width: 100%; background-color: #c2c0c0;">'),
                        $('<div>', { class: 'col-md-1 whi1' }).html('<input type="text" class="form-control" id="free' + currentRowId + '" style="width: 100%; background-color: #c2c0c0;">'),
                        $('<div>', { class: 'col-md-1 whi1' }).html('<input type="text" class="form-control" id="gst' + currentRowId + '"  style="width: 100%; background-color: #c2c0c0;">'),
                        $('<div>', { class: 'col-md-1 whi1' }).html('<input type="text" class="form-control" id="total' + currentRowId + '"  style="width: 100%; background-color: #c2c0c0;">')
                    ).append('<div id="itemSuggestions' + currentRowId + '" class="itemSuggestions1 suggestion"></div>');

                    // Increment the current Sl.no and row ID
                    currentSlNo++;
                    currentRowId++;

                    // Append the new row after the existing rows
                    $('.bol1:last').after(newRow);

                    // Move the button and bol22 row down
                    $('.bol22').appendTo('.body2');

                    newRow.find('.itemInput1, #qyt' + currentRowId + ', #mrp' + currentRowId).on('input', function () {
                        handleItemInput1($(this));
                        updateTotalPrice($(this));
                    });

                }



            </script>




            <!-- -------------------Total----------------- -->
            <div class="row bol22" style="margin-bottom: 20px;">
                <div class="col-md-1 whi">
                    <p style="padding: 10px;">Total</p>
                </div>
                <div class="col-md-6 whi">

                </div>
                <div class="col-md-1 whi">
                    <p></p>
                </div>
                <div class="col-md-1 whi">
                    <p></p>
                </div>
                <div class="col-md-1 whi">
                    <p></p>
                </div>
                <div class="col-md-1 whi">
                    <p></p>
                </div>
                <div class="col-md-1 whi">
                    <p></p>
                </div>
            </div>

            <div class="col-md-12 bol22 ">
                <div class="row">
                    <button type="submit"
                        style="margin-left:0px; background-color:rgb(79, 79, 238, 0.4); border-radius:8px; margin-top:7px; width:120px; height:40px;"
                        onclick="addrow()" id="addrow">Add Row</button>
                </div>

                <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <span>Total</span>
                        <span style="margin-left:38px;">
                            <input type="text" id="total" class="name1" oninput="updateBalance()">
                        </span>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-9"></div>
                    <div class="col-md-1">
                        <input type="checkbox" id="checkbox1" onclick="updateReceived()"
                            style="margin-left:90%; margin-top:10px; width: 20px; height: 20px;">
                    </div>
                    <div class="col-md-2">
                        <span>Received</span>
                        <span style="margin-left:10px;">
                            <input type="text" id="received" class="name1" oninput="updateBalance()">
                        </span>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <span>Balance</span>
                        <span id="balance" class="text-right"
                            style="margin-left: 20px; background-color: transparent; font-weight: bold; ">
                            0
                        </span>
                    </div>
                </div>

                <script>
                    function updateReceived() {
                        var total = parseFloat(document.getElementById('total').value) || 0;

                        if (document.getElementById('checkbox1').checked) {
                            document.getElementById('received').value = total;
                        } else {
                            document.getElementById('received').value = '';
                        }

                        updateBalance();
                    }

                    function updateBalance() {
                        var total = parseFloat(document.getElementById('total').value) || 0;
                        var received = parseFloat(document.getElementById('received').value) || 0;
                        var balance = total - received;
                        document.getElementById('balance').innerText = balance.toFixed(2);
                    }
                </script>

                <div class="row" style="margin-top: 20px; margin-right:50px ">
                    <div class="col-md-11"></div>
                    <div class="col-md-1">
                        <button type="submit" class="buttons" onclick="savee()">Save</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>

        $('.quantity-input').on('input', function () {
            updateTotalPrice($(this));
        });

        $('.price-input').on('input', function () {
            updateTotalPrice($(this));
        });

        function updateTotalPrice(input) {
            var row = input.closest('.bol1');

            var quantity = parseFloat(row.find('.quantity-input').val()) || 0;
            var price = parseFloat(row.find('.price-input').val()) || 0;

            var totalPrice = quantity * price;

            row.find('.total-price-input').val(totalPrice.toFixed(2));
        }
    </script>

    <script>
        $(document).ready(function () {
            // Event listener for dynamically added rows
            $('.body2').on('input', '.itemInput1', function () {
                handleItemInput1($(this));
            });

            // Event listener for static row
            $('#itemInput1').on('input', function () {
                handleItemInput1($(this));
            });

            // Function to handle item input
            function handleItemInput1(input) {
                var searchTerm = input.val();
                var suggestionsContainer = input.next('.itemSuggestions1');

                if (searchTerm.trim() !== '') {
                    $.ajax({
                        url: './ajax/searchitemspur.php',
                        method: 'POST',
                        data: {
                            searchTerm: searchTerm
                        },
                        success: function (res) {
                            console.log("3 days click");
                            console.log(res);
                            try {
                                var items = JSON.parse(res).items;

                                if (Array.isArray(items)) {
                                    var suggestionsString1 = items.map(function (item) {
                                        return '<div class="suggestion1" style="background-color: #e0e0e0; border: 1px solid black; padding: 5px; cursor: pointer; width: 51%; margin-left:112px;">' + item + '</div>';
                                    }).join('');

                                    // Update the corresponding itemSuggestions div
                                    $('#itemSuggestions1').html(suggestionsString1);

                                    // Add a click event listener to each suggestion
                                    $('.suggestion1').click(function () {
                                        var name = $(this).text();
                                        input.val(name);

                                        $('#itemSuggestions1').html('');

                                        let mrp = $("#mrp1").val();
                                        let gst = $("#gst1").val();
                                        $.ajax({
                                            url: './ajax/bringprice.php',
                                            method: "POST",
                                            data: {
                                                searchTerm: searchTerm,
                                                mrp: mrp,
                                                gst: gst,
                                            },
                                            success: function (res) {

                                                var result = JSON.parse(res);

                                                // Set the values to the corresponding input boxes
                                                $('#mrp1').val(result.mrp);
                                                var gstValue = parseFloat(result.gst);

                                                // Add a percentage sign to the value
                                                var gstWithPercentage = gstValue + '%';

                                                // Set the value of #gst
                                                $('#gst1').val(gstWithPercentage); $('#qyt1').val(1);

                                                var mrp = parseFloat($('#mrp1').val());
                                                var quantity = parseFloat($('#qyt1').val());
                                                var totalPrice = mrp * quantity;

                                                // Set the value of #totalPriceInput
                                                $('#total1').val(totalPrice);

                                            },
                                            error: function (err) {
                                                alert(err)
                                                alert(log)
                                            }
                                        })


                                    });
                                } else {
                                    console.error('Invalid response format:', response);
                                }
                            } catch (error) {
                                console.error('Error parsing response:', error);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error during search:', error);
                        }
                    });
                } else {
                    suggestionsContainer.text('');
                }
            }

            // Add a change event listener to each quantity-input field for dynamically added rows
            $('.body2').on('input', '#qyt1', function () {
                updateTotalPrice($(this));
            });

            // Add a change event listener to each price-input field for dynamically added rows
            $('.body2').on('input', '#mrp1', function () {
                updateTotalPrice($(this));
            });

            // Function to update the total price based on quantity and price for dynamically added rows
            function updateTotalPrice(input) {
                // Get the parent row of the input field
                var row = input.closest('.bol1');

                // Get the quantity and price values from the current row
                var quantity = parseFloat(row.find('#qyt1').val()) || 0;
                var price = parseFloat(row.find('#mrp1').val()) || 0;

                // Calculate the total price
                var totalPrice = quantity * price;

                // Update the total price input field in the current row
                row.find('#total1').val(totalPrice.toFixed(2));
            }
        });

    </script>

</body>

<?php
include 'footer.php';
?>

</html>