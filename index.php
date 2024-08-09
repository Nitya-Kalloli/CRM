<?php
session_start();
$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;
include 'link.php';
include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VS CRM</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="login">
        <h1 class="hed"> VS CRM</h1>
        <label class="lab">Username</label>
        <input class="inpu" id="name" type="text">
        <br>
        <br>
        <label class="lab">password</label>
        <input class="inpu" id="pass" type="password">
        <br>
        <span style="color:red;" id="error"></span>
        <br>
        <button class="buttons" id="login">Login</button>
        <br>
        <a href="registration.php">Register here</a>
    </div>

    <script>
        $(document).ready(function () {
            $("#login").click(function () {
                console.log("onclick");
                let name = $("#name").val();
                let lpss = $("#pass").val();

                if (name == '') {
                    $("#error").html("Please enter the username")
                } else if (lpss == '') {
                    $("#error").html("Please enter the password")
                } else {
                    if (name == 'ri' && lpss === 'ri') {
                        alert("Success")
                        window.location.href = 'admin.php'
                    } else {

                        $.ajax({
                            url: './ajax/loginajax.php',
                            method: "POST",
                            data: {
                                name: name,
                                lpss: lpss,
                            },
                            success: function (res) {
                                if (res === 'success') {
                                    Swal.fire({
                                        title: 'Success',
                                        text: 'Login successful!',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = 'home.php';
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
                }
            })
        })
    </script>

</body>
<?php
include 'footer.php';
?>

</html>