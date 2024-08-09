<?php
session_start();
$uid = $_SESSION['uid'];
include 'link.php';


if (!$uid) {
    header("Location: index.php");
    exit();
}
?>
<html>

<script>
    $(document).ready(function () {
        // $('#home').click(function () {
        //     $('#myhome').show();
        //     $('#yourvendr').hide();
        //     $('#youritems').hide();
        //     $('#yourcoustomers').hide();
        //     $('#yourinvoice').hide();
        //     $('#invoicelist').hide();
        //     $('#home').addClass('active');
        //     $('#vendor').addClass('active');
        //     $('#costomer').removeClass('active');
        //     $('#invoices').removeClass('active');
        //     $('#invoicelists').removeClass('active');

        // });

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

        $('#costomer').click(function () {
            $('#myhome').hide();
            $('#yourvendr').hide();
            $('#youritems').hide();
            $('#yourinvoice').hide();
            $('#invoicelist').hide();
            $('#yourcoustomers').show();
            $('#vendor').addClass('active');
            $('#invoices').removeClass('active');
            $('#home').removeClass('active');
            $('#invoicelists').removeClass('active');
            $('#costomer').removeClass('active');
        });

        $('#invoices').click(function () {
            $('#myhome').hide();
            $('#yourvendr').hide();
            $('#youritems').hide();
            $('#yourcoustomers').hide();
            $('#invoicelist').hide();
            $('#yourinvoice').show();
            $('#vendor').addClass('active');
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
            $('#vendor').addClass('active');
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
                <i class="fa-solid fa-trowel-bricks"></i> <a href="#" style="margin-left: 5px;">Vendor</a>
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
            body {
                font-family: 'Arial', sans-serif;
                margin: 0;
                padding: 0;
            }

            .invoice-list {
                max-width: 800px;
                margin: 50px auto;
            }

            h1 {
                color: #333;
            }

            .invoice-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th,
            td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

            tr:hover {
                background-color: #f5f5f5;
            }
        </style>


        <?php
        include('connect.php');

        if (isset($_GET["id"])) {
            $invoiceId = $_GET["id"];

            // Select Invoice Details From Database
            $sqlInvoice = "SELECT * FROM invoice WHERE SID=? AND uid=?";
            $stmtInvoice = $con->prepare($sqlInvoice);
            $stmtInvoice->bind_param("ss", $invoiceId, $uid);
            $stmtInvoice->execute();
            $resultInvoice = $stmtInvoice->get_result();

            // Select Invoice Products Details From Database
            $sqlProducts = "SELECT * FROM invoice_products WHERE SID=? ";
            $stmtProducts = $con->prepare($sqlProducts);
            $stmtProducts->bind_param("s", $invoiceId);
            $stmtProducts->execute();
            $resultProducts = $stmtProducts->get_result();

            if ($resultInvoice && $resultProducts) {
                if ($resultInvoice->num_rows > 0) {
                    $rowInvoice = $resultInvoice->fetch_assoc();

                    // Print Invoice Details
                    echo '<div style="margin: 20px; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">';
                    echo "<h2>Invoice Details</h2>";
                    echo "<p>Invoice Number: " . $rowInvoice["INVOICE_NO"] . "</p>";
                    echo "<p>Invoice Date: " . date("d-m-Y", strtotime($rowInvoice["INVOICE_DATE"])) . "</p>";
                    echo "<p>Customer Name: " . $rowInvoice["CNAME"] . "</p>";
                    echo "<p>Customer Address: " . $rowInvoice["CADDRESS"] . "</p>";
                    echo "<p>Customer City: " . $rowInvoice["CCITY"] . "</p>";
                    echo "<p>Grand Total: " . $rowInvoice["GRAND_TOTAL"] . "</p>";

                    // Print Invoice Products Details
                    echo "<h2>Invoice Products</h2>";
                    if ($resultProducts->num_rows > 0) {
                        echo '<table style="width: 100%; border-collapse: collapse; margin-top: 10px;">';
                        echo '<tr>';
                        echo '<th style="border: 1px solid #ddd; padding: 8px;">Product</th>';
                        echo '<th style="border: 1px solid #ddd; padding: 8px;">Quantity</th>';
                        echo '<th style="border: 1px solid #ddd; padding: 8px;">Cost</th>';
                        echo '<th style="border: 1px solid #ddd; padding: 8px;">GST</th>';
                        echo '<th style="border: 1px solid #ddd; padding: 8px;">Total Cost</th>';
                        echo '</tr>';

                        while ($rowProducts = $resultProducts->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . $rowProducts["PNAME"] . '</td>';
                            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . $rowProducts["QTY"] . '</td>';
                            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . $rowProducts["PRICE"] . '</td>';
                            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . $rowProducts["GST"] . '</td>';
                            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . $rowProducts["TOTAL"] . '</td>';
                            echo '</tr>';
                        }

                        echo '</table>';
                    } else {
                        echo "<p>No products found for this invoice.</p>";
                    }

                    echo '</div>';
                } else {
                    echo "Error: Invoice not found.";
                }
            } else {
                echo "Error: " . $con->error;
            }

            // Close the database connection
            $con->close();
        } else {
            echo "Error: Invoice ID not provided.";
        }
        ?>
    </div>

</html>