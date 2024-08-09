<?php
// session_start();
include('../connect.php');

$uid = $_POST['uid'];

$updateStatusQuery = "UPDATE registration SET status = '0' WHERE id = ?";
$stmt1 = $con->prepare($updateStatusQuery);
$stmt1->bind_param("i", $uid);
echo "You rejected a user";

if ($stmt1->execute()) {
    echo "Status updated successfully.";
} else {
    echo "Failed to update status.";
}

$stmt1->close();
