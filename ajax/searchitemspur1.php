<?php
include('../connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

    // Perform a search query to get matching items from the database
    $sql = "SELECT name FROM newitems WHERE name LIKE '%" . $searchTerm . "%'";
    $result = $con->query($sql);

    if ($result) {
        // Store the matching items in an array
        $items = array();
        while ($row = $result->fetch_assoc()) {
            $items[] = $row['name'];
        }

        // Send the array as JSON response
        echo json_encode(['items' => $items]);
    } else {
        // Return a JSON error response
        echo json_encode(['error' => 'Error in search query: ' . $con->error]);
    }
} else {
    // Return a JSON error response for invalid request
    echo json_encode(['error' => 'Invalid request']);
}
?>