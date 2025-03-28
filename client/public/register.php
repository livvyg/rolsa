<?php
// Include database connection
include('db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user input to prevent SQL injection
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $repeatPassword = mysqli_real_escape_string($conn, $_POST['repeat-password']);

    // Check if passwords match
    if ($password !== $repeatPassword) {
        echo "Passwords do not match!";
        exit;
    }

    // Hash the password using bcrypt for security
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Get the current timestamp for the 'registered' field
    $registered = date("Y-m-d H:i:s");

    // Prepare SQL statement to insert data into the 'accounts' table
    $stmt = $conn->prepare("INSERT INTO accounts (firstname, email, password, registered) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstname, $email, $hashedPassword, $registered);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New account created successfully!";
        // Redirect to login page or show a success message
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement and connection
    $stmt->close();
    $conn->close();
}
?>
