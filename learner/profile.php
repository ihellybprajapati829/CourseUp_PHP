<?php 
    include '../config.php';
    session_start();

    if(!isset($_SESSION['email'])){
      header("location:../login.php");
    }

        $email = $_SESSION['email'];
        $usr_id = $_SESSION['usr_id'];
    
        $sql = "SELECT * FROM `learner` WHERE `usr_id`='$usr_id'";
    
        $result = mysqli_query($conn, $sql);
    
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $name = $row['name'];
            $imagePath = $row['image'];
            $interest = $row['interest'];
            $contactNo = $row['contact_no'];

            $image = "../" . $imagePath;
            $_SESSION['name'] = $name;
            $_SESSION['image'] = $image;
            $_SESSION['tutor_id'] = $row['id'];
        } 

        // $tutor_id = $_SESSION['tutor_id'];
        // $sql = "SELECT * FROM `course` where `tutor_id`='$tutor_id'";
        // $result = mysqli_query($conn, $sql);
        // $count = $result->num_rows;
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
          <a href="#" class="nav-link text-white">
            Edit Courses
          </a>
        </li>
      </ul>
      <hr>
      <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
          data-bs-toggle="dropdown" aria-expanded="false">
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
        <h2>Profile</h2>

        <br>

        <div class="profile">
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="<?php echo $image; ?>" class="card-img" alt="...">
                        <div class="card-body">
                            <h5 class="card-title" align="center"><?php echo $name; ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <br>
                            <h6>Interests : </h6>
                            <p style="margin-left:40px;">
                            <ul>
                            <?php

                            $interests = explode(',',preg_replace("/[^a-zA-Z,]+/", "", $interest));
                            foreach($interests as $ele){
                                echo "<li>$ele</li>";
                            }
                            ?>
                            </ul>

                            <br>
                            <h6>Email-ID : <?php echo $email; ?></h6>
                            <br>
                            <h6>Contact-No : <?php echo $contactNo; ?></h6>
                            <br>

                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>

  </main>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
    integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
    integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
    crossorigin="anonymous"></script>
  <script src="./sidebars.js"></script>
</body>

</html>