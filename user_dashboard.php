<?php
session_start();
include 'db_connect.php';

// Block access if not logged in
if(!isset($_SESSION['user_id'])){
    header("Location: user_login.php");
    exit();
}

$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];

// Cancel registration
if(isset($_GET['cancel'])){
    $id = $_GET['cancel'];
    $delete_sql = "DELETE FROM registrations WHERE id='$id' AND email='$user_email'";
    mysqli_query($conn, $delete_sql);
}

// Fetch only THIS user's registrations
$sql = "
SELECT registrations.*, events.event_name
FROM registrations
INNER JOIN events ON registrations.event_id = events.id
WHERE registrations.email = '$user_email'
ORDER BY registered_at DESC
";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <header>
    <div class="logo-section">
      <img src="planbot.png" alt="Logo" class="logo">
      <h1>User Dashboard</h1>
    </div>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="view_event.php">Events</a></li>
        <li><a href="logout.php">Logout (<?php echo htmlspecialchars($user_name); ?>)</a></li>
        <li><a href="edit_profile.php">Edit Profile</a></li>
      </ul>
    </nav>
  </header>

  <section class="hero">
    <h2>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h2>
    <p>View and manage your registered events.</p>
  </section>

  <section class="registration-section">
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Student ID</th>
            <th>Event Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $count = 0;
          while($row = mysqli_fetch_assoc($result)){
              $count++;
          ?>
          <tr>
            <td><?php echo htmlspecialchars($row['user_name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['student_id']); ?></td>
            <td><?php echo htmlspecialchars($row['event_name']); ?></td>
            <td>
              <a href="user_dashboard.php?cancel=<?php echo $row['id']; ?>" onclick="return confirm('Cancel this registration?')">
                <button class="delete-btn">Cancel</button>
              </a>
            </td>
          </tr>
          <?php } ?>
          <?php if($count == 0){ ?>
          <tr><td colspan="5" style="text-align:center;">No registrations yet. <a href="register_now.php">Register for an event</a></td></tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </section>

  <footer>
    <h3>Contact Information</h3>
    <p>Email: planbot@yahoo.com</p>
    <p>Phone: +45 87542109</p>
    <p>Address: Nørre Voldgade 34 1358 Copenhagen K</p>
  </footer>

</body>
</html>
