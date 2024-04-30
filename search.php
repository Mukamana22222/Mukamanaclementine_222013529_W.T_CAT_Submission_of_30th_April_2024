<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {
    // Connection details
    include('database_connection.php');
    // Sanitize input to prevent SQL injection
    $searchTerm = $conn->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'product' => "SELECT Name FROM product WHERE Name LIKE '%$searchTerm%'",
        'customer' => "SELECT customerName FROM Customer WHERE customerName LIKE '%$searchTerm%'",
        'supplier' => "SELECT SupplierName FROM Supplier WHERE SupplierName LIKE '%$searchTerm%'",
        'payment' => "SELECT PaymentMethod FROM payment WHERE PaymentMethod LIKE '%$searchTerm%'",
        'order_' => "SELECT orderName FROM order_ WHERE orderName LIKE '%$searchTerm%'",
        'promotion' => "SELECT PromotionID FROM promotion WHERE PromotionID LIKE '%$searchTerm%'",
        'category' => "SELECT CategoryID FROM category WHERE CategoryID LIKE '%$searchTerm%'"
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $conn->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $conn->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
