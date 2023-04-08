<?php
include 'config.php';

session_start();

if(isset($_GET['token'])){
    $token = $_GET['token'];

    $updatequery = "UPDATE `user` SET `active`=1 where `token`='$token'";

    $query = mysqli_query($conn,$updatequery);

    if($query){
        if(isset($_SESSION['activation_msg'])){
            $_SESSION['activation_msg'] = "Account activated. Now you can login.";
            header("Location: login.php");
        }
    }
    else{
        $_SESSION['activation_msg'] = "Account is not activated.";
        header("Location: login.php");
    }
}
?>