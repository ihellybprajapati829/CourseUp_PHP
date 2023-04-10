<?php

include '../config.php';
session_start();

if(!isset($_SESSION['email'])){
    header("location:../login.php");
}

if (isset($_POST['lname'])) {
    $lname = $_POST['lname'];
    $lcontent = $_POST['lcontent'];
    $lref = $_POST['lref'];
    $course_id = $_SESSION['course_id'];
   
    $sql = "INSERT INTO `lessons` (`course_id`,`name`,`content`,`reference`) VALUES ('$course_id','$lname','$lcontent','$lref')";

    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $_SESSION['msg'] = "Lesson Added.";
        // header("Location: ./add_course.php");
    } 
    else 
    {
        $_SESSION['msg'] = "Lesson is not added.";
    }
    // echo "Hnbnbello";
    // die();
}

?>