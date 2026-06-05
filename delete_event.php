<?php

include 'db_connect.php';

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $delete_sql = "DELETE FROM events WHERE id='$id'";

    if(mysqli_query($conn, $delete_sql)){

        echo "<script>alert('Event Deleted Successfully');</script>";

    }
    else{

        echo "Error: " . mysqli_error($conn);

    }

}

$sql = "SELECT * FROM events";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Delete Events</title>

  <!-- SAME CSS FILE -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- HEADER -->
  <header>

    <div class="logo-section">

      <img src="planbot.png" alt="Logo" class="logo">

      <h1>Delete Events</h1>

    </div>

    <!-- NAVIGATION -->
    <nav>
      <ul>
        <li><a href="admin_dashboard.html">Dashboard</a></li>
        <li><a href="view-events.html">Events</a></li>
      </ul>
    </nav>

  </header>

  <!-- HERO SECTION -->
  <section class="hero">

    <h2>Manage Existing Events</h2>

    <p>
      Remove outdated or cancelled college events.
    </p>

  </section>

  <!-- DELETE EVENT SECTION -->
  <section class="delete-section">

    <div class="delete-container">
 
<?php

while($row = mysqli_fetch_assoc($result)){

?>

<div class="delete-card">

  <h2><?php echo $row['event_name']; ?></h2>

  <p>
    <strong>Location:</strong>
    <?php echo $row['location']; ?>
  </p>

  <p>
    <strong>Date:</strong>
    <?php echo $row['event_date']; ?>
  </p>

  <p>
    <strong>Time:</strong>
    <?php echo $row['event_time']; ?>
  </p>

  <a href="delete_event.php?delete=<?php echo $row['id']; ?>">

    <button class="delete-btn">
      Delete Event
    </button>

  </a>

</div>

<?php

}

?>

    </div>

  </section>

  <!-- FOOTER -->
  <footer>

    <h3>Contact Information</h3>

    <!-- Replace later -->
    <p>Email: example@email.com</p>
    <p>Phone: +91 9876543210</p>
    <p>Address: Your College Address</p>

  </footer>

</body>
</html>