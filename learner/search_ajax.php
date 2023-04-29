<?php

include '../config.php';
session_start();
$learner_id = $_SESSION['learner_id'];

if (isset($_POST['search'])) {

   $course = $_POST['search'];

   $query = "SELECT * FROM `course` WHERE `id` NOT IN (SELECT `course_id` FROM `applied` WHERE `learner_id` = $learner_id) AND name LIKE '%$course%' LIMIT 4 ";
   $query_run = mysqli_query($conn,$query);

   if(mysqli_num_rows($query_run) > 0){
        while($row = mysqli_fetch_assoc($query_run)){
            ?>
                <div class="col-md-3">
                    <div class="info-box">
                        <img src="<?php echo $row['image'] ?>" alt="">
                        <h6><?php echo $row['name'] ?></h6>
                        <a href="./single_course.php?id=<?php echo $row['id']?>" style="font-size: 16px;">Buy Course</a>
                    </div>
                </div>
        
                <?php
        }
   }
   else{
        echo "<p style='font-size:18px;padding-left:40%;margin-top:-5%'>No courses found...</p>";
   } 
}  

?>
    