<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database configuration
    $servername = "localhost";
    $username = "root";       // Default XAMPP username
    $password = "";           // Default XAMPP password is empty
    $dbname = "consultations";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Collect form data and sanitize
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $date = $conn->real_escape_string($_POST['date']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert into the database
    $sql = "INSERT INTO bookings (name, email, phone, date, message)
            VALUES ('$name', '$email', '$phone', '$date', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking successful. Thank you!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
