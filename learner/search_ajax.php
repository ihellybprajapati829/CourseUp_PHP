<?php

include '../config.php';

if (isset($_POST['search'])) {

   $course = $_POST['search'];

   $query = "SELECT * FROM `course` WHERE name LIKE '%$course%' LIMIT 4 ";
   $query_run = mysqli_query($conn,$query);

   while($row = mysqli_fetch_assoc($query_run)){

    ?>
        <div class="col-md-3">
            <div class="info-box">
                <img src="<?php echo $row['image'] ?>" alt="">
                <h6><?php echo $row['name'] ?></h6>
                <a href="./single_course.php?id=<?php echo $row['id']?>" style="font-size: 16px;">View</a>
            </div>
        </div>

        <?php
   }
}   
?>
    