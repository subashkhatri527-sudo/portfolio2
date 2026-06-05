<?php

session_start();

include 'db_connect.php';

if(isset($_POST['admin_login'])){

    $username = $_POST['username'];

    $password = $_POST['password'];

    $sql = "SELECT * FROM admins 
    WHERE username='$username' 
    AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){

        $_SESSION['admin'] = $username;

        header("Location: admin_dashboard.php");

    }
    else{

        echo "<script>alert('Invalid Username or Password');</script>";

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Admin Login</title>

  <!-- SAME CSS FILE -->
  <link rel="stylesheet" href="style.css">

</head>

<body>

  <!-- HEADER -->
  <header>

    <div class="logo-section">

      <img src="planbot.png" alt="Logo" class="logo">

      <h1>Admin Login</h1>

    </div>

    <!-- NAVIGATION -->
    <nav>
      <ul>

        <li><a href="index.html">Home</a></li>

      </ul>
    </nav>

  </header>

  <!-- HERO SECTION -->
  <section class="hero">

    <h2>Administrator Panel</h2>

    <p>
      Login to manage events, registrations, and event activities.
    </p>

  </section>

  <!-- LOGIN FORM -->
  <main class="login-container">

    <form class="login-form" method="POST">

      <!-- USERNAME -->
      <div class="form-group">

        <label>Admin Username</label>

        <input 
          type="text"
          name="username" 
          placeholder="Enter admin username"
          required
        >

      </div>

      <!-- PASSWORD -->
      <div class="form-group">

        <label>Password</label>

        <input 
          type="password" 
          name="password"
          placeholder="Enter password"
          required
        >

      </div>

      <!-- LOGIN BUTTON -->
      <button type="submit" name="admin_login" class="submit-btn">

        Login

      </button>

    </form>

  </main>

  <!-- FOOTER -->
  <footer>

    <h3>Contact Information</h3>

    <p>Email: planbot@yahoo.com</p>

    <p>Phone: +45 87542109</p>

    <p>Address: Nørre Voldgade 34 1358 Copenhagen K</p>

  </footer>

</body>
</html>