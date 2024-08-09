<?php
session_start();
$uid = $_SESSION['uid'];
include('../connect.php');

$total = $_POST['total'];
$received = $_POST['received'];
$balance = $_POST['balance'];
$id = $_POST['id'];
// $balance = $_POST['hiddenBalance'];

$sql = "UPDATE `customer` SET  `total` = ?,  `recieved` = ?, `balance` = ?  WHERE `id` = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("dddi", $total, $received, $balance, $id);
$query0 = $stmt->execute();


if ($query0) {
    echo "success";
} else {
    echo "Failed to save";
}

$stmt->close();
?>
