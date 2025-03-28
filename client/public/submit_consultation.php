<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $name = $_POST['fname'];
    if (empty($name)) {
        echo "Name is empty";
    } else {
        echo $name;
    }

    $email = $_POST['email'];
    if (empty($email)) {
        echo "Email is empty";
    } else {
        echo $email;
    }
}
?>