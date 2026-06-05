<?php

include 'db_connect.php';

if(isset($_POST['add_event'])){

    $event_name = $_POST['event_name'];
    $location = $_POST['location'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $description = $_POST['description'];

    $sql = "INSERT INTO events 
(event_name, location, event_date, event_time, description) 
VALUES 
('$event_name', '$location', '$event_date', '$event_time', '$description')";

    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Event Added Successfully');</script>";
    }
    else{
        echo "Error: " . mysqli_error($conn);
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Add Event</title>

  <!-- SAME CSS FILE -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- HEADER -->
  <header>

    <div class="logo-section">

      <img src="planbot.png" alt="Logo" class="logo">

      <h1>Add New Event</h1>

    </div>

    <!-- NAVIGATION -->
    <nav>
      <ul>
        <li><a href="admin_dashboard.html">Dashboard</a></li>
        <li><a href="index.html">Home</a></li>
      </ul>
    </nav>

  </header>

  <!-- HERO SECTION -->
  <section class="hero">

    <h2>Create College Events</h2>

    <p>
      Add new events for students and participants.
    </p>

  </section>

  <!-- ADD EVENT FORM -->
  <main class="add-event-container">

    <form class="add-event-form" method="POST">

      <!-- EVENT NAME -->
      <div class="form-group">

        <label>Event Name</label>

        <input 
          type="text"
          name="event_name"
          placeholder="Enter event name"
          required
        >

      </div>

      <!-- LOCATION -->
      <div class="form-group">

        <label>Location</label>

        <input 
          type="text"
          name="location"
          placeholder="Enter event location"
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
          placeholder="Write event details..."
          rows="5"
          required
        ></textarea>

      </div>

      <!-- BUTTONS -->
      <div class="button-group">

       <button type="submit" name="add_event" class="submit-btn">
        Add Event
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

    <!-- Replace later -->
    <p>Email: example@email.com</p>
    <p>Phone: +91 9876543210</p>
    <p>Address: Your College Address</p>

  </footer>

</body>
</html>