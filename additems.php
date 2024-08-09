<?php
session_start();
$uid = $_SESSION['uid'];

if (!$uid) {
    header("Location: index.php");
    exit();
}
include 'link.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM</title>
</head>

<body>

    <div class="body3">

        <div class="container mt-4">
            <div class="up" style="margin-bottom: 30px;">
                <h1>Add Items</h1>
                <div class="row">
                    <div class="col-md-4">
                        <label for="name">Item name:</label>
                        <input type="text" id="name" class="name">
                    </div>
                    <div class="col-md-4">
                        <label for="name">Item HSN</label>
                        <input type="text" id="number" class="name">
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="name">Category</label>
                        <input type="text" id="category" class="name">
                    </div>
                    <div class="col-md-4">
                        <label for="name">Item Code:</label>
                        <input type="text" id="code" class="name">
                    </div>
                </div>
            </div>

            <h5>Pricing</h5>
            <hr>

            <h6>MRP</h6>

            <div class="row">
                <div class="col-md-4">
                    <label for="name">MRP</label>
                    <input type="text" id="mrp" class="name">
                </div>
                <div class="col-md-4">
                    <label for="name">Discount For Sales In %</label>
                    <input type="text" id="discount" class="name">
                </div>
            </div>

            <h6>Sale Price</h6>

            <div class="row">
                <div class="col-md-4">
                    <label for="name">Selling price</label>
                    <input type="text" id="sellingPrice" class="name">
                </div>

                <script>
                    $(document).ready(function () {
                        // Add event listeners to MRP and Discount input fields
                        $("#mrp, #discount").on("input", function () {
                            // Get values
                            var mrp = parseFloat($("#mrp").val()) || 0;
                            var discount = parseFloat($("#discount").val()) || 0;

                            // Calculate selling price
                            var sellingPrice = mrp - (mrp * discount / 100);

                            // Update the Selling Price input field
                            $("#sellingPrice").val(sellingPrice.toFixed(2));
                        });
                    });
                </script>

            </div>

            <hr>

            <h6>Purchase Price</h6>

            <div class="row">
                <div class="col-md-4">
                    <label for="purchasePrice">Purchase Price:</label>
                    <input type="text" id="purchasePrice" class="name">
                </div>
                <div class="col-md-4">
                    <label for="type">Select a Type:</label>
                    <select id="type" class="name">
                        <option value="withoutTax">Without tax</option>
                        <option value="withTax">With tax</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="tax">Select your state:</label>
                    <select id="tax" class="name">
                        <option value="0">none</option>
                        <option value="18">18%</option>
                        <option value="5">5%</option>
                        <option value="28">28%</option>
                    </select>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

            <script>
                $(document).ready(function () {
                    // Initialize original purchase price
                    var originalPurchasePrice = 0;

                    // Add event listener to purchase price field on blur
                    $("#purchasePrice").on("blur", function () {
                        originalPurchasePrice = parseFloat($(this).val()) || 0;
                        updatePurchasePrice();
                    });

                    // Add event listeners to type and tax select fields
                    $("#type, #tax").on("change", function () {
                        updatePurchasePrice();
                    });

                    function updatePurchasePrice() {
                        // Get values
                        var type = $("#type").val();
                        var taxPercentage = parseFloat($("#tax").val()) || 0;

                        // Calculate purchase price based on type and tax percentage
                        var purchasePrice = originalPurchasePrice;

                        if (type === "withTax") {
                            purchasePrice += originalPurchasePrice * taxPercentage / 100;
                        }

                        // Update the Purchase Price input field
                        $("#purchasePrice").val(purchasePrice.toFixed(2));
                    }
                });
            </script>

            <div class="col-md-3 ">
                <span style="color:red;" id="error"></span>
                <br>
                <button type="submit" class="buttons" id="itemsave">Save</button>
            </div>

        </div>
    </div>



    <script>
        $(document).ready(function () {
            $("#itemsave").click(function () {
                let name = $("#name").val();
                let number = $("#number").val();
                let category = $("#category").val();
                let code = $("#code").val();
                let mrp = $("#mrp").val();
                let discount = $("#discount").val();
                let sellingPrice = $("#sellingPrice").val();
                let purchasePrice = $("#purchasePrice").val();
                let type = $("#type").val();
                let tax = $("#tax").val();

                if (name == '') {
                    $("#error").html("Please enter the name")
                } else if (mrp == '') {
                    $("#error").html("Enter mrp")
                }  else if (purchasePrice == '') {
                    $("#error").html("Enter purchase price")
                }  else {
                    $.ajax({
                        url: './ajax/additemajax.php',
                        method: "POST",
                        data: {
                            name: name,
                            number: number,
                            category: category,
                            code: code,
                            mrp: mrp,
                            discount: discount,
                            sellingPrice: sellingPrice,
                            type: type,
                            purchasePrice: purchasePrice,
                            tax: tax,
                        },
                        success: function (res) {
                            alert(res)
                            location.reload();
                        },
                        error: function (err) {

                        }

                    })

                }
            })
        })
    </script>
</body>

<?php
include 'footer.php';
?>

</html>