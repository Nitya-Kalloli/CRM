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

    <div class="body1">

        <div class="container mt-4">

            <h1 class="heading">Customer Entries</h1>

            <div class="row">
                <div class="col-md-4">
                    <label for="name">Name:</label>
                    <input type="text" id="name" class="name">
                </div>
                <div class="col-md-4">
                    <label for="name">Mobile Number:</label>
                    <input type="text" id="phone" class="name">
                </div>
               
                <div class="col-md-4">
                    <label for="name">Email:</label>
                    <input type="text" id="email" class="name">
                </div>
                <div class="col-md-4">
                    <label for="name">Adhar Number</label>
                    <input type="text" id="aadhar" class="name">
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
                <div class="col-md-4">
                    <label for="name">City:</label>
                    <input type="text" id="city" class="name">
                </div>
                <div class="col-md-4">
                    <label for="name">Shipping Address:</label>
                    <input type="text" id="shipping-address" class="name">
                </div>
                <!-- <div class="col-md-4">
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
                </div> -->
            </div>
            <div class="col-md-3 ">
                <span style="color:red;" id="error"></span>
                <br>
                <button type="submit" class="buttons" id="save11">Save</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#save11").click(function () {
                console.log("inside click")
                let cuname = $("#name").val();
                let email = $("#email").val();
                let phno = $("#phone").val();
                let aadharno = $("#aadhar").val(); 
                let state = $("#state").val();
                let city = $("#city").val();
                let shippingadd = $("#shipping-address").val();

                if (cuname === '') {
                    $("#error").html("Please enter the name");
                }  else if (phno === '') {
                    $("#error").html("Please enter the phone number");
                } 
                else if (email === '') {
                    $("#error").html("Please enter the email");
                }else if (aadharno === '' || aadharno.length < 12) {
                    $("#error").html("Please enter a valid Aadhar number");
                } else if (state === '') {
                    $("#error").html("Please select the state");
                } else if (city === '') {
                    $("#error").html("Please enter the city");
                } else if (shippingadd === '') {
                    $("#error").html("Please enter the shipping address");
                } else {
                    $.ajax({
                        url: './ajax/customerajax.php',
                        method: 'POST',
                        data: {
                            name: cuname,
                            email: email,
                            phone: phno,
                            aadharno: aadharno,
                            state: state,
                            city: city,
                            shippingadd: shippingadd,
                        },
                        success: function (res) {
                            console.log(res);
                            alert(res);

                        },
                        error: function (err) {
                            console.error(err);
                        }
                    });
                }
            });
        });
    </script>
</body>
<?php
include 'footer.php';
?>

</html>