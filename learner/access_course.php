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

        $course_id = $_GET['course_id'];
        $_SESSION['course_id'] = $course_id;
        $learner_id = $_SESSION['learner_id'];

        $query = "SELECT * FROM `course` WHERE `id` = $course_id ";
        $query_run = mysqli_query($conn,$query);

        if ($query_run->num_rows > 0) {
            $row = mysqli_fetch_assoc($query_run);
            $course_name = $row['name'];
            $course_abt = $row['description'];
            $imagePath = $row['image'];

            $course_image = "../thumbnail/" . $imagePath;
            // echo $course_image;
        } 

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

    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 300px;">
      <h2 style="padding-left:15px;margin-top:10px">Lessons</h2>
      <hr>
        <?php
            $query = "SELECT * FROM `lessons` WHERE `course_id` = $course_id";
            $query_run = mysqli_query($conn,$query);

            if(mysqli_num_rows($query_run) > 0)
            {
              ?>
                <ul class="nav nav-pills flex-column mb-auto">
                <?php
                  $i = 1;
                  while($row = mysqli_fetch_assoc($query_run))
                  {?>
                        <li class="nav-item">
                        <a href="./lessons.php?lesson_id=<?= $row['id'] ?>" class="nav-link text-white" style="font-size:15px">
                            Lesson <?php echo $i . " : " . $row['name'] ?>
                        </a>
                        </li>
                        <hr style="height:1px;margin: 2px">
                    <?php 
                        $i++;             
                  }?>
                </ul>
                <?php 
            } 
            else{
              echo "<h6>No lessons found...</h6>";
            }
        ?>
      <hr>
      <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
          data-bs-toggle="dropdown" aria-expanded="false">
          <img src="<?php echo $image; ?>" alt="" width="32" height="32" class="rounded-circle me-2">
          <strong>&nbsp;<?php echo $name; ?></strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
          <li><a class="dropdown-item" href="./learner_dashboard.php">Home</a></li>
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
        <h5>Course Name : <?= $course_name ?></h5>
        <br>
        <img src="<?= $course_image ?>" alt="thumbnail" style="width:300px;height:250px;border:1px solid rgba(119, 119, 119, 0.244);">
        <br>
        <br>
        <h5>Course Description : </h5>
        <p style="padding-left:100px"><?= $course_abt ?></p>
      </div>

      <br>
      <div class="container">
        <?php
            $query = "SELECT * FROM `feedback` WHERE `course_id` = $course_id AND `learner_id` = $learner_id";
            $query_run = mysqli_query($conn,$query);

            if(mysqli_num_rows($query_run) > 0)
            {
              ?>
                <h6>Feedback given by you :</h6>
                <ul>
                <?php
                  while($row = mysqli_fetch_assoc($query_run))
                  {?>
                        <li>
                          <?= $row['review'] ?>
                        </li>
                    <?php              
                  }?>
                </ul>
                <?php 
            } 
            else{
              echo "<h6>No Feedbacks by you...</h6>";
            }
        ?>
      </div>
      <br>
      <div class="container">
        <div class="field input-field" style="margin:25px 0px">
          <label for="feedback">Give Feedback : </label>
          <br>
          <textarea name="review" id="feedback" cols="100" rows="3" class="field input-field" style="border:1px double grey"></textarea>
          <input type="button" value="Post" id="feedback_post" class="btn btn-success">
          <div id="msg" style="color:green"></div>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script>
        $(document).ready(function(){
            $('#feedback_post').click(function(){
                var review = $('#feedback').val();
                var course_id = <?php echo $course_id ?>;
                // console.log(course_id);
                $.ajax({
                  url: "./feedback_ajax.php",
                  type : "POST",
                  data : {
                    course_id : course_id,
                    review : review
                  },
                  success : function(res){
                    $('#msg').html(res);
                  }
                });
            })
        })
  </script>          

</body>

</html>