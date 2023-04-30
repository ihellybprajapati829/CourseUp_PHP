<?php

include '../config.php';
session_start();
$tutor_id = $_SESSION['tutor_id'];

if (isset($_GET['id'])) {

    $course_id = $_GET['id'];

    $query = "UPDATE `course` SET `active` = 0 WHERE `id` = $course_id";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['delete_msg'] = 'Course Deactivated.';
        header('Location: ./delete_course.php');
    } else {
        $_SESSION['delete_msg'] = 'Course Not Deactivated. Something went wrong.';
        header('Location: ./delete_course.php');
    }
}
