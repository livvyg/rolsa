<?php
// The configuration file
require_once "config.php";

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$email = $password = "";
$email_err = $password_err = "";

// Process submitted form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Proceed if no validation errors
    if (empty($email_err) && empty($password_err)) {

        $sql = "SELECT PersonID, email, password FROM persons WHERE email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = $email;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);

                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, start a new session
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;

                            // Check if "Remember Me" is selected
                            if (!empty($_POST["remember"])) {
                                $token = bin2hex(random_bytes(16));
                                $expiry = date('Y-m-d H:i:s', strtotime('+30 days'));

                                // Insert token into database
                                $insert_token_sql = "INSERT INTO user_tokens (user_id, token, expiry) VALUES (?, ?, ?)";
                                if ($insert_stmt = mysqli_prepare($link, $insert_token_sql)) {
                                    mysqli_stmt_bind_param($insert_stmt, "iss", $id, $token, $expiry);
                                    mysqli_stmt_execute($insert_stmt);
                                    mysqli_stmt_close($insert_stmt);
                                }

                                // Set cookie for 30 days
                                setcookie("remember_token", $token, time() + (86400 * 30), "/");
                            }

                            // Redirect to dashboard
                            header("location: dashboard.html");
                            exit;
                        } else {
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    $email_err = "No account found with that email.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
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
    <link rel="stylesheet" href="login.css" />
    <script src="https://static.elfsight.com/platform/platform.js" async></script>
<div style="background-color: #D8F1A0" class="elfsight-app-f5b27d08-c1d3-4f99-ae23-145b20b92581" data-elfsight-app-lazy></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
    <title>Log in</title>
    <script type="text/javascript" src="validation.js" defer></script>
  </head>

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
        <h2>Login</h2>
        <p>Please fill in your credentials to log in.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>

            <p>Don't have an account? <a href="account.php">Sign up here</a>.</p>
        </form>
    </div>    
</div>

<footer id="sticky-footer" class="py-4 bg-dark text-white-50">
    <div class="container text-center">
        <img src="icon.png" alt="logo" width="50px">
        <small>Copyright &copy; Rolsa Technologies</small>
    </div>
</footer>

</body>
</html>
