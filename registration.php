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
<style>
    .container {
        width: 30%;
    }
</style>

<body>

    <div class="container">

        <div class="registration">
            <h1> Registration</h1>
            <div class="form-label">
                <label for="firstname"> Name:</label>
                <input type="text" id="rname" class="form-control1">
            </div> 
            <div class="form-label">
                <label>Company Name:</label>
                <input type="text" id="rcname" class="form-control1">
                
            </div>
            <div class="form-label">
                <label>GST Number:</label>
                <input type="text" id="gno" class="form-control1">
                
            </div>

            <div class="form-label">
                <label>Website Link:</label>
                <input type="url" id="rweb" class="form-control1">
             
            </div>

            <div class="form-label">
                <label>Mobile number:</label>
                <input id="rnumber" class="form-control1">
            </div>
            <div class="form-label">
                <label>Email:</label>
                <input type="email" id="remail" class="form-control1">
            </div>

            <div class="form-label">
                <label>Password:</label>
                <input type="password" id="rpass" class="form-control1">
            </div>


            <div class="form-label">
                <label>Address:</label>
                <input type="text" id="address" class="form-control1">
            </div>
            <div class="form-label">
                <label for="state">Select your state:</label>
                <select id="state" class="form-control1">
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

            <div class="form-label">
                <label>Bank name:</label>
                <input type="text" id="rbname" class="form-control1">
            </div>

            <div class="form-label">
                <label>IFCS Code:</label>
                <input type="text" id="rcode" class="form-control1">

            </div>
            <div class="form-label">
                <label>Acc no:</label>
                <input type="text" id="accno" class="form-control1">
            </div>

            <div class="form-label">
                <label>Add image</label>
                <input type="file" name="image" id="image" class="form-control1 " style="width:100%;"
                    accept="image/jpeg, image/png">
            </div>

            <span style="color:red;" id="error"></span>
            <br>

            <button class="buttons" style="margin-top: 0px;" type="submit" id="smit">submit</button>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#smit").click(function () {

                let pimage = $('#image').val();
                var input = $('#image')[0];
                var files = input.files;
                var inputIds = ['#image'];

                let rname = $("#rname").val();
                let rcname = $("#rcname").val();
                let rweb = $("#rweb").val();
                let rnumber = $("#rnumber").val();
                let remail = $("#remail").val();
                let address = $("#address").val();
                let rbname = $("#rbname").val();
                let rcode = $("#rcode").val();
                let accno = $("#accno").val();
                let rpass = $("#rpass").val();
                let gno = $("#gno").val();
                let state = $("#state").val();

                if (rname == '') {
                    $("#error").html("Please enter the name")
                } else if (rnumber == '') {
                    $("#error").html("Please enter the mobile number")
                }
                else if (rcname == '') {
                    $("#error").html("Please enter the company name")
                } else if (gno == '') {
                    $("#error").html("Please enter the gst number")
                }
                // else if (rweb == '') {
                //     $("#error").html("Please enter the website links")
                // }
                else if (remail == '') {
                    $("#error").html("Please enter the email")
                } else if (rpass == '') {
                    $("#error").html("Please enter the Password")
                }  else if (address == '') {
                    $("#error").html("Please enter the company address")
                } else if (state == '') {
                    $("#error").html("Please select your state")
                } else if (rbname == '') {
                    $("#error").html("Please enter the bank name")
                } else if (rcode == '') {
                    $("#error").html("Please enter the IFSC code")
                }
                else if (accno == '') {
                    $("#error").html("Please enter the account number")
                }
                else if (files.length === 0) {
                    alert("Please select your logo image!");
                    return false;
                }
                else {
                    var formdata = new FormData();
                    for (var i = 0; i < files.length; i++) {
                        formdata.append('files[]', files[i]);
                    }

                    formdata.append('rname', rname);
                    formdata.append('rnumber', rnumber);
                    formdata.append('rcname', rcname);
                    formdata.append('rweb', rweb);
                    formdata.append('remail', remail);
                    formdata.append('address', address);
                    formdata.append('rpass', rpass);
                    formdata.append('rbname', rbname);
                    formdata.append('rcode', rcode);
                    formdata.append('accno', accno);
                    formdata.append('gno', gno);
                    formdata.append('state', state);

                    $.ajax({
                        url: './ajax/registrationajax.php',
                        method: 'POST',
                        data: formdata,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function (res) {
                            alert(res.message);
                        },
                        error: function (xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            }); // Corrected closing parenthesis
        });
    </script>
</body>

<?php
include 'footer.php';
?>

</html>