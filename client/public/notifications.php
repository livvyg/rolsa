<?php
require_once "config2.php"; // database connection
session_start();



// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$user_id = $_SESSION["id"];
$sql = "SELECT date, email FROM bookings WHERE id = ?";

if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $date, $email);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
} else {
    $date = "Unknown";
    $email = "Unknown";
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="icon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="notifications.css"/>
    <script src="https://static.elfsight.com/platform/platform.js" async></script>
    <div style="background-color: #D8F1A0" class="elfsight-app-f5b27d08-c1d3-4f99-ae23-145b20b92581" data-elfsight-app-lazy></div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
    <title>Dashboard</title>
  </head>
  <body>
  <nav class="navbar navbar-inverse justify-content-center">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <img class="logo" src="icon.png" alt="logo" width="50px" />
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="index.html">Home</a></li>
          <li><a href="cfc.html">Carbon Footprint Calculator</a></li>
          <li><a href="consultation.html">Book Consultation</a></li>
          <li><a href="marketnews.html">Green Energy Market News</a></li>
          <li><a href="about.html">About</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="active"><a href="account.php"><span class="glyphicon glyphicon-log-in"></span> Account</a></li>
        </ul>
      </div>
    </div>
  </nav>

  
  
  <div class="profile-layout">
    <div class="sidenav">
      <ul class="nav nav-pills nav-stacked">
        <li><a href="dashboard.php">Profile</a></li>
        <li><a href="security.php">Security</a></li>
        <li class="activeprofile"><a href="notifications.php">Bookings</a></li>
        <li><a href="account.php">Log Out</a></li>
      </ul><br>
    </div>
  
    <div class="container-fluid1">
      <h1>Your Bookings</h1>
      <hr class="solid">
      <p>Date:<?php echo htmlspecialchars($date); ?></p>
      <hr class="solid">
   
    </div>
  </div>
  

    

<footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark text-white-50">
    <div class="container text-center">
      <img src="icon.png" alt="logo" width="50px">
      <small>Copyright &copy; Rolsa Technologies</small>
    </div>
  </footer>

</body>
