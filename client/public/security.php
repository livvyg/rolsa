
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="icon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="security.css"/>
    <!-- Elfsight Website Translator | Untitled Website Translator -->
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
        <li ><a href="dashboard.php">Profile</a></li>
        <li class="activeprofile"><a href="security.php">Security</a></li>
        <li class="notactive"><a href="notifications.php">Bookings</a></li>
        <li class="notactive"><a href="account.php">Log Out</a></li>
      </ul><br>
    </div>
  
    <div class="container-fluid1">
      <h1>Security Settings</h1>
      <hr class="solid">
      <h4>Change Password</h4>
      <form method="post" action="passwordchange.php">
    <label for="old_password">Old Password:</label>
    <input type="password" id="old_password" name="old_password" required><br><br>

    <label for="new_password">New Password:</label>
    <input type="password" id="new_password" name="new_password" required><br><br>

    <label for="confirm_password">Confirm New Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required><br><br>

    <button type="submit">Change Password</button>
</form>

  
    
      
    </div>
  </div>
  

<footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark text-white-50">
    <div class="container text-center">
      <img src="icon.png" alt="logo" width="50px">
      <small>Copyright &copy; Rolsa Technologies</small>
    </div>
  </footer>

</body>
