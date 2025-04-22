<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$firstname = $email = $password = $confirm_password = "";
$firstname_err = $email_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate firstname
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Please enter your first name.";
    } else{
        $firstname = trim($_POST["firstname"]);
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    } elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else{
        // Prepare a select statement
        $sql = "SELECT PersonID FROM persons WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = trim($_POST["email"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($firstname_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO persons (firstname, email, password) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sss", $param_firstname, $param_email, $param_password);
            
            $param_firstname = $firstname;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            
            if(mysqli_stmt_execute($stmt)){
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            
        }
    }
    mysqli_close($link);
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
    <title>Sign Up</title>
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
    <div class="container">
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="form-group">
        <label>First Name</label>
        <input type="text" name="firstname" class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstname; ?>">
        <span class="invalid-feedback"><?php echo $firstname_err; ?></span>
    </div>    

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
        <span class="invalid-feedback"><?php echo $email_err; ?></span>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
        <span class="invalid-feedback"><?php echo $password_err; ?></span>
    </div>

    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Submit">
    </div>

    <p>Already have an account? <a href="login.php">Login here</a>.</p>
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
</html>