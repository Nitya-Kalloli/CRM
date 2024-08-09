<?php
session_start();
$uid = $_SESSION['uid'];

if (!$uid) {
    header("Location: index.php");
    exit();
}

include 'link.php';
include('connect.php');
$current_page = basename($_SERVER['PHP_SELF']);
?>

<script>
    $(document).ready(function () {
        $('#home').click(function () {
            $('#myhome').show();
            $('#yourvendr').hide();
            $('#youritems').hide();
            $('#yourcoustomers').hide();
            $('#yourinvoice').hide();
            $('#invoicelist').hide();
            $('#home').addClass('active');
            $('#vendor').removeClass('active');
            $('#costomer').removeClass('active');
            $('#invoices').removeClass('active');
            $('#invoicelists').removeClass('active');

        });

        $('#vendor').click(function () {
            $('#myhome').hide();
            $('#yourvendr').show();
            $('#youritems').hide();
            $('#yourcoustomers').hide();
            $('#yourinvoice').hide();
            $('#invoicelist').hide();
            $('#vendor').addClass('active');
            $('#home').removeClass('active');
            $('#costomer').removeClass('active');
            $('#invoices').removeClass('active');
            $('#invoicelists').removeClass('active');
        });

    

        $('#invoices').click(function () {
            $('#myhome').hide();
            $('#yourvendr').hide();
            $('#youritems').hide();
            $('#yourcoustomers').hide();
            $('#invoicelist').hide();
            $('#yourinvoice').show();
            $('#vendor').removeClass('active');
            $('#home').removeClass('active');
            $('#invoices').addClass('active');
            $('#costomer').removeClass('active');
            $('#invoicelists').removeClass('active');
        });

        $('#invoicelists').click(function () {
            $('#myhome').hide();
            $('#yourvendr').hide();
            $('#youritems').hide();
            $('#yourcoustomers').hide();
            $('#invoicelist').show();
            $('#yourinvoice').hide();
            $('#vendor').removeClass('active');
            $('#home').removeClass('active');
            $('#invoicelists').addClass('active');
            $('#costomer').removeClass('active');
            $('#invoices').removeClass('active');
        });

        $('#item').click(function () {
            $('#myhome').hide();
            $('#yourvendr').hide();
            $('#invoicelist').show();
            $('#yourcoustomers').hide();
        });

    });
</script>
<style>
    .items li.active {
        background-color: #9298a8
    }
