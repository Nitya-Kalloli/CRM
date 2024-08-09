<?php
session_start();
$uid = $_SESSION['uid'];

if (!$uid) {
    header("Location: index.php");
    exit();
}

include 'link.php';
include('connect.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration Page</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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
</head>

<body>
    <div class="container mt-5">

        <?php
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        $sqlProduct = "SELECT * FROM customer WHERE id = $id";
        $resultProduct = mysqli_query($con, $sqlProduct);

        if (!$resultProduct) {
            die("Error in SQL query: " . mysqli_error($con));
        }

        while ($row = mysqli_fetch_assoc($resultProduct)) {
            ?>

            <div class="row">
                <div class="col-md-6 company-info" style="margin-top:0px;">
                    <h4>Customer Information</h4>
                    <p><strong>Company Name:</strong>&nbsp;
                        <?php echo $row['cuname']; ?>
                    </p>
                    <p><strong>Phone Number:</strong>&nbsp;
                        <?php echo $row['phno']; ?>
                    </p>
                    <p><strong>Email:</strong>&nbsp;
                        <?php echo $row['email']; ?>
                    </p>
                    <p><strong>Aadhaar Number:</strong>&nbsp;
                        <?php echo $row['aadharno']; ?>
                    </p>
                    <p><strong>State:</strong>&nbsp;
                        <?php echo $row['state']; ?>
                    </p>
                    <p><strong>City:</strong>&nbsp;
                        <?php echo $row['city']; ?>
                    </p>
                    <p><strong>Shipping Address:</strong>&nbsp;
                        <?php echo $row['shippingadd']; ?>
                    </p>
                    <p><strong>Email:</strong>&nbsp;
                        <?php echo $row['email']; ?>
                    </p>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4 company-info" style="margin-top:0px;">
                    <h4>Payment</h4>

                    <div class="row">
                        <div class="col-md-10">
                            <span style="margin-left:10px">Total</span>
                            <span style="margin-left:63px;">
                                <input type="text" id="total" class="name1" oninput="updateBalance()"
                                    value="<?php echo $row['total']; ?>">
                            </span>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-1">
                            <input type="checkbox" id="checkbox1" onclick="updateReceived()"
                                style="margin-left:90%; margin-top:10px; width: 20px; height: 20px;">
                        </div>

                        <div class="col-md-10">
                            <span>Received</span>
                            <span style="margin-left:10px;">
                                <input type="text" id="received" class="name1" oninput="updateBalance()"
                                    value="<?php echo $row['recieved']; ?>">
                            </span>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-12">
                            <span style="margin-left:10px">Balance:</span>
                            <span id="balance" class="text-right"
                                style="margin-left: 50px; background-color: transparent; font-weight: bold;">
                                <?php echo $row['balance']; ?>
                            </span>
                        </div>
                    </div>

                    <input type="hidden" id="hiddenBalance" name="hiddenBalance">

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

                            // Update the hidden input field with the calculated balance
                            document.getElementById('hiddenBalance').value = balance.toFixed(2);
                        }
                    </script>

                </div>
            </div>

            <div class="row">
                <div class="col-md-11"></div>
                <div class="col-md-1">
                    <button type="submit" class="buttons" id="save0">Save</button>
                </div>

                <script>
                    $(document).ready(function () {
                        // Get the id from the URL
                        let url = new URL(window.location.href);
                        let id = url.searchParams.get("id");

                        $("#save0").click(function () {
                            let total = $("#total").val();
                            let received = $("#received").val();
                            let balance = $("#hiddenBalance").val();

                            $.ajax({
                                url: './ajax/moneyajax.php',
                                method: "POST",
                                data: {
                                    total: total,
                                    received: received,
                                    balance: balance,
                                    id: id,
                                },
                                success: function (res) {
                                    console.log(res);
                                    alert(res);
                                },
                                error: function (err) {
                                    console.error(err);
                                }
                            });
                        });
                    });
                </script>

            </div>

            <?php
        }
        ?>
    </div>
</body>

</html>