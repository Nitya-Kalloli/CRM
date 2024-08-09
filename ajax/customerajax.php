<?php
session_start();
$uid = $_SESSION['uid'];
include('../connect.php');

$cuname = $_POST['name'];
$email = $_POST['email'];
$phno = $_POST['phone'];
$aadharno = $_POST['aadharno'];
$state = $_POST['state'];
$city = $_POST['city'];
$shippingadd = $_POST['shippingadd'];

$sql = "INSERT INTO `customer` (`cuname`, `email`, `phno`, `aadharno`, `state`, `city`, `shippingadd`, `uid`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssssssss", $cuname, $email, $phno, $aadharno, $state, $city, $shippingadd, $uid);
$query = $stmt->execute();

if ($query) {
    echo "success";
} else {
    echo "Failed to save";
}

$stmt->close();
$con->close();
?>