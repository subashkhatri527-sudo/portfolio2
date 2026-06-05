<?php

include 'db_connect.php';

if(isset($_POST['update_event'])){

    $event_id = $_POST['event_id'];
    $event_name = $_POST['event_name'];
    $location = $_POST['location'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $description = $_POST['description'];

    $update_sql = "UPDATE events SET

    event_name='$event_name',
    location='$location',
    event_date='$event_date',
    event_time='$event_time',
    description='$description'

    WHERE id='$event_id'";

    if(mysqli_query($conn, $update_sql)){

        echo "<script>alert('Event Updated Successfully');</script>";

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

  <title>Edit Event</title>

  <!-- SAME CSS FILE -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- HEADER -->
  <header>

    <div class="logo-section">

      <img src="logo.png" alt="Logo" class="logo">

      <h1>Edit Event</h1>

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

    <h2>Update Existing Events</h2>

    <p>
      Modify event details, schedules, and descriptions.
    </p>

  </section>

  <!-- EDIT FORM -->
  <main class="add-event-container">

    <form class="add-event-form" method="POST">

      <!-- SELECT EVENT -->
      <div class="form-group">

        <label>Select Event</label>

<select name="event_id" required>

  <option value="">Choose Event</option>

  <?php

  while($row = mysqli_fetch_assoc($result)){

  ?>

  <option value="<?php echo $row['id']; ?>">

    <?php echo $row['event_name']; ?>

  </option>

  <?php

  }

  ?>

</select>

      </div>

      <!-- EVENT NAME -->
      <div class="form-group">

        <label>Event Name</label>

        <input 
          type="text"
          name="event_name"
          value="Hackathon"
          required
        >

      </div>

      <!-- LOCATION -->
      <div class="form-group">

        <label>Location</label>

        <input 
          type="text"
          name="location"
          value="S112"
          required
        >

      </div>

      <!-- DATE -->
      <div class="form-group">

        <label>Event Date</label>

        <input 
          type="date"
          name="event_date"
          required
        >

      </div>

      <!-- TIME -->
      <div class="form-group">

        <label>Event Time</label>

        <input 
          type="time"
          name="event_time"
          required
        >

      </div>

      <!-- DESCRIPTION -->
      <div class="form-group">

        <label>Description</label>

        <textarea 
        name="description"
        rows="5" 
        required
        >
Coding competition for students and developers.
        </textarea>

      </div>

      <!-- BUTTONS -->
      <div class="button-group">

        <button type="submit" name="update_event" class="submit-btn">
  Update Event
</button>

        <button type="reset" class="reset-btn">
          Reset
        </button>

      </div>

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