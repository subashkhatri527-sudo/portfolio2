<?php

include 'db_connect.php';

if(isset($_GET['present'])){

    $registration_id = $_GET['present'];

    $sql = "INSERT INTO attendance
    (registration_id, attendance_status)

    VALUES

    ('$registration_id', 'Present')";

    mysqli_query($conn, $sql);

}

if(isset($_GET['absent'])){

    $registration_id = $_GET['absent'];

    $sql = "INSERT INTO attendance
    (registration_id, attendance_status)

    VALUES

    ('$registration_id', 'Absent')";

    mysqli_query($conn, $sql);

}

$registration_sql = "SELECT * FROM registrations";

$result = mysqli_query($conn, $registration_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Attendance Management</title>

  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- HEADER -->
  <header>

    <div class="logo-section">

      <img src="planbot.png" alt="Logo" class="logo">

      <h1>Attendance Management</h1>

    </div>

    <nav>
      <ul>
        <li><a href="admin_dashboard.html">Dashboard</a></li>
        <li><a href="index.html">Home</a></li>
      </ul>
    </nav>

  </header>

  <!-- HERO -->
  <section class="hero">

    <h2>Manage Student Attendance</h2>

    <p>
      Mark students as Present or Absent for events.
    </p>

  </section>

  <!-- ATTENDANCE TABLE -->
  <section class="registration-section">

    <div class="table-container">

      <table>

        <thead>

          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Student ID</th>
            <th>Event ID</th>
            <th>Present</th>
            <th>Absent</th>
          </tr>

        </thead>

        <tbody>

          <?php

          while($row = mysqli_fetch_assoc($result)){

          ?>

          <tr>

            <td><?php echo $row['user_name']; ?></td>

            <td><?php echo $row['email']; ?></td>

            <td><?php echo $row['student_id']; ?></td>

            <td><?php echo $row['event_id']; ?></td>

            <td>

              <a href="attendance.php?present=<?php echo $row['id']; ?>">

                <button class="attendance-btn present-btn">
                 Present
                </button>

              </a>

            </td>

            <td>

              <a href="attendance.php?absent=<?php echo $row['id']; ?>">

                <button class="attendance-btn absent-btn">
                 Absent
                </button>

              </a>

            </td>

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