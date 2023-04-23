<?php

include '../config.php';

if (isset($_POST['usr_id'])) {

    $usr_id = $_POST['usr_id'];
    $usr_email = $_POST['usr_email'];
    $course_id = $_POST['course_id'];
    $amount = $_POST['amount']; 
    $tutor_id = $_POST['tutor_id'];

   $query = "INSERT INTO `orders` (`usr_id`, `usr_email`, `course_id`, `amount`, `status`) VALUES ('$usr_id', '$usr_email', '$course_id', '$amount', 'success')";
   $query_run = mysqli_query($conn,$query);

   if($query_run){
        $query2 = "INSERT INTO `applied` (`course_id`,`learner_id`, `tutor_id`) VALUES ('$course_id', '$usr_id', '$tutor_id')";
        $query_run2 = mysqli_query($conn,$query2);
        if($query_run2){
            echo "Ordered done. Now you can access Course";
        }
        else{
            echo "Something Went Wrong.";
        }
   }
   else{
        echo "Something Went Wrong.";
   }
}   
?>
    