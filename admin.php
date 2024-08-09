<?php
include 'link.php';
include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .do a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body style="background-color: #c2c0c0;">
    <div class="container mt-4 do">
        <h1 class="hedmar">New requests</h1>
        <?php
        $sqlp = "SELECT * FROM registration WHERE status = ''";
        $result11 = $con->query($sqlp);
        if ($result11) {

            while ($row11 = $result11->fetch_assoc()) {
                $uid = $row11['id'];
                $name = $row11['name'];
                $number = $row11['mobile'];
                $companyName = $row11['org'];
                $email = $row11['email'];
                $address = $row11['address'];
                $password = $row11['password']; ?>

                <a href="./detailsadmin.php?id=<?php echo $row11['id']; ?>">

                    <div class="row shadows" style="margin:10px; margin-bottom:20px;">

                        <div class="col-md-4 info-box">
                            <p><strong>Name:</strong>
                                <?php echo $name ?>
                            </p>
                            <p><span style="font-weight: bold;">Number:</span>
                                <?php echo $number ?>
                                <span><i class="fa-solid fa-phone mar"></i></span>
                            </p>
                            <p><span style="font-weight: bold;">Email:</span>
                                <?php echo $email ?>
                                <span><i class="fa-solid fa-envelope-circle-check mar"></i></span>
                            </p>
                        </div>

                        <div class="col-md-5 info-box">
                            <p><strong>Company:</strong>
                                <?php echo $companyName ?>
                            </p>
                            <p><strong>Address:</strong>
                                <?php echo $address ?>
                            </p>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <div class="row">
                                <button id="accept" class="accept-btn" data-uid="<?php echo $uid; ?>"
                                    data-name="<?php echo $name; ?>" data-password="<?php echo $password; ?>">Accept</button>

                            </div>
                            <div class="row">
                                <button style="background-color:red; width: 100px; height: 40px;" class="reject-btn"
                                    data-uid="<?php echo $uid; ?>">Reject</button>
                            </div>
                        </div>


                    </div>

                </a>
            <?php }
        } ?>


        <!-- ----------------accepted-------------------------- -->


        <div class="container mt-4">
            <h1 class="hedmar">Accepted</h1>
            <?php
            $sqlp = "SELECT * FROM registration WHERE status = '1'";
            $result11 = $con->query($sqlp);
            if ($result11) {

                while ($row11 = $result11->fetch_assoc()) {
                    $uid = $row11['id'];
                    $name = $row11['name'];
                    $number = $row11['mobile'];
                    $companyName = $row11['org'];
                    $email = $row11['email'];
                    $address = $row11['address'];
                    $password = $row11['password']; ?>
                    <a href="./detailsadmin.php?id=<?php echo $row11['id']; ?>">

                        <div class="row shadows" style="margin:10px; margin-bottom:20px;">

                            <div class="col-md-4 info-box">
                                <p><strong>Name:</strong>
                                    <?php echo $name ?>
                                </p>
                                <p><span style="font-weight: bold;">Number:</span>
                                    <?php echo $number ?>
                                    <span><i class="fa-solid fa-phone mar"></i></span>
                                </p>

                            </div>

                            <div class="col-md-4 info-box">
                                <p><span style="font-weight: bold;">Email:</span>
                                    <?php echo $email ?>
                                    <span><i class="fa-solid fa-envelope-circle-check mar"></i></span>
                                </p>
                                <p><strong>Bank Account:</strong>
                                    <?php echo $address ?>
                                </p>
                            </div>

                            <div class="col-md-4 info-box">
                                <p><strong>Company:</strong>
                                    <?php echo $companyName ?>
                                </p>
                                <p><strong>Address:</strong>
                                    <?php echo $address ?>
                                </p>
                            </div>



                        </div>
                    </a>
                <?php }
            } ?>

            <!-- ----------------rejected-------------------------- -->


            <div class="container mt-4">
                <h1 class="hedmar">Rejected</h1>
                <?php
                $sqlp = "SELECT * FROM registration WHERE status = '0'";
                $result11 = $con->query($sqlp);
                if ($result11) {

                    while ($row11 = $result11->fetch_assoc()) {
                        $uid = $row11['id'];
                        $name = $row11['name'];
                        $number = $row11['mobile'];
                        $companyName = $row11['org'];
                        $email = $row11['email'];
                        $address = $row11['address'];
                        $password = $row11['password']; ?>

                        <a href="./detailsadmin.php?id=<?php echo $row11['id']; ?>">

                            <div class="row shadows" style="margin:10px; margin-bottom:20px;">

                                <div class="col-md-4 info-box">
                                    <p><strong>Name:</strong>
                                        <?php echo $name ?>
                                    </p>
                                    <p><span style="font-weight: bold;">Number:</span>
                                        <?php echo $number ?>
                                        <span><i class="fa-solid fa-phone mar"></i></span>
                                    </p>

                                </div>

                                <div class="col-md-4 info-box">
                                    <p><span style="font-weight: bold;">Email:</span>
                                        <?php echo $email ?>
                                        <span><i class="fa-solid fa-envelope-circle-check mar"></i></span>
                                    </p>
                                    <p><strong>Bank Account:</strong>
                                        <?php echo $address ?>
                                    </p>
                                </div>

                                <div class="col-md-4 info-box">
                                    <p><strong>Company:</strong>
                                        <?php echo $companyName ?>
                                    </p>
                                    <p><strong>Address:</strong>
                                        <?php echo $address ?>
                                    </p>
                                </div>

                            </div>
                        </a>


                    <?php }
                } ?>



            </div>

            <script>
                $(document).ready(function () {
                    $(".accept-btn").click(function () {
                        console.log("inside onclick");
                        let uid = $(this).data("uid");
                        let name = $(this).data("name");
                        let password = $(this).data("password");

                        $.ajax({
                            url: './ajax/acceptajax.php',
                            method: "POST",
                            data: {
                                uid: uid,
                                name: name,
                                password: password,
                            },
                            success: function (res) {
                                alert(res);
                                location.reload();
                            },
                            error: function (err) {
                                alert(err);
                            },
                        });
                    });
                });
            </script>


            <script>
                $(document).ready(function () {
                    $(".reject-btn").click(function () {
                        console.log("inside onclick");
                        let uid = $(this).data("uid");
                        // let name = $(this).data("name");
                        // let password = $(this).data("password");

                        $.ajax({
                            url: './ajax/rejectajax.php',
                            method: "POST",
                            data: {
                                uid: uid,
                                // name: name,
                                // password: password,
                            },
                            success: function (res) {
                                alert(res);
                                location.reload();
                            },
                            error: function (err) {
                                alert(err);
                            },
                        });
                    });
                });
            </script>

        </div>

</body>

<?php
include 'footer.php';
?>

</html>