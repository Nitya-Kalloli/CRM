<?php
// session_start();
include('../connect.php');

$uid = $_POST['uid'];
$name = $_POST['name'];
$password = $_POST['password'];

$sql_user = "INSERT INTO `login` (`uid`, `username`, `password`) VALUES (?, ?, ?)";
$stmt = $con->prepare($sql_user);
$stmt->bind_param("sss", $uid, $name, $password);
$query = $stmt->execute();

if ($query) {
    $updateStatusQuery = "UPDATE registration SET status = '1' WHERE id = ?";
    $stmt1 = $con->prepare($updateStatusQuery);
    $stmt1->bind_param("i", $uid);
    echo "You added 1 more person";

    if ($stmt1->execute()) {
        echo "Status updated successfully.";
    } else {
        echo "Failed to update status.";
    }

    $stmt1->close();
} else {
    echo "Failed to add";
}

$stmt->close();
$con->close();
