<?php 
    include '../config.php';
    session_start();

    if(!isset($_SESSION['email'])){
      header("location:../login.php");
    }
        $email = $_SESSION['email'];
        $usr_id = $_SESSION['usr_id'];
        $name = $_SESSION['name'];
        $image = $_SESSION['image'];
        $learner_id = $_SESSION['learner_id'];
        // echo $learner_id;
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
      <img src="../img/White_Logo.png" alt="" style="width:200px;">
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
      <div class="container" id="courses">
        <br>
        <h5>My Courses</h5>
        <br>
        <?php
            $query = "SELECT * FROM `course` c INNER JOIN `applied` a ON a.`course_id` = c.`id` WHERE a.`learner_id` = $learner_id ORDER BY a.`applied_at` DESC";
            $query_run = mysqli_query($conn,$query);

            if(mysqli_num_rows($query_run) > 0)
            {
              ?>
                <div class="row">
                <?php
                  while($row = mysqli_fetch_assoc($query_run))
                  {?>
                    <div class="col-md-3">
                      <div class="info-box">
                        <img src="<?php echo $row['image'] ?>" alt="">
                        <h6><?php echo $row['name'] ?></h6>
                        <a href="./access_course.php?course_id=<?php echo $row['course_id']?>" style="font-size: 16px;">View</a>
                      </div>
                    </div>
                    <?php              
                  }?>
                  </div>
                <?php 
            } 
            else{
              echo "<h4>No courses enrolled yet...</h4>";
            }
            ?>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script>

        $(document).ready(function(){
            $('#search').keyup(function(){
                var course = $('#search').val();
                if(course==""){ 
                    $('#searchedCourse').html("");
                }
                else{
                    $.ajax({
                        type: "POST",
                        url: "./search_ajax.php",
                        data : {
                            search : course
                        },
                        success: function(res){
                            $('#searchedCourse').html(res).show();
                        }
                    });
                }
            })
        })
  </script>
</body>

</html>