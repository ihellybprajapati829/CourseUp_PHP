<?php

include '../config.php';
session_start();


if (!isset($_SESSION['email'])) {
    header("location:../login.php");
}

print_r($_POST);

if (isset($_POST['lname'])) {
    $lname = $_POST['lname'];
    $lcontent = $_POST['lcontent'];
    $lref = $_POST['lref'];
    $course_id = $_SESSION['course_id'];
    $duration = $_POST['duration'];

    $sql = "INSERT INTO `lessons` (`course_id`,`name`,`duration` ,`content`,`reference`) VALUES ('$course_id','$lname','$duration','$lcontent','$lref')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        // $_SESSION['msg'] = "Lesson Added.";
        echo "<script>alert('Lesson Added.')</script>";
        // header("Location: ./add_course.php");
    } else {
        // $_SESSION['msg'] = "Lesson is not added.";
        echo "<script>alert('Lesson is not added.')</script>";
    }
}
