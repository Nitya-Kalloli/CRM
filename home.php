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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM</title>
</head>

<body>
    <!-----------------------------------------javascript code---------------------------------->

    <script>
        $(document).ready(function () {
            $('#home').click(function () {
                $('#myhome').show();
                $('#yourvendr').hide();
                $('#youritems').hide();
                $('#yourcoustomers').hide();
                $('#yourinvoice').hide();
                $('#invoicelist').hide();
                $('#yourquotation').hide();
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
                $('#yourquotation').hide();
                $('#vendor').addClass('active');
                $('#home').removeClass('active');
                $('#costomer').removeClass('active');
                $('#invoices').removeClass('active');
                $('#invoicelists').removeClass('active');
            });

            $('#costomer').click(function () {
                $('#myhome').hide();
                $('#yourvendr').hide();
                $('#youritems').hide();
                $('#yourinvoice').hide();
                $('#invoicelist').hide();
                $('#yourquotation').hide();
                $('#yourcoustomers').show();
                $('#vendor').removeClass('active');
                $('#invoices').removeClass('active');
                $('#home').removeClass('active');
                $('#invoicelists').removeClass('active');
                $('#costomer').addClass('active');
            });

            $('#invoices').click(function () {
                $('#myhome').hide();
                $('#yourvendr').hide();
                $('#youritems').hide();
                $('#yourcoustomers').hide();
                $('#invoicelist').hide();
                $('#yourquotation').hide();
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
                $('#yourquotation').hide();
                $('#vendor').removeClass('active');
                $('#home').removeClass('active');
                $('#invoicelists').addClass('active');
                $('#costomer').removeClass('active');
                $('#invoices').removeClass('active');
            });

            $('#quotation').click(function () {
                $('#myhome').hide();
                $('#yourvendr').hide();
                $('#youritems').hide();
                $('#yourcoustomers').hide();
                $('#yourquotation').show();
                $('#yourinvoice').hide();
                $('#invoicelist').hide();
                $('#vendor').removeClass('active');
                $('#home').removeClass('active');
                $('#invoicelists').addClass('active');
                $('#costomer').removeClass('active');
                $('#invoices').removeClass('active');
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

            <!-- <style>
                #invoiceListContainer {
                    display: none;
                    background-color: rgba(106, 109, 116, 0.7);
                }
            </style> -->
            <div class="items">
                <li id="home" class="<?php echo ($current_page == 'home.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-house-user"></i> <a href="#" style="margin-left: 5px;">Home</a>
                </li>
                <li id="vendor" class="<?php echo ($current_page == 'vendor.php') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-trowel-bricks"></i> <a href="#" style="margin-left: 5px;">Vendor</a>
                </li>
                <li id="costomer"><i class="fa-solid fa-users"></i> <a href="#">Customers </a> </li>

                <li id=""><i class="fa-solid fa-file-invoice"></i> <a href="invoice.php"
                        style="margin-left: 5px;">Invoice</a> </li>

                
                    <li id="invoicelists"><i class="fa-solid fa-file-invoice"></i> <a href="#"
                            style="margin-left: 5px;">Invoice List</a> </li>
                
                <!-- <script>
                    $(document).ready(function () {
                        $("#invoiceLink").click(function (e) {
                            e.preventDefault();
                            loadInvoiceList();
                        });

                        function loadInvoiceList() {
                            $("#invoiceListContainer").toggle();
                        }
                    });
                </script> -->

                <li id=""><i class="fa-brands fa-quora"></i> <a href="quotation.php"
                        style="margin-left: 5px;">Quotation</a> </li>
                <li id="logout"><i class="fa-solid fa-right-from-bracket"></i> <a href="logout.php"
                        style="margin-left: 5px;">Logout</a>
                </li>
            </div>

        </section>

        <div class="container mt-4">


            <!-- ----------------------------------home-------------------------------------- -->
            <div class="col-md-12" id="myhome">

                <h3 class="i-name">Dashboard
                </h3>

                <?php

                $sql = "SELECT COUNT(*) as totalEntries FROM customer WHERE uid = '$uid' ";
                $result = mysqli_query($con, $sql);

                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $totalEntries = $row['totalEntries'];

                    $sqlTotalBalance = "SELECT SUM(total) as totalAmount, SUM(balance) as totalBalance FROM customer WHERE uid = '$uid'";
                    $resultTotalBalance = mysqli_query($con, $sqlTotalBalance);

                    if ($resultTotalBalance) {
                        $rowTotalBalance = mysqli_fetch_assoc($resultTotalBalance);
                        $totalAmount = $rowTotalBalance['totalAmount'];
                        $totalBalance = $rowTotalBalance['totalBalance'];
                    } else {
                        $totalAmount = "Error in SQL query for total amount: " . mysqli_error($con);
                        $totalBalance = "Error in SQL query for total balance: " . mysqli_error($con);
                    }

                    ?>

                    <div class="value">
                        <div class="valbox project">
                            <label class="icons">
                                <i class="fa-solid fa-list-check"></i>
                            </label>
                            <div>
                                <h3>
                                    <?php echo $totalEntries; ?>
                                </h3>
                                <span> Total Project</span>
                            </div>
                        </div>
                        <div class="valbox investment">
                            <label class="icons">
                                <i class="fa-solid fa-money-bill"></i>
                            </label>
                            <div>
                                <h3>130</h3>
                                <span> Total investment</span>
                            </div>
                        </div>
                        <div class="valbox income">
                            <label class="icons">
                                <i class="fa-solid fa-sack-dollar"></i>
                            </label>
                            <div>
                                <h3>
                                    <?php echo $totalAmount; ?>
                                </h3>
                                <span>Total cost</span>
                            </div>
                        </div>

                        <div class="valbox overdue">
                            <label class="icons">
                                <i class="fa-brands fa-slack"></i> </label>
                            <div>
                                <h3>
                                    <?php echo $totalBalance; ?>
                                </h3>
                                <span> Overdue</span>
                            </div>
                        </div>

                        <div class="valbox expense">
                            <label class="icons">
                                <i class="fa-brands fa-slack"></i> </label>
                            <div>
                                <h3>63000</h3>
                                <span> Total Profit</span>
                            </div>
                        </div>

                    </div>
                <?php } else {
                    echo "Error in SQL query: " . mysqli_error($con);
                }
                ?>

                <div class="row">
                    <hr style="margin-top:50px">
                    <h1>Invoices</h1>
                    <?php
                    $sqlpid45 = "SELECT * FROM invoice WHERE uid = '$uid' ORDER BY SID";
                    $result145 = $con->query($sqlpid45);

                    if ($result145) {
                        while ($row145 = $result145->fetch_assoc()) {
                            $INVOICE_NO = $row145['INVOICE_NO'];
                            $INVOICE_DATE = $row145['INVOICE_DATE'];
                            $CNAME = $row145['CNAME'];
                            $GRAND_TOTAL = $row145['GRAND_TOTAL'];

                            ?>

                            <a href="./details.php?id=<?php echo $row145['SID']; ?>">

                                <div class="row shadows info-box" style="margin:5px; margin-bottom:10px;">
                                    <div class="col-md-3 info-box" style="color: black;">
                                        <p style="text-decoration: none;"><strong>Invoice number:</strong>
                                            <?php echo $INVOICE_NO; ?>
                                        </p>
                                    </div>

                                    <div class="col-md-3 info-box" style="color: black;">
                                        <p style="text-decoration: none;"><strong>Invoice date:</strong>
                                            <?php echo $INVOICE_DATE; ?>
                                        </p>
                                    </div>

                                    <div class="col-md-3 info-box" style="color: black;">
                                        <p><strong>Name:</strong>
                                            <?php echo $CNAME; ?>
                                        </p>
                                    </div>

                                    <div class="col-md-3 info-box" style="color: black;">
                                        <p id="companyName"><strong>total:</strong>
                                            <?php echo $GRAND_TOTAL; ?>
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



                </div>

                <div class="row">
                    <hr style="margin-top:50px">
                    <h1>Quotation</h1>
                    <?php
                    $sqlpid451 = "SELECT * FROM quotations WHERE uid = '$uid' ORDER BY SID";
                    $result1451 = $con->query($sqlpid451);

                    if ($result1451) {
                        while ($row1451 = $result1451->fetch_assoc()) {
                            $quotation_no = $row1451['quotation_no'];
                            $quotation_date = $row1451['quotation_date'];
                            $customer_name = $row1451['customer_name'];
                            $grand_total = $row1451['grand_total'];

                            ?>

                            <a href="./details.php?id=<?php echo $row1451['SID']; ?>">

                                <div class="row shadows info-box" style="margin:5px; margin-bottom:10px;">
                                    <div class="col-md-3 info-box" style="color: black;">
                                        <p style="text-decoration: none;"><strong>Invoice number:</strong>
                                            <?php echo $quotation_no; ?>
                                        </p>
                                    </div>

                                    <div class="col-md-3 info-box" style="color: black;">
                                        <p style="text-decoration: none;"><strong>Invoice date:</strong>
                                            <?php echo $quotation_date; ?>
                                        </p>
                                    </div>

                                    <div class="col-md-3 info-box" style="color: black;">
                                        <p><strong>Name:</strong>
                                            <?php echo $customer_name; ?>
                                        </p>
                                    </div>

                                    <div class="col-md-3 info-box" style="color: black;">
                                        <p id="companyName"><strong>total:</strong>
                                            <?php echo $grand_total; ?>
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



                </div>



            </div>

            <!-- ---------------------------vendor--------------------------- -->

            <style>
                .do a {
                    text-decoration: none;
                }
            </style>

            <div class="col-md-12 do" id="yourvendr" style="display:none;">

                <div class="row ">
                    <div class="col-md-5">
                        <h3 style="margin-left: 10px; margin-top: 20px;">Your Vendors</h3>
                    </div>
                    <div class="col-md-4">
                        <div class="search d-flex">
                            <input id="searchInput" type="text" placeholder="Search product">
                            <button onclick="searchVendors()" class="btn-primary">Search</button>
                        </div>
                        <script>

                            function searchVendors() {
                                var input, filter, rows, cells, textContent, i, j, found;
                                input = document.getElementById("searchInput");
                                filter = input.value.toUpperCase();
                                rows = document.getElementsByClassName("shadows");

                                for (i = 0; i < rows.length; i++) {
                                    cells = rows[i].getElementsByClassName("info-box")[0].getElementsByTagName("p");

                                    found = false;

                                    for (j = 0; j < cells.length; j++) {
                                        textContent = cells[j].innerText || cells[j].textContent;

                                        if (textContent.toUpperCase().indexOf(filter) > -1) {
                                            found = true;
                                            break;
                                        }
                                    }
                                    var companyName = rows[i].getElementsByClassName("info-box")[1].getElementsByTagName("p")[0].innerText || rows[i].getElementsByClassName("info-box")[1].getElementsByTagName("p")[0].textContent;
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
                        <button type="submit" class="buttons" onclick="addVendor()">Add Vendor</button>
                    </div>
                </div>


                <?php
                $sqlpid = "SELECT * FROM vender WHERE uid = '$uid' ORDER BY name";
                $result1 = $con->query($sqlpid);

                if ($result1) {
                    while ($row1 = $result1->fetch_assoc()) {
                        $name = $row1['name'];
                        $number = $row1['number'];
                        $companyName = $row1['companyName'];
                        $type = $row1['type'];
                        $email = $row1['email'];
                        $state = $row1['state'];
                        ?>

                        <a href="./details.php?id=<?php echo $row1['id']; ?>">

                            <div class="row shadows" style="margin:10px; margin-bottom:20px;">
                                <div class="col-md-4 info-box" style="color: black;">
                                    <p style="text-decoration: none;"><strong>Name:</strong>
                                        <?php echo $name; ?>
                                    </p>
                                    <p style="text-decoration: none;"><span><i class="fa-solid fa-phone mar"
                                                style="margin-right: 10px;"></i></span>
                                        <?php echo $number; ?>
                                    </p>
                                    <p><span><i class="fa-solid fa-envelope-circle-check mar"
                                                style="margin-right: 10px;"></i></span>
                                        <?php echo $email; ?>
                                    </p>
                                </div>

                                <div class="col-md-4 info-box" style="color: black;">
                                    <p id="companyName"><strong>Company:</strong>
                                        <?php echo $companyName; ?>
                                    </p>
                                    <p><strong>State:</strong>
                                        <?php echo $state; ?>
                                    </p>
                                    <p><strong>Type:</strong>
                                        <?php echo $type; ?>
                                    </p>
                                </div>

                                <div class="col-md-4 info-box" style="color: black;">
                                    <p><strong>Payment:</strong> Overdue</p>
                                    <p><strong>Stocks:</strong> 50</p>
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
                    function addVendor() {
                        window.location.href = "addvender.php";
                    }
                </script>

            </div>

            <!-- -----------------------------Coustomers---------------------------- -->


            <style>
                .doo a {
                    text-decoration: none;
                }
            </style>

            <div class="col-md-12 doo" id="yourcoustomers" style="display:none;">

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

            <!-- ----------------------invoice ------------------------------ -->

           
            <!-- ---------------------------------invoice list------------------ -->

            <style>
                .doi {
                    background-color: #f4f4f4;
                    margin: 0;
                    box-sizing: border-box;
                    margin-left: 60px;
                }

                table {
                    width: 90%;
                    margin: 30px 0;
                    background-color: #fff;
                    border-radius: 8px;
                    overflow: hidden;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    border-collapse: collapse;
                    overflow-x: auto;
                }

                th,
                td {
                    border: 1px solid #ddd;
                    padding: 15px;
                    text-align: left;
                }

                th {
                    background-color: #007BFF;
                    color: #fff;
                }

                tbody tr:hover {
                    background-color: #f2f2f2;
                }

                a {
                    text-decoration: none;

                }

                .view-button {
                    display: inline-block;
                    background-color: #28a745;
                    color: #fff;
                    padding: 10px 15px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }

                .view-button:hover {
                    background-color: #218838;
                }
            </style>
            <div class="col-md-12 doi" id="invoicelist" style="display:none;">
                <h1>Invoice List</h1>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Invoice Number</th>
                            <th>Customer Name</th>
                            <th>Total Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('connect.php');

                        $query = "SELECT * FROM invoice WHERE uid ='$uid'";
                        $result = $con->query($query);

                        if (!$result) {
                            die("Error: " . $con->error);
                        }

                        while ($row = $result->fetch_assoc()):
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['SID']; ?>
                                </td>
                                <td>
                                    <?php echo $row['INVOICE_NO']; ?>
                                </td>
                                <td>
                                    <?php echo $row['CNAME']; ?>
                                </td>
                                <td>
                                    <?php echo $row['GRAND_TOTAL']; ?>
                                </td>
                                <td>
                                    <a href="view_invoice.php?id=<?php echo $row['SID']; ?>" class="view-button">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

            </div>

            <!-- -------------------------- Quotation------------------------- -->
           
        </div>
    </div>
</body>
<?php
include 'footer.php';
?>

</html>