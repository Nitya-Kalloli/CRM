<?php
$servername = "your_mysql_server";
$username = "your_mysql_username";
$password = "your_mysql_password";
$database = "customer_data";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["input1"]);
    $email = mysqli_real_escape_string($conn, $_POST["input2"]);
    $phone = mysqli_real_escape_string($conn, $_POST["input3"]);
    $aadhar = mysqli_real_escape_string($conn, $_POST["input4"]);

    $sql = "INSERT INTO users (name, email, phone, aadhar) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $name, $email, $phone, $aadhar);
        $stmt->execute();
        $stmt->close();
        echo "Data saved successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
