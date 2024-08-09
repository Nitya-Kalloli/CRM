<?php
session_start();
$uid = $_SESSION['uid'];
include('../connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the search term from the AJAX request
    $searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

    // Perform a simple search query (you might want to adjust this based on your table structure)
    $sql = "SELECT * FROM vender WHERE companyName LIKE '%$searchTerm%' ORDER BY companyName";
    $result = $con->query($sql);

    if ($result) {
        // Display search results with specific HTML elements and classes
        while ($row = $result->fetch_assoc()) {
            echo '<div class="search-result">';
            echo '<p class="company-name">' . $row['companyName'] . '</p>';
            // Add other fields as needed
            echo '</div>';
        }
    } else {
        echo 'Error in search query: ' . $con->error;
    }
} else {
    // Handle invalid requests (e.g., direct access to this PHP file)
    echo 'Invalid request';
}
?>