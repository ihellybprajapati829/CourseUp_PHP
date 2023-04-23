<?php 
    include '../config.php';
    session_start();

    if(!isset($_SESSION['email'])){
        header("location:../login.php");
    }

    unset($_SESSION['course_id']);
    unset($_SESSION['msg']);

        $email = $_SESSION['email'];
        $usr_id = $_SESSION['usr_id'];
        $image = $_SESSION['image'];
        $name = $_SESSION['name'];
        $tutor_id = $_SESSION['tutor_id'];

        $sql = "SELECT MAX(id) as 'max' FROM `course`";
        $result = mysqli_query($conn, $sql);
        
        if($result->num_rows > 0 ){
            $row = mysqli_fetch_assoc($result);
            $count = $row['max'] + 1;
            $_SESSION['course_id'] = $count;
        }


        if (isset($_POST['add_course'])) {
            $cname = $_POST['cname'];
            $category_id = $_POST['category'];
            $cdesc = $_POST['cdesc'];
            $price = "Rs. " . $_POST['cprice'];
            $cimg = $_FILES['cimg'];

            $filename=$cimg['name'];
            $filepath=$cimg['tmp_name'];
            $filesize=$cimg['size'];
            $fileerror=$cimg['error'];
            $filetype=$cimg['type'];
            $fileExt=explode('.',$filename);
            $fileactualExt=strtolower(end($fileExt));
            $allowed=array('jpg','jpeg','png');

            if(in_array($fileactualExt,$allowed)){
                $destfile='../thumbnail/'.$filename;
                move_uploaded_file($filepath,$destfile);

                $sql2 = "INSERT INTO `course` (`id`,`category_id`,`tutor_id`,`name`,`description`,`price`,`image`,`active`) VALUES ('$count','$category_id','$tutor_id','$cname','$cdesc','$price','$destfile',1)";

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

    <script src="../assets/ckeditor/ckeditor.js"></script>
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
                <h6 style="color:green;"><?php if(isset($_SESSION['msg'])){echo $_SESSION['msg'];} ?></h6>
                <br>
                <h2>Add New Course</h2>
                <br>
                <form action="" method="POST" id="addCourse" enctype="multipart/form-data">
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
                            <textarea type="text" class="form-control" rows="3"
                                placeholder="Enter brief description of course" name="cdesc" required></textarea>
                            <br>

                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <h5>Price</h5>
                                </div>
                                <div class="col-md-4">
                                    <h5>Thumbnail</h5>
                                </div>
                                <div class="col-md-4"></div>
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
                                        data-bs-target="#addLesson-modal" style="width:100%">Add Lessons</button>
                                </div>
                            </div>
                            <br>
                            <br>
                        </div>
                    </div>
                </form>
            </div>


            <!-- Add Lesson Modal -->
            <div class="modal fade" id="addLesson-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" style="width:100%">
                    <div class="modal-content" style="border-radius:0px;">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Lesson</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <form action="" method="POST" id="addLesson" enctype="multipart/form-data">
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
                                            <label for="time" class="form-label">
                                                <h5>Duration</h5></label>
                                            <input type="time" class="form-control" name="duration" value="00:00" required> 
                                            <br>
                                            <label class="form-label">
                                                <h5>Content</h5>
                                            </label>
                                            <textarea type="text" id="text_editor" class="ckeditor"  class="form-control"
                                                required></textarea>
                                                <textarea id="getcontent" name="lcontent" hidden></textarea>
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
                                            <input type="submit" class="btn btn-success" name="add_lesson"
                                                form="addLesson" style="width:100%" value="Add Lesson">
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
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>
    <script src="./sidebars.js"></script>
    <script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     CKEDITOR.replace('text_editor');
    //     // $ckeditor->editor('text_editor');
    // });
	
    $("#addLesson").submit(function(event){
        var data = CKEDITOR.instances.text_editor.getData();
        $('#getcontent').val(data);
        submitForm();
        return false;
    });

    function submitForm(){
        $.ajax({
            type: "POST",
            url: "add_lesson.php",
            data: $('form#addLesson').serialize(),
            success: function(response){
                $('#addLesson')[0].reset();
                $("#addLesson-modal").modal('hide');
                console.log(response);
            },
            error: function(){
                alert("Error");
            }
        });
    }
    </script>
</body>

</html>