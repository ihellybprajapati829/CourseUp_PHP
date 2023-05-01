<?php
include '../config.php';
session_start();

if (!isset($_SESSION['email'])) {
  header("location:../login.php");
}
$email = $_SESSION['email'];
$usr_id = $_SESSION['usr_id'];
$name = $_SESSION['name'];
$image = $_SESSION['image'];
$course_id = $_GET['id'];
$learner_id = $_SESSION['learner_id'];

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
          <a href="./learner_dashboard.php" class="nav-link text-white">
            Home
          </a>
        </li>
        <li>
          <a href="./courses.php" class="nav-link text-white">
            Courses
          </a>
        </li>
        <li>
          <a href="./search_courses.php" class="nav-link text-white">
            Search Courses
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
        <div class="row">
          <div class="col-md-12">
            <div class="info-box">
              <br>
              <?php
              $query = "SELECT * FROM `course` where `id`='$course_id'";
              $query_run = mysqli_query($conn, $query);

              if (mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) { ?>
                  <img src="<?php echo $row['image'] ?>" alt="" align="left" style="margin:3%; width:300px;">
                  <br>
                  <br>
                  <div style="text-align:left;">
                    <div id="buyCourse">
                      <button id="buy" onclick="pay()">Buy Course</button>
                    </div>
                    <h2><?php echo $row['name']; ?></h2>
                    <?php
                    $tutor_id = $row['tutor_id'];
                    $sql2 = "SELECT * FROM `tutor` WHERE `id`='$tutor_id'";
                    $result2 = mysqli_query($conn, $sql2);

                    if ($result2->num_rows > 0) {
                      $row2 = mysqli_fetch_assoc($result2);
                      $tutor_name = $row2['name'];
                      echo "<h6>By :  $tutor_name</h6>";
                    }
                    ?>
                    <h3 id="price">Price : <?php echo $row['price']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                  </div>
              <?php
                }
              }

              ?>
              <?php
              $query2 = "SELECT * FROM `lessons` where `course_id`='$course_id'";
              $query_run2 = mysqli_query($conn, $query2);

              if (mysqli_num_rows($query_run2) > 0) { ?>
                <div style="text-align:left; padding:0% 4%;margin-top:-10%">
                  <table class="table">
                    <thead>
                      <th>No.</th>
                      <th>Lesson Name</th>
                      <th>Duration</th>
                    </thead>
                    <tbody>
                      <?php
                      $i = 1;
                      while ($row = mysqli_fetch_assoc($query_run2)) { ?>
                        <tr>
                          <td><?= $i ?></td>
                          <td><?= $row['name'] ?></td>
                          <td><?= $row['duration'] . " Hours" ?></td>
                        </tr>
                      <?php
                        $i++;
                      } ?>
                    </tbody>
                </div>

              <?php
              } else {
                echo "<h6>No lessons.</h6>";
              }
              ?>
              <div style="text-align:left;margin-top:180px">
                <?php
                $query3 = "SELECT f.`review`, l.`name` FROM `feedback` f INNER JOIN `learner` l ON l.`id` = f.`learner_id` where f.`course_id`='$course_id'";
                $query_run3 = mysqli_query($conn, $query3);

                if (mysqli_num_rows($query_run3) > 0) {
                  echo "<h6>Reviews :</h6><ul>";
                  while ($row = mysqli_fetch_assoc($query_run3)) { ?>
                    <li>
                      <p><?= $row['review'] . ". <span style='font-weight:bold;'> By : " . $row['name'] . "</span>" ?></p>
                    </li>
                <?php
                  }
                } else {
                  echo "<div style='padding-left:50px'><h6>No Reviews yet.</h6></div>";
                }
                ?>
                </ul>
                <br>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  <script src="./sidebars.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script>
    function pay() {
      var price = $('#price').html();
      price = price.replace("Price : Rs. ", "");
      var usr_id = <?php echo $learner_id; ?>;
      var email = '<?php echo $email; ?>';
      var cousre_id = <?php echo $course_id; ?>;
      var tutor_id = '<?php echo $tutor_id; ?>';
      // alert(tutor_id);

      var options = {
        "key": "rzp_test_DKZesYIjZMQ68l",
        "amount": price * 100,
        "currency": "INR",
        "name": "CourseUp",
        "description": "Test Transaction",
        "image": "../img/Logo.png",
        "callback_url": "https://eneqd3r9zrjok.x.pipedream.net/",
        "notes": {
          "address": "Razorpay Corporate Office"
        },
        "theme": {
          "color": "#444F5A"
        },
        "handler": function(response) {
          $.ajax({
            url: "./pay.php",
            type: "POST",
            data: {
              usr_id: usr_id,
              tutor_id: tutor_id,
              usr_email: email,
              course_id: cousre_id,
              amount: price
            },
            success: function(response) {
              alert(response);
              window.location.href = "http://localhost/CourseUp/learner/search_courses.php";
            }
          })

        }
      };
      var rzp1 = new Razorpay(options);
      rzp1.open();
    }
  </script>
</body>

</html>