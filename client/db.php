<?php
$servername = "127.0.0.1";  // MySQL server
$username = "root";         // MySQL username (change if needed)
$password = "";             // MySQL password (empty by default for XAMPP/WAMP)
$dbname = "phplogin";       // The database name you're working with

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for a connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
