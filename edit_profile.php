<?php
session_start();
include 'db_connect.php';

// Block access if not logged in
if(!isset($_SESSION['user_id'])){
    header("Location: user_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch current user data
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation
    if(empty($full_name) || empty($email)){
        $error = "Name and email are required.";
    } else {
        // Check if email taken by another user
        $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email' AND id != '$user_id'");
        if(mysqli_num_rows($check) > 0){
            $error = "That email is already used by another account.";
        } else {
            // Update with or without password change
            if(!empty($new_password)){
                if(strlen($new_password) < 6){
                    $error = "New password must be at least 6 characters.";
                } elseif($new_password !== $confirm_password){
                    $error = "Passwords do not match.";
                } else {
                    $update = "UPDATE users SET full_name='$full_name', email='$email', password='$new_password' WHERE id='$user_id'";
                    mysqli_query($conn, $update);
                    $_SESSION['user_name'] = $full_name;
                    $_SESSION['user_email'] = $email;
                    $success = "Profile updated successfully!";
                }
            } else {
                $update = "UPDATE users SET full_name='$full_name', email='$email' WHERE id='$user_id'";
                mysqli_query($conn, $update);
                $_SESSION['user_name'] = $full_name;
                $_SESSION['user_email'] = $email;
                $success = "Profile updated successfully!";
            }
            // Refresh user data
            $result = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
            $user = mysqli_fetch_assoc($result);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <div class="logo-section">
      <img src="planbot.png" alt="Logo" class="logo">
      <h1>Edit Profile</h1>
    </div>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="view_event.php">Events</a></li>
        <li><a href="user_dashboard.php">Dashboard</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
  <section class="hero">
    <h2>Edit Your Profile</h2>
    <p>Update your name, email or password.</p>
  </section>
  <main class="login-container">
    <?php if(isset($error)){ echo "<p style='color:red;text-align:center;'>$error</p>"; } ?>
    <?php if(isset($success)){ echo "<p style='color:green;text-align:center;'>$success</p>"; } ?>
    <form class="login-form" method="POST">
      <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
      </div>
      <div class="form-group">
        <label>Email Address</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
      </div>
      <div class="form-group">
        <label>New Password <small>(leave blank to keep current)</small></label>
        <input type="password" name="new_password" placeholder="Min. 6 characters">
      </div>
      <div class="form-group">
        <label>Confirm New Password</label>
        <input type="password" name="confirm_password" placeholder="Repeat new password">
      </div>
      <button type="submit" name="update" class="submit-btn">Update Profile</button>
      <p style="text-align:center; margin-top:10px;"><a href="user_dashboard.php">Back to Dashboard</a></p>
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
