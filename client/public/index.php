<?php
// We need to use sessions, so you should always initialize sessions using the below function
session_start();
// If the user is logged in, redirect to the home page
if (isset($_SESSION['account_loggedin'])) {
    header('Location: home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="icon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="account.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
    <title>Account</title>
    <script type="text/javascript" src="validation.js" defer></script>
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
            <li><a href="#">Book Consultation</a></li>
            <li><a href="#">Green Energy Market News</a></li>
            <li><a href="#">About</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="account.html"><span class="glyphicon glyphicon-log-in"></span> Account</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
        <div class="wrapper"> 
            <h1>Sign Up</h1>
            <p id="error-message"></p>
            <form action="index.php" method="post" id="form">
                <div>
                    <label for="firstname-input"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z"/></svg></label>
                    <input required type="text" name="firstname" id="firstname-input" placeholder="First Name">
                </div>
                <div>
                    <label for="email-input">
                        <span>@</span>
                    </label>
                    <input required type="email" name="email" id="email-input" placeholder="Email">
                </div>
                <div>
                    <label for="password-input"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg></label>
                    <input required type="password" name="password" id="password-input" placeholder="Password">
                </div>
                <div>
                    <label for="password-input"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg></label>
                    <input required type="password" name="repeat-password" id="repeat-password-input" placeholder="Repeat Password">
                </div>
                <button type="submit">Sign Up</button>
            </form>
            <p>Already have an account?<a href="login.html"> Login here</a></p>
        </div>
    </div>
    <footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark text-white-50">
        <div class="container text-center">
          <img src="icon.png" alt="logo" width="50px">
          <small>Copyright &copy; Rolsa Technologies</small>
        </div>
      </footer>

    </body>
</html>