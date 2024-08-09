<?php
session_start();
$uid = $_SESSION['uid'];
include('../connect.php');

$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];
$companyName = $_POST['companyName'];
$gstNumber = $_POST['GstNumber'];
$bankAccount = $_POST['bankAccount'];
$companyAddress = $_POST['companyAddress'];
$type = $_POST['type'];
$state = $_POST['state'];
$bankifcs = $_POST['bankifcs'];

$sql = "INSERT INTO `vender` (`bankifcs`,`name`, `number`, `email`, `companyName`, `gstNumber`, `bankAccount`, `type`, `companyAddress`,`uid`,`state`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sssssssssss",$bankifcs, $name, $number, $email, $companyName, $gstNumber, $bankAccount, $type, $companyAddress, $uid, $state);
$query0 = $stmt->execute();

if ($query0) {
    echo "success";
} else {
    echo "Failed to save";
}

$stmt->close();