<?php
include '../config.php';
session_start();

if (!isset($_SESSION['email'])) {
  header("location:../login.php");
}

$email = $_SESSION['email'];
$usr_id = $_SESSION['usr_id'];

$sql = "SELECT * FROM `tutor` WHERE `usr_id`='$usr_id'";

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
  $row = mysqli_fetch_assoc($result);
  $name = $row['name'];
  $imagePath = $row['image'];

  $image = "../" . $imagePath;
  $_SESSION['name'] = $name;
  $_SESSION['image'] = $image;
  $_SESSION['tutor_id'] = $row['id'];
}

$tutor_id = $_SESSION['tutor_id'];
$sql = "SELECT * FROM `course` where `tutor_id`='$tutor_id'";
$result = mysqli_query($conn, $sql);
$count = $result->num_rows;

$sql2 = "SELECT SUM(amount) as SUM FROM `orders`o INNER JOIN `course` c ON c.`id` = o.`course_id` WHERE c.`tutor_id` = $tutor_id AND o.`status` = 'success'";
$query_run2 = mysqli_query($conn, $sql2);
$row = mysqli_fetch_assoc($query_run2);
$amount = $row['SUM'];

$sql3 = "SELECT COUNT(learner_id) as users FROM `applied` WHERE `tutor_id` = $tutor_id";
$query_run3 = mysqli_query($conn, $sql3);
$row = mysqli_fetch_assoc($query_run3);
$users = $row['users'];
// echo $users;

?>
<!Doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Online Learning & Course Management System</title>
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }
  </style>
  <link rel="stylesheet" href="../css/home.css">
</head>

<body>

  <main class="d-flex flex-nowrap">

    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
      <img src="../img/White_Logo.png" alt="" srcset="" style="width:200px;">
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="./tutor_dashboard.php" class="nav-link text-white">
            Home
          </a>
        </li>
        <li>
          <a href="./tutor_course.php" class="nav-link text-white">
            Courses
          </a>
        </li>
        <li>
          <a href="./add_course.php" class="nav-link text-white">
            Add Course
          </a>
        </li>
        <li>
          <a href="./delete_course.php" class="nav-link text-white">
            Delete Courses
          </a>
        </li>
        <li>
          <a href="./payment_status.php" class="nav-link text-white">
            Payment Status
          </a>
        </li>
      </ul>
      <hr>
      <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="<?php echo $image; ?>" alt="" width="32" height="32" class="rounded-circle me-2">
          <strong>&nbsp;<?php echo $name; ?></strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
          <li><a class="dropdown-item" href="./profile.php">Profile</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="./signout.php">Sign out</a></li>
        </ul>
      </div>
    </div>

    <div class="b-example-divider b-example-vr"></div>

    <div class="flex-shrink-0 p-4 contact" style="width: 75%;">
      <div class="container">
        <br>
        <h2>Dashboard</h2>
        <br>
        <div class="row">
          <div class="col-md-3">
            <div class="info-box">
              <h6>No of Courses</h6>
              <h2><?php echo $count; ?></h2>
            </div>
          </div>
          <div class="col-md-3">
            <div class="info-box">
              <h6>Total Users(All courses)</h6>
              <h2><?= $users ?></h2>
            </div>
          </div>
          <div class="col-md-3">
            <div class="info-box">
              <h6>Earning(In Rs.)</h6>
              <h2><?= number_format($amount) ?></h2>
            </div>
          </div>
        </div>
        <br>
        <h5>Current Courses</h5>
        <?php
        $query = "SELECT * FROM `course` c where `tutor_id`='$tutor_id'";
        $query_run = mysqli_query($conn, $query);

        if (mysqli_num_rows($query_run) > 0) {
        ?>
          <div class="row">
            <?php
            while ($row = mysqli_fetch_assoc($query_run)) { ?>
              <div class="col-md-3">
                <div class="info-box">
                  <img src="<?php echo $row['image'] ?>" alt="" srcset="">
                  <h6><?php echo $row['name'] ?></h6>
                  <a href="./single_course.php?id=<?php echo $row['id'] ?>" style="font-size: 16px;">View</a>
                </div>
              </div>
            <?php
            } ?>
          </div>
        <?php
        } ?>
      </div>
    </div>

  </main>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  <script src="./sidebars.js"></script>
</body>

</html>