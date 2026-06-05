<?php
session_start();
include 'db_connect.php';

if(isset($_POST['user_login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $login_sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $login_sql);
    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['full_name'];
        $_SESSION['user_email'] = $user['email'];
        header("Location: user_dashboard.php");
        exit();
    } else {
        $error = "Invalid Email or Password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <div class="logo-section">
      <img src="planbot.png" alt="Logo" class="logo">
      <h1>User Login</h1>
    </div>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="view_event.php">Events</a></li>
        <li><a href="signup.php">Sign Up</a></li>
      </ul>
    </nav>
  </header>
  <section class="hero">
    <h2>Student Login Portal</h2>
    <p>Login to manage your event registrations.</p>
  </section>
  <main class="login-container">
    <?php if(isset($error)){ echo "<p style='color:red;text-align:center;'>$error</p>"; } ?>
    <form class="login-form" method="POST">
      <div class="form-group">
        <label>Email Address</label>
        <input type="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter password" required>
      </div>
      <button type="submit" name="user_login" class="submit-btn">Login</button>
      
      <p style="text-align:center; margin-top:10px;">Don't have an account? <a href="signup.php">Sign Up</a></p>
<p style="text-align:center; margin-top:5px;"><a href="forgot_password.php">Forgot Password?</a></p>
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