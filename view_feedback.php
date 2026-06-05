<?php

include 'db_connect.php';

$sql = "SELECT * FROM feedback";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>View Feedback</title>

  <!-- SAME CSS FILE -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- HEADER -->
  <header>

    <div class="logo-section">

      <img src="planbot.png" alt="Logo" class="logo">

      <h1>User Feedback</h1>

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

    <h2>Audience Feedback</h2>

    <p>
      Review feedback submitted by participants and audience members.
    </p>

  </section>

  <!-- FEEDBACK TABLE SECTION -->
  <section class="feedback-view-section">

    <div class="table-container">

      <table>

        <thead>

          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Event</th>
            <th>Rating</th>
            <th>Feedback</th>
          </tr>

        </thead>

        <tbody>

          <?php

while($row = mysqli_fetch_assoc($result)){

?>

<tr>

  <td><?php echo $row['full_name']; ?></td>

  <td><?php echo $row['email']; ?></td>

  <td><?php echo $row['event_id']; ?></td>

  <td><?php echo $row['rating']; ?></td>

  <td><?php echo $row['feedback_message']; ?></td>

</tr>

<?php

}

?>

        </tbody>

      </table>

    </div>

  </section>

  <!-- FOOTER -->
  <footer>
    <h3>Contact Information</h3>

    
    <p>Email: planbot@yahoo.com</p>
    <p>Phone: +45 87542109</p>
    <p>Address: Nørre Voldgade 34 1358 Copenhagen K</p>
  </footer>

</body>
</html>