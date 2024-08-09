<?php
include 'link.php';
include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login and registration page</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;

$sqlProduct = "SELECT * FROM vender WHERE id = $id";
$resultProduct = mysqli_query($con, $sqlProduct);

if (!$resultProduct) {
    die("Error in SQL query: " . mysqli_error($con));
}


?>

<body>
    <div class="container mt-5">

        <?php
        while ($row = mysqli_fetch_assoc($resultProduct)) {
            ?>

            
                <img src="logo.jpeg" alt="logo" class="logo">

                <style>
                    .container {
                        /* margin: 50px; */
                    }

                    .company-info {
                        background-color: #f5f5f5;
                        border: 1px solid #ddd;
                        padding: 20px;
                        border-radius: 10px;
                        margin-bottom: 20px;
                    }

                    img.logo {
                        width: 200px;
                        height: 200px;
                        margin: 0 auto;
                        display: block;
                        margin-bottom: 30px;
                        border-radius: 10px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        margin-bottom: 50px;
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

                <div class="row">


                    <div class="col-md-6 company-info" style="margin-top:0px;">
                        <h4>Company Information</h4>
                        <p><strong>Company Name:</strong>&nbsp;
                            <?php echo $row['companyName']; ?>
                        </p>
                        <p><strong>Company Address:</strong>&nbsp;
                            <?php echo $row['companyAddress']; ?>
                        </p>
                        <p><strong>State:</strong>&nbsp;
                            <?php echo $row['state']; ?>
                        </p>
                        <p><strong>Type:</strong>&nbsp;
                            <?php echo $row['type']; ?>
                        </p>
                        <p><strong>Gst Number:</strong>&nbsp;
                            <?php echo $row['gstNumber']; ?>
                        </p>
                        <!-- </div> -->
                    </div>



                    <div class="col-md-6">
                        <div class="col-md-12 company-info" style="margin-top:0px;">
                            <h4>Personal Information</h4>
                            <p><strong>Name:</strong>&nbsp;
                                <?php echo $row['name']; ?>
                            </p>
                            <p><strong>Phone No:</strong>&nbsp;
                                <?php echo $row['number']; ?>
                            </p>
                            <p><strong>Email:</strong>&nbsp;
                                <?php echo $row['email']; ?>
                            </p>
                            <p><strong>Account Number:</strong>&nbsp;
                                <?php echo $row['bankAccount']; ?>
                            </p>
                            <p><strong>IFCS Number:</strong>&nbsp;
                                <?php echo $row['bankifcs']; ?>
                            </p>
                        </div>

                    </div>
                </div>

        </div>
    <?php }
        ; ?>
</body>

</html