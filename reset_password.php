<?php
session_start();
include 'db_connect.php';

$token = $_GET['token'] ?? '';

// Check token is valid and not expired
$check = mysqli_query($conn, "SELECT * FROM users WHERE reset_token='$token' AND token_expiry > NOW()");

if(mysqli_num_rows($check) == 0){
    die("<p style='text-align:center; color:red; font-family:Arial;'>Invalid or expired reset link. <a href='forgot_password.php'>Try again</a></p>");
}

$user = mysqli_fetch_assoc($check);

if(isset($_POST['reset'])){
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm = $_POST['confirm_password'];

    if(strlen($password) < 6){
        $error = "Password must be at least 6 characters.";
    } elseif($password !== $confirm){
        $error = "Passwords do not match.";
    } else {
        // Update password and clear token
        mysqli_query($conn, "UPDATE users SET password='$password', reset_token=NULL, token_expiry=NULL WHERE reset_token='$token'");
        $success = "Password reset successfully! <a href='user_login.php'>Login now</a>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <div class="logo-section">
      <img src="planbot.png" alt="Logo" class="logo">
      <h1>Reset Password</h1>
    </div>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="user_login.php">Login</a></li>
      </ul>
    </nav>
  </header>
  <section class="hero">
    <h2>Set New Password</h2>
    <p>Enter your new password below.</p>
  </section>
  <main class="login-container">
    <?php if(isset($error)){ echo "<p style='color:red;text-align:center;'>$error</p>"; } ?>
    <?php if(isset($success)){ echo "<p style='color:green;text-align:center;'>$success</p>"; } ?>
    <?php if(!isset($success)){ ?>
    <form class="login-form" method="POST">
      <div class="form-group">
        <label>New Password</label>
        <input type="password" name="password" placeholder="Min. 6 characters" required>
      </div>
      <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="Repeat password" required>
      </div>
      <button type="submit" name="reset" class="submit-btn">Reset Password</button>
    </form>
    <?php } ?>
  </main>
  <footer>
    <h3>Contact Information</h3>
    <p>Email: planbot@yahoo.com</p>
    <p>Phone: +45 87542109</p>
    <p>Address: Nørre Voldgade 34 1358 Copenhagen K</p>
  </footer>
</body>
</html>