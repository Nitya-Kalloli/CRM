<?php
include('../connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

    // Perform a search query to get matching items from the database
    $sql = "SELECT mrp, tax FROM newitems WHERE name LIKE '%" . $searchTerm . "%'";
    $result = $con->query($sql);

    if ($result) {
        // Store the matching items in an array
        $items = array();
        while ($row = $result->fetch_assoc()) {
            $items[] = [
                'mrp' => $row['mrp'],
                'gst' => $row['tax']
            ];
        }

        // Send the array as JSON response
        echo json_encode(['mrp' => $items[0]['mrp'], 'gst' => $items[0]['gst']]);
    } else {
        // Return a JSON error response
        echo json_encode(['error' => 'Error in search query: ' . $con->error]);
    }


} else {
    // Return a JSON error response for an invalid request
    $invalidRequestString = json_encode(['error' => 'Invalid request']);
    echo $invalidRequestString;
}
?>