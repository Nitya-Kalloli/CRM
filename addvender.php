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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <div class="body1">

        <div class="container mt-4">


            <!-- <div class="row">
                <div class="col-md-6">
                    <h1>Company Name</h1>
                </div>

                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <i class="fa-brands fa-slack logos"></i>
                </div>
            </div> -->
            <div class="row">
                <div class="col-md-4">
                    <label for="name">Name:</label>
                    <input type="text" id="name" class="name">
                </div>
                <div class="col-md-4">
                    <label for="name">Mobile Number:</label>
                    <input type="text" id="number" class="name">
                </div>
                <div class="col-md-4">
                    <label for="name">Whatsapp Number:</label>
                    <input type="text" id="wnumber" class="name">
                </div>
                <div class="col-md-4">
                    <label for="name">Email:</label>
                    <input type="text" id="email" class="name">
                </div>
                <div class="col-md-4">
                    <label for="name">Company Name:</label>
                    <input type="text" id="companyName" class="name">
                </div>
                <div class="col-md-4">
                    <label for="name">GST Number:</label>
                    <input type="text" id="GstNumber" class="name">
                </div>
                <div class="col-md-4">
                    <label for="name">Bank Account:</label>
                    <input type="text" id="bankAccount" class="name">
                </div>
                <div class="col-md-4">
                    <label for="name">Bank IFCS Number:</label>
                    <input type="text" id="bankifcs" class="name">
                </div>
                <div class="col-md-4">
                    <label for="name">Select a Type:</label>
                    <select id="type" class="name">
                        <option value=""></option>
                        <option>Cement</option>
                        <option>Bricks</option>
                        <option>Soil</option>
                        <option>Steel</option>
                        <option>Paint</option>
                        <option>Wall putti</option>
                        <option>Plumber</option>
                        <option>Electrician</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="name">Company Address:</label>
                    <textarea style="height: 120px;" id="companyAddress" class="name"></textarea>
                </div>
                <div class="col-md-4">
                    <label for="state">Select your state:</label>
                    <select id="state" class="name">
                        <option value=""></option>
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
            </div>
            <div class="col-md-3 ">
                <span style="color:red;" id="error"></span>
                <br>
                <button type="submit" class="buttons" id="save">Save</button>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#save").click(function () {
                let name = $("#name").val();
                let number = $("#number").val();
                let email = $("#email").val();
                let companyName = $("#companyName").val();
                let GstNumber = $("#GstNumber").val();
                let bankAccount = $("#bankAccount").val();
                let companyAddress = $("#companyAddress").val();
                let type = $("#type").val();
                let state = $("#state").val();
                let bankifcs = $("#bankifcs").val();

                if (name == '') {
                    $("#error").html("Please enter the name")
                } else if (number == '') {
                    $("#error").html("Please enter the mobile number")
                } else if (email == '') {
                    $("#error").html("Please enter the email")
                } else if (companyName == '') {
                    $("#error").html("Please enter the company name")
                } else if (GstNumber == '') {
                    $("#error").html("Please enter the GST number")
                } else if (bankAccount == '') {
                    $("#error").html("Please enter the bank account")
                } else if (bankifcs == '') {
                    $("#error").html("Please enter the bank IFCS code")
                } else if (companyAddress == '') {
                    $("#error").html("Please enter the company address")
                } else if (type == '') {
                    $("#error").html("Please select a type")
                } else if (state == '') {
                    $("#error").html("Please select your state")
                } else {
                    $.ajax({
                        url: './ajax/addvenderajax.php',
                        method: "POST",
                        data: {
                            name: name,
                            number: number,
                            email: email,
                            companyName: companyName,
                            GstNumber: GstNumber,
                            bankAccount: bankAccount,
                            companyAddress: companyAddress,
                            type: type,
                            state: state,
                            bankifcs: bankifcs,
                        },
                        success: function (res) {
                            console.log(res);
                            if (res === 'success') {
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Vendor added successfully!',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'addvender.php'; // Redirect to the desired page
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: res, // Display the error message from the server
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        },


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