<?php

include '../config.php';
session_start();
$learner_id = $_SESSION['learner_id'];

if (isset($_POST['review'])) {

   $review = $_POST['review'];
   $course_id = $_POST['course_id'];

   $query = "INSERT INTO `feedback` (`course_id`, `learner_id`, `review`) VALUES ('$course_id', '$learner_id', '$review')";
   $query_run = mysqli_query($conn,$query);

   if($query_run){
        echo "Feedback posted.";
   }
   else{
        echo "Something Went Wrong.";
   }
}  

?>
    