<?php
// Connection
$host = "localhost";
$user = "clementine222013529";
$pass = "222013529";
$database = "cat222013529";

// Create the connection
$conn = new mysqli($host, $user, $pass, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>