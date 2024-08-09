<?php
session_start();
$uid = $_SESSION['uid'];
include('../connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the search term from the AJAX request
    $searchTerm1 = isset($_POST['searchTerm1']) ? $_POST['searchTerm1'] : '';

    // Perform a search query with ORDER BY to get results in alphabetical order
    $sql = "SELECT * FROM newitems WHERE name LIKE '%" . $searchTerm1 . "%' ORDER BY name";
    $result = $con->query($sql);

    if ($result) {
        // Display search results with specific HTML elements and classes
        while ($row = $result->fetch_assoc()) {
            echo '<div class="flo">';
            echo '<p class="item">' . $row['name'] . '</p>';
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


<style>
    .flo {
        /* margin-top: 10px; */
        width: 260px;
        height: 30px;
        background-color: rgba(0, 123, 255, 0.2);
        border: 1px solid blue;
    }

    .item {
        text-align: center;
        font-weight: bold;
        color: #333;
    }
</style>