</style>
<div class="body1">
    <section id="menu">
        <div class="logo">
            <h2 style="padding:15px;">Dashboard</h2>
        </div>

        <style>
            #invoiceListContainer {
                display: none;
                background-color: rgba(106, 109, 116, 0.7);
            }
        </style>
        <div class="items">
            <li id="home" class="<?php echo ($current_page == 'home.php') ? 'active' : ''; ?>">
                <i class="fa-solid fa-house-user"></i> <a href="home.php" style="margin-left: 5px;">Home</a>
            </li>
            <li id="vendor" class="<?php echo ($current_page == 'vendor.php') ? 'active' : ''; ?>">
                <i class="fa-solid fa-trowel-bricks"></i> <a href="vender.php" style="margin-left: 5px;">Vendor</a>
            </li>
            <li id="costomer"><i class="fa-solid fa-users"></i> <a href="#">Customers </a> </li>

            <li id="invoices"><i class="fa-solid fa-file-invoice"></i> <a href="#" id="invoiceLink"
                    style="margin-left: 5px;">Invoice</a> </li>

            <div id="invoiceListContainer">
                <li id="invoicelists"><i class="fa-solid fa-file-invoice"></i> <a href="#"
                        style="margin-left: 5px;">Invoice List</a> </li>
            </div>
            <script>
                $(document).ready(function () {
                    $("#invoiceLink").click(function (e) {
                        e.preventDefault();
                        loadInvoiceList();
                    });

                    function loadInvoiceList() {
                        $("#invoiceListContainer").toggle();
                    }
                });
            </script>

            <li id="quotaiton"><i class="fa-brands fa-quora"></i> <a href="quotation.php"
                    style="margin-left: 5px;">Quotation</a> </li>
            <li id="logout"><i class="fa-solid fa-right-from-bracket"></i> <a href="logout.php"
                    style="margin-left: 5px;">Logout</a>
            </li>
        </div>

    </section>

    <div class="container mt-4">



        <style>
            .company-info {
                background-color: #f5f5f5;
                border: 1px solid #ddd;
                padding: 20px;
                border-radius: 10px;
                margin-bottom: 20px;
            }

            .company-info h4 {
                color: #333;
                border-bottom: 2px solid #ddd;
                padding-bottom: 10px;
                margin-bottom: 15px;
            }

            .company-info p {
                margin-bottom: 10px;
            }

            .company-info strong {
                font-weight: bold;
                margin-right: 10px;
            }
        </style>

        <body>
            <div class="container mt-5">
                <style>
                    .doo a {
                        text-decoration: none;
                    }
                </style>

                <div class="col-md-12 doo" id="yourcoustomers" >

                    <div class="row ">
                        <div class="col-md-5">
                            <h3 style="margin-left: 10px; margin-top: 20px;">Your Customers</h3>
                        </div>
                        <div class="col-md-4">
                            <div class="search d-flex">
                                <input id="searchInput1" type="text" placeholder="Search coustomer">
                                <button onclick="searchcoustomer()" class="btn-primary">Search</button>
                            </div>
                            <script>

                                function searchcoustomer() {
                                    var input, filter, rows, cells, textContent, i, j, found;
                                    input = document.getElementById("searchInput1");
                                    filter = input.value.toUpperCase();
                                    rows = document.getElementsByClassName("shadows1");

                                    for (i = 0; i < rows.length; i++) {
                                        cells = rows[i].getElementsByClassName("info-box1")[0].getElementsByTagName("p");

                                        found = false;

                                        for (j = 0; j < cells.length; j++) {
                                            textContent = cells[j].innerText || cells[j].textContent;

                                            if (textContent.toUpperCase().indexOf(filter) > -1) {
                                                found = true;
                                                break;
                                            }
                                        }
                                        var companyName = rows[i].getElementsByClassName("info-box1")[1].getElementsByTagName("p")[0].innerText || rows[i].getElementsByClassName("info-box")[1].getElementsByTagName("p")[0].textContent;
                                        if (companyName.toUpperCase().indexOf(filter) > -1) {
                                            found = true;
                                        }

                                        rows[i].style.display = found ? "" : "none";
                                    }

                                }
                            </script>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2 text-right">
                            <button type="submit" class="buttonss" onclick="addcoustomer()">Add Coustomer</button>
                        </div>
                    </div>


                    <?php
                    $sqlpid = "SELECT * FROM customer WHERE uid = '$uid' ORDER BY cuname";
                    $result1 = $con->query($sqlpid);

                    if ($result1) {
                        while ($row1 = $result1->fetch_assoc()) {
                            $name = $row1['cuname'];
                            $number = $row1['phno'];
                            $shippingadd = $row1['shippingadd'];
                            $city = $row1['city'];
                            $email = $row1['email'];
                            $state = $row1['state'];
                            ?>

                            <a href="./coustomerdetails.php?id=<?php echo $row1['id']; ?>">

                                <div class="row shadows1" style="margin:10px; margin-bottom:20px;">
                                    <div class="col-md-4 info-box1" style="color: black;">
                                        <p style="text-decoration: none;"><strong>Name:</strong>
                                            <?php echo $name; ?>
                                        </p>
                                        <p style="text-decoration: none;"><span><i class="fa-solid fa-phone mar"
                                                    style="margin-right: 10px;"></i></span>
                                            <?php echo $number; ?>
                                        </p>

                                    </div>

                                    <div class="col-md-4 info-box1" style="color: black;">
                                        <p id="companyName"><strong>State:</strong>
                                            <?php echo $state; ?>
                                        </p>
                                        <p><span><i class="fa-solid fa-envelope-circle-check mar"
                                                    style="margin-right: 10px;"></i></span>
                                            <?php echo $email; ?>
                                        </p>

                                    </div>

                                    <div class="col-md-4 info-box1" style="color: black;">
                                        <p><strong>City:</strong>
                                            <?php echo $city; ?>
                                        </p>
                                        <p><strong>Payment:</strong>
                                            <!-- <?php echo $shippingadd; ?> -->
                                        </p>
                                    </div>
                                </div>
                            </a>

                            <?php
                        }
                    } else {
                        echo "Error executing query: " . $con->error;
                    }
                    ?>

                    <script>
                        function addcoustomer() {
                            window.location.href = "coustomer.php";
                        }
                    </script>

                </div>

        </body>

        </html>