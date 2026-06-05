<?php
session_start();
include 'db_connect.php';

if(isset($_POST['signup'])){

    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = $_POST['confirm_password'];

    // Validation
    if(empty($full_name) || empty($email) || empty($password)){
        $error = "All fields are required.";
    } elseif(strlen($password) < 6){
        $error = "Password must be at least 6 characters.";
    } elseif($password !== $confirm_password){
        $error = "Passwords do not match.";
    } else {
        // Check if email already exists
        $check_sql = "SELECT id FROM users WHERE email='$email'";
        $check_result = mysqli_query($conn, $check_sql);

        if(mysqli_num_rows($check_result) > 0){
            $error = "An account with this email already exists.";
        } else {
            $insert_sql = "INSERT INTO users (full_name, email, password) VALUES ('$full_name', '$email', '$password')";
            if(mysqli_query($conn, $insert_sql)){
                $success = "Account created successfully! You can now login.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <header>
    <div class="logo-section">
      <img src="planbot.png" alt="Logo" class="logo">
      <h1>Create Account</h1>
    </div>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="view_event.php">Events</a></li>
        <li><a href="user_login.php">Login</a></li>
      </ul>
    </nav>
  </header>

  <section class="hero">
    <h2>Sign Up</h2>
    <p>Create an account to register for events.</p>
  </section>

  <main class="login-container">
    <?php if(isset($error)){ echo "<p style='color:red;text-align:center;'>$error</p>"; } ?>
    <?php if(isset($success)){ echo "<p style='color:green;text-align:center;'>$success</p>"; } ?>

    <form class="login-form" method="POST">

      <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="full_name" placeholder="Enter your full name" required>
      </div>

      <div class="form-group">
        <label>Email Address</label>
        <input type="email" name="email" placeholder="Enter your email" required>
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Min. 6 characters" required>
      </div>

      <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="Repeat your password" required>
      </div>

      <button type="submit" name="signup" class="submit-btn">Create Account</button>
      <p style="text-align:center; margin-top:10px;">Already have an account? <a href="user_login.php">Login</a></p>

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
