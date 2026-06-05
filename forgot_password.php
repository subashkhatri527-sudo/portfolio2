<?php
session_start();
include 'db_connect.php';

if(isset($_POST['forgot'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Check if email exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    
    if(mysqli_num_rows($check) > 0){
        // Generate token
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
        
        // Save token to database
        mysqli_query($conn, "UPDATE users SET reset_token='$token', token_expiry='$expiry' WHERE email='$email'");
        
        $reset_link = "http://localhost/event/event/reset_password.php?token=$token";
        $success = "Reset link generated! <a href='$reset_link'>Click here to reset your password</a>";
    } else {
        $error = "No account found with that email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <div class="logo-section">
      <img src="planbot.png" alt="Logo" class="logo">
      <h1>Forgot Password</h1>
    </div>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="user_login.php">Login</a></li>
        <li><a href="signup.php">Sign Up</a></li>
      </ul>
    </nav>
  </header>
  <section class="hero">
    <h2>Reset Your Password</h2>
    <p>Enter your email to get a reset link.</p>
  </section>
  <main class="login-container">
    <?php if(isset($error)){ echo "<p style='color:red;text-align:center;'>$error</p>"; } ?>
    <?php if(isset($success)){ echo "<p style='color:green;text-align:center;'>$success</p>"; } ?>
    <form class="login-form" method="POST">
      <div class="form-group">
        <label>Email Address</label>
        <input type="email" name="email" placeholder="Enter your email" required>
      </div>
      <button type="submit" name="forgot" class="submit-btn">Send Reset Link</button>
      <p style="text-align:center; margin-top:10px;"><a href="user_login.php">Back to Login</a></p>
    </form>
  </main>
  <footer>
    <h3>Contact Information</h3>
    <p>Email: planbot@yahoo.com</p>
    <p>Phone: +45 87542109</p>
    <p>Address: Nørre Voldgade 34 1358 Copenhagen K</p>
  </footer>
</body>
</html>