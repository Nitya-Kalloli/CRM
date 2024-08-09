<?php
session_start();
$uid = $_SESSION['uid'];
include('../connect.php');

$name = $_POST['name'];
$number = $_POST['number'];
$category = $_POST['category'];
$code = $_POST['code'];
$mrp = $_POST['mrp'];
$discount = $_POST['discount'];
$sellingPrice = $_POST['sellingPrice'];
$type = $_POST['type'];
$purchasePrice = $_POST['purchasePrice'];
$tax = $_POST['tax'];

$sql = "INSERT INTO `newitems` (`name`, `hsn`,`category`, `itemcode`, `mrp`, `discount`, `sellprice`, `purprice`,`taxtype`,`tax`,`uid`) VALUES (?, ?, ?, ?,?, ?, ?, ?,?,?,?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sssssssssss", $name, $number, $category, $code, $mrp, $discount, $sellingPrice, $purchasePrice, $type, $tax, $uid);
$query0 = $stmt->execute();

if ($query0) {
    echo "Saved successful!";
} else {
    echo "Failed to save";
}

$stmt->close();
