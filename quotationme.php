<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation</title>

    <?php include 'link.php'; ?>

    <link rel="stylesheet" href="./css/style.css">

    <style>
        /* Add this CSS rule to style the "Save Invoice" button */
        .invoice-body button[type="submit"] {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Optionally, you can add a hover effect */
        .invoice-body button[type="submit"]:hover {
            background-color: darkblue;
        }
    </style>
</head>

<body>
    <div class="iinvoice">

        <div class="invoice">
            <div class="invoice-header">
                <h1>Quotation</h1>
            </div>

            <div class="invoice-body">
                <?php
                include 'connect.php';

                // Fetch registration information from the registration table
                $registrationSql = "SELECT * FROM registration";
                $registrationResult = $con->query($registrationSql);

                if ($registrationResult->num_rows > 0) {
                    $registrationRow = $registrationResult->fetch_assoc();

                    echo '<p><strong class="company-name"></strong> ' . $registrationRow['cname'] . '</p>';
                    echo '<p><strong></strong> <a href="' . $registrationRow['web'] . '" target="_blank">' . $registrationRow['web'] . '</a></p>';
                    echo '<p><strong>To:</strong> ' . $registrationRow['name'] . '</p>';
                    echo '<p><strong>Mobile Number:</strong> ' . $registrationRow['mobile'] . '</p>';
                    echo '<p><strong>Address:</strong> ' . $registrationRow['address'] . '</p>';
                } else {
                    echo '<p>No data found in the registration table.</p>';
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $subtotal = 0;

                    foreach ($_POST['product'] as $key => $product) {
                        $quantity = $_POST['quantity'][$key];
                        $price = $_POST['price'][$key];
                        $total = $quantity * $price;

                        $subtotal += $total;

                        // Insert product-related information into the invoice table
                        $sql = "INSERT INTO invoice (product, quantity, price, total) VALUES ('$product', '$quantity', '$price', '$total')";
                        if ($con->query($sql) === false) {
                            die("Error inserting product data: " . $con->error);
                        }
                    }

                    // Calculate grand total and update it in the last inserted invoice record
                    $tax = 0.05 * $subtotal;
                    $grandTotal = $subtotal + $tax;

                    $lastInvoiceId = $con->insert_id; // Get the ID of the last inserted invoice record

                    $sqlUpdateInvoice = "UPDATE invoice SET grandtotal = '$grandTotal' WHERE id = '$lastInvoiceId'";
                    if ($con->query($sqlUpdateInvoice) === false) {
                        die("Error updating invoice data: " . $con->error);
                    }

                    // Output a success message
                    echo '<p>Invoice saved successfully!</p>';
                }
                ?>

            </div>

            <!-- Dynamic product information with input boxes -->
            <form method="post" action="" onsubmit="saveInvoice(event)">
                <table class="invoice-table" id="productTable">
                    <thead>
                        <tr>
                            <th>Item Description</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="product[]" /></td>
                            <td><input type="text" class="quantity" name="quantity[]" oninput="calculateTotal(this)" /></td>
                            <td><input type="text" class="price" name="price[]" oninput="calculateTotal(this)" /></td>
                            <td><span class="total">0.00</span></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Add Product Button -->
                <button type="button" id="addProductBtn" onclick="addProduct()">Add Product</button>

                <div class="invoice-total">
                    <p><strong>Subtotal:</strong> <span id="subtotal">0.00</span></p>
                    <p><strong>Tax (5%):</strong> <span id="tax">0.00</span></p>
                    <p><strong>Grand Total:</strong> <span id="grandTotal">0.00</span></p>
                </div>

                <!-- Bank Details -->
                <div class="bank-details">
                    <h3>Bank Details</h3>
                    <p><strong>Bank Name:</strong> <?php echo $registrationRow['bankname']; ?></p>
                    <p><strong>Account Number:</strong> <?php echo $registrationRow['accno']; ?></p>
                    <p><strong>IFSC Code:</strong> <?php echo $registrationRow['ifscno']; ?></p>
                </div>

                <!-- Save Invoice Button -->
                <button type="submit">Save Quotation</button>
            </form>

            <script>
                // Your JavaScript code here
            </script>
        </div>
    </div>
</body>

<?php
include 'footer.php';
?>

</html>