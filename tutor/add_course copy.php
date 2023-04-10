<?php 
    include '../config.php';
    session_start();
    // echo "Tutor dashboard";
    // echo $_SESSION['email'];
    // echo $_SESSION['usr_id'];

        $email = $_SESSION['email'];
        $usr_id = $_SESSION['usr_id'];
        $image = $_SESSION['image'];
        $name = $_SESSION['name'];
        $tutor_id = $_SESSION['tutor_id'];

        if (isset($_POST['add_course'])) {
            $cname = $_POST['cname'];
            $category_id = $_POST['category'];
            $cdesc = $_POST['cdesc'];
            $duration = $_POST['day'] . " Days " . $_POST['time'];
            $price = "Rs. " . $_POST['cprice'];
            $cimg = $_POST['cimg'];
        
            $sql = "SELECT MAX(id) as 'max' FROM `course`";
            $result = mysqli_query($conn, $sql);
            
            if($result->num_rows > 0 ){
                $row = mysqli_fetch_assoc($result);
                $count = $row['max'] + 1;
                $_SESSION['course_id'] = $count;
            }

            $sql2 = "INSERT INTO `course` (`id`,`category_id`,`tutor_id`,`name`,`description`,`duration` ,`price`,`image`,`active`) VALUES ('$count','$category_id','$tutor_id','$cname','$cdesc','$duration','$price','$cimg',1)";

            $result2 = mysqli_query($conn, $sql2);
            
            if ($result2) {
                // header("Location: ./add_course.php");
                $_SESSION['msg'] = "Course Added.";
			} 
			else 
			{
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
        }

        if (isset($_POST['add_lesson'])) {
            $lname = $_POST['lname'];
            $lcontent = $_POST['lcontent'];
            $lref = $_POST['lref'];
            $course_id = $_SESSION['course_id'];
           
            echo "Hello";
            die();
            $sql = "INSERT INTO `lessons` (`course_id`,`name`,`content`,`reference`) VALUES ('$course_id','$lname','$lcontent','$lref')";

            $result = mysqli_query($conn, $sql);
            
            if ($result) {
                // header("Location: ./add_course.php");
                $_SESSION['msg'] = "Lesson Added.";
			} 
			else 
			{
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
        }

?>
<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Learning & Course Management System</title>
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>

        <div class="b-example-divider b-example-vr"></div>

        <div class="flex-shrink-0 p-4 contact" style="width: 75%;">
            <div class="container">
                <h6 style="color:green;"><?php if(isset($_SESSION['msg'])){echo $_SESSION['msg'];} ?></h6>
                <br>
                <h2>Add New Course</h2>
                <br>
                <form action="" method="POST" id="addCourse">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="cname" class="form-label">
                                        <h5>Course Name</h5>
                                    </label>
                                    <input type="text" class="form-control" name="cname" placeholder="Enter Course Name"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="category" class="form-label">
                                        <h5>Category</h5>
                                    </label>

                                    <?php

                                    $query = "SELECT * FROM `category`";

                                    $query_run = mysqli_query($conn,$query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        ?>
                                    <select name="category" id="category" class="form-control">
                                        <option value="" selected disabled>Select Category</option>
                                        <?php
                                        while($row = mysqli_fetch_assoc($query_run))
                                        {
                                            ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                        <?php              
                                        }?>
                                    </select>
                                    <?php
                                    }

                                    ?>

                                </div>
                            </div>
                            <br>

                            <label for="cdesc" class="form-label">
                                <h5>Course Description</h5>
                            </label>
                            <textarea type="text" class="form-control" rows="2"
                                placeholder="Enter brief description of course" name="cdesc" required></textarea>
                            <br>

                            <div class="row">
                                <div class="col-md-4">
                                    <h5>Duration</h5>
                                </div>
                                <div class="col-md-4">
                                    <h5>Price</h5>
                                </div>
                                <div class="col-md-4">
                                    <h5>Thumbnail</h5>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="day" class="form-label">Day</label>
                                            <input type="text" class="form-control" name="day" placeholder="00"
                                                maxlength="2" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="time" class="form-label">Time</label>
                                            <input type="time" class="form-control" name="time" value="00:00" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <label class="form-label">Price in Rupee Format</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="Rs." disabled>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" name="cprice"
                                                placeholder="Enter Price : 70000" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="cimg" class="form-label">Select Thumbnail for Course</label>
                                            <input type="file" class="form-control" name="cimg"
                                                placeholder="Enter Course Image" accept="image/*" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-10"></div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" style="width:100%">Add Lessons</button>
                                </div>
                            </div>
                            <br>
                            <br>
                        </div>
                    </div>
                </form>
            </div>


            <!-- Add Lesson Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" style="width:100%">
                    <div class="modal-content" style="border-radius:0px;">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Lesson</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <form action="" method="POST" id="addLesson">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="lname" class="form-label">
                                                        <h5>Lesson Name</h5>
                                                    </label>
                                                    <input type="text" class="form-control" name="lname"
                                                        placeholder="Enter lesson Name" required>
                                                </div>
                                            </div>
                                            <br>

                                            <label for="lcontent" class="form-label">
                                                <h5>Content</h5>
                                            </label>
                                            <textarea type="text" id="text_editor" class="form-control"
                                                placeholder="Enter Content" class="ckeditor" name="lcontent"
                                                required></textarea>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="lref" class="form-label">
                                                <h5>Refereneces</h5>
                                            </label>
                                            <input type="text" class="form-control" name="lref"
                                                placeholder="Enter References" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-success" name="add_lesson"
                                                form="addLesson" style="width:100%">Add Lesson</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <button class="btn btn-success" form="addCourse" name="add_course" style="width:100%">Add
                        Course</button>
                </div>
                <div class="col-md-4"></div>
            </div>




























            <!-- <div class="container">
                <h4>Add Lessons</h4>
                <br>
                <form method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="lname" class="form-label">
                                        <h5>Lesson Name</h5>
                                    </label>
                                    <input type="text" class="form-control" name="lname" placeholder="Enter lesson Name"
                                        required>
                                </div>
                            </div>
                            <br>

                            <label for="lcontent" class="form-label">
                                <h5>Content</h5>
                            </label>
                            <textarea type="text" id="text_editor" class="form-control" placeholder="Enter Content" class="ckeditor" name="lcontent" required></textarea>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="lref" class="form-label">
                                <h5>Refereneces</h5>
                            </label>
                            <input type="text" class="form-control" name="lref" placeholder="Enter References"
                                        required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2">
                             <button class="btn btn-primary" style="width:100%">New Lesson</button>
                        </div>
                        <div class="col-md-2">
                             <button class="btn btn-success" name="add_lesson" style="width:100%">Add Lesson</button>
                        </div>
                    </div>
                </form>
        </div> -->
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>
    <script src="./sidebars.js"></script>
    <script src="../assets/ckeditor/ckeditor.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        CKEDITOR.replace('text_editor');
    });


    $(document).ready(function(){	
        $("#addLesson").submit(function(event){
            submitForm();
            return false;
        });
    });
    </script>
</body>

</html